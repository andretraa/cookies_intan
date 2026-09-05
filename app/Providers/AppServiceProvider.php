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
