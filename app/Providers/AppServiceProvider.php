<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') === 'production' || str_contains(request()->header('host', ''), 'vercel.app') || str_contains(request()->header('host', ''), 'vercel.com')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }

        // Bagikan status database ke seluruh tampilan admin
        \Illuminate\Support\Facades\View::composer('admin.*', function ($view) {
            $driver = config('database.default');
            $host = config("database.connections.{$driver}.host", '');
            $database = config("database.connections.{$driver}.database", '');

            $isCloud = false;
            $type = 'warning';
            $badge = 'Mode Serverless Sementara';
            $detail = 'Data yang Anda tambah/edit di Vercel saat ini disimpan sementara dan akan reset jika server tidur. Sambungkan Cloud Database gratis agar tersimpan permanen!';

            if ($driver === 'pgsql') {
                $isCloud = true;
                $type = 'success';
                $badge = 'Cloud Database (PostgreSQL)';
                $detail = 'Tersimpan permanen di cloud (' . $host . '). Data aman selamanya!';
            } elseif ($driver === 'mysql') {
                if (!empty($host) && $host !== '127.0.0.1' && $host !== 'localhost') {
                    $isCloud = true;
                    $type = 'success';
                    $badge = 'Cloud Database (MySQL)';
                    $detail = 'Tersimpan permanen di cloud (' . $host . '). Data aman selamanya!';
                } else {
                    $type = 'local';
                    $badge = 'MySQL Lokal (Laragon)';
                    $detail = 'Berjalan di komputer lokal (' . $host . '). Gunakan tombol Sinkronisasi SQLite sebelum git push ke Vercel.';
                }
            } elseif ($driver === 'sqlite') {
                if (str_contains((string) $database, '/tmp/')) {
                    $isCloud = false;
                    $type = 'warning';
                    $badge = 'SQLite Sementara (Vercel Serverless)';
                    $detail = 'Perhatian: Vercel Serverless mereset database /tmp saat idle. Tambahkan Cloud Database di Vercel agar perubahan produk & teks tersimpan permanen.';
                } else {
                    $type = 'local';
                    $badge = 'SQLite File (' . basename((string) $database) . ')';
                    $detail = 'File database SQLite lokal. Perubahan akan langsung tersimpan di file database.';
                }
            }

            $view->with('dbStatus', [
                'isCloud' => $isCloud,
                'type'    => $type,
                'badge'   => $badge,
                'detail'  => $detail,
                'driver'  => $driver,
                'host'    => $host,
            ]);
        });

        \Illuminate\Support\Facades\Hash::extend('safe_bcrypt', function ($app) {
            return new class extends \Illuminate\Hashing\AbstractHasher implements \Illuminate\Contracts\Hashing\Hasher {
                public function make(#[\SensitiveParameter] $value, array $options = [])
                {
                    // 1. Try standard PASSWORD_BCRYPT
                    try {
                        $cost = $options['rounds'] ?? 10;
                        $hash = @password_hash($value, PASSWORD_BCRYPT, ['cost' => (int) $cost]);
                        if ($hash && is_string($hash)) {
                            return $hash;
                        }
                    } catch (\Throwable $e) {}

                    // 2. Try PASSWORD_DEFAULT
                    try {
                        $hash = @password_hash($value, PASSWORD_DEFAULT);
                        if ($hash && is_string($hash)) {
                            return $hash;
                        }
                    } catch (\Throwable $e) {}

                    // 3. Robust HMAC-SHA256 fallback (never throws)
                    $appKey = config('app.key') ?: 'base64:VNxlKyGHR0nxDa9xB2Pa1MA5KFQ3Bex1SlFpL0DZS+s=';
                    return '$sha256$' . hash_hmac('sha256', $value, $appKey);
                }

                public function check(#[\SensitiveParameter] $value, $hashedValue, array $options = [])
                {
                    if (is_null($hashedValue) || (string) $hashedValue === '') {
                        return false;
                    }

                    // Handle SHA-256 fallback
                    if (str_starts_with($hashedValue, '$sha256$')) {
                        $appKey = config('app.key') ?: 'base64:VNxlKyGHR0nxDa9xB2Pa1MA5KFQ3Bex1SlFpL0DZS+s=';
                        $expected = '$sha256$' . hash_hmac('sha256', $value, $appKey);
                        return hash_equals($hashedValue, $expected);
                    }

                    // Standard password_verify (handles bcrypt $2y$, $2a$, $2b$, argon2, etc.)
                    try {
                        if (@password_verify($value, $hashedValue)) {
                            return true;
                        }
                    } catch (\Throwable $e) {}

                    // Check fallback plain text or sha256 match
                    if ($hashedValue === $value) {
                        return true;
                    }

                    $appKey = config('app.key') ?: 'base64:VNxlKyGHR0nxDa9xB2Pa1MA5KFQ3Bex1SlFpL0DZS+s=';
                    $sha256Check = '$sha256$' . hash_hmac('sha256', $value, $appKey);
                    if ($hashedValue === $sha256Check) {
                        return true;
                    }

                    return false;
                }

                public function needsRehash($hashedValue, array $options = [])
                {
                    // Never force rehash in serverless environment to prevent login crashes
                    return false;
                }

                public function info($hashedValue)
                {
                    if (is_string($hashedValue) && str_starts_with($hashedValue, '$sha256$')) {
                        return ['algo' => 99, 'algoName' => 'sha256', 'options' => []];
                    }

                    try {
                        $info = @password_get_info($hashedValue);
                        if ($info && !empty($info['algo'])) {
                            return $info;
                        }
                    } catch (\Throwable $e) {}

                    return ['algo' => 1, 'algoName' => 'safe_bcrypt', 'options' => []];
                }
            };
        });
    }
}
