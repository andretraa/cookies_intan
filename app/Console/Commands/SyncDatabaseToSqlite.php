<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use PDO;

class SyncDatabaseToSqlite extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:sync-sqlite {--force : Paksa replace seluruh database sqlite}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sinkronisasi data (products, site_settings, users) dari database aktif (MySQL) ke database/database.sqlite untuk Vercel';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Memulai sinkronisasi database ke database/database.sqlite...');

        $sqlitePath = database_path('database.sqlite');

        // Pastikan folder database ada
        if (!File::exists(dirname($sqlitePath))) {
            File::makeDirectory(dirname($sqlitePath), 0755, true);
        }

        // Buat file sqlite jika belum ada
        if (!File::exists($sqlitePath)) {
            File::put($sqlitePath, '');
        }

        $sqlitePdo = new PDO('sqlite:' . $sqlitePath);
        $sqlitePdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Siapkan struktur tabel di SQLite jika belum lengkap
        $this->ensureSqliteSchema($sqlitePdo);

        // 1. Sync Products
        $this->syncProducts($sqlitePdo);

        // 2. Sync Site Settings
        $this->syncSiteSettings($sqlitePdo);

        // 3. Sync Users
        $this->syncUsers($sqlitePdo);

        $sizeKb = round(filesize($sqlitePath) / 1024, 2);
        $this->newLine();
        $this->info("✅ Sinkronisasi berhasil! File database.sqlite siap di-commit ke Git ($sizeKb KB).");
        $this->comment("Langkah berikutnya: git add database/database.sqlite && git commit -m 'sync database' && git push");

        return 0;
    }

    /**
     * Pastikan struktur tabel minimal tersedia di SQLite.
     */
    protected function ensureSqliteSchema(PDO $pdo): void
    {
        $pdo->exec("
            CREATE TABLE IF NOT EXISTS products (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT NOT NULL,
                category TEXT NOT NULL,
                description TEXT,
                price REAL DEFAULT 0,
                price_unit TEXT DEFAULT '/pcs',
                badge TEXT,
                image TEXT,
                is_active INTEGER DEFAULT 1,
                sort_order INTEGER DEFAULT 0,
                created_at TEXT,
                updated_at TEXT
            );

            CREATE TABLE IF NOT EXISTS site_settings (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                key TEXT UNIQUE NOT NULL,
                value TEXT,
                group_name TEXT DEFAULT 'general',
                created_at TEXT,
                updated_at TEXT
            );

            CREATE TABLE IF NOT EXISTS users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name TEXT NOT NULL,
                email TEXT UNIQUE NOT NULL,
                email_verified_at TEXT,
                password TEXT NOT NULL,
                role TEXT DEFAULT 'user',
                remember_token TEXT,
                created_at TEXT,
                updated_at TEXT
            );
        ");

        // Periksa kolom `group` pada site_settings jika dibuat oleh migration standar
        try {
            $pdo->exec("ALTER TABLE site_settings ADD COLUMN `group` TEXT DEFAULT 'general'");
        } catch (\Throwable $e) {
            // Kolom group mungkin sudah ada
        }
    }

    /**
     * Sinkronisasi data produk dari database default.
     */
    protected function syncProducts(PDO $sqlitePdo): void
    {
        try {
            $products = DB::table('products')->orderBy('id')->get();
        } catch (\Throwable $e) {
            $this->warn('Tidak dapat membaca tabel products dari database utama: ' . $e->getMessage());
            return;
        }

        $sqlitePdo->exec("DELETE FROM products");

        $stmt = $sqlitePdo->prepare("
            INSERT INTO products (id, name, category, description, price, price_unit, badge, image, is_active, sort_order, created_at, updated_at)
            VALUES (:id, :name, :category, :description, :price, :price_unit, :badge, :image, :is_active, :sort_order, :created_at, :updated_at)
        ");

        $count = 0;
        foreach ($products as $p) {
            $image = $p->image;

            // Jika gambar adalah file lokal di public/uploads, embed sebagai Data URI agar tidak hilang di Vercel
            if (!empty($image) && !str_starts_with($image, 'data:') && !str_starts_with($image, 'http')) {
                $publicFile = public_path($image);
                if (file_exists($publicFile) && str_starts_with($image, 'uploads/')) {
                    $image = $this->fileToOptimizedDataUri($publicFile) ?: $image;
                }
            }

            $stmt->execute([
                ':id'          => $p->id,
                ':name'        => $p->name,
                ':category'    => $p->category,
                ':description' => $p->description,
                ':price'       => $p->price,
                ':price_unit'  => $p->price_unit,
                ':badge'       => $p->badge,
                ':image'       => $image,
                ':is_active'   => $p->is_active ? 1 : 0,
                ':sort_order'  => $p->sort_order ?? 0,
                ':created_at'  => $p->created_at ?? date('Y-m-d H:i:s'),
                ':updated_at'  => $p->updated_at ?? date('Y-m-d H:i:s'),
            ]);
            $count++;
        }

        $this->line("• Produk tersinkronisasi: <info>{$count}</info> item");
    }

    /**
     * Sinkronisasi data site_settings dari database default.
     */
    protected function syncSiteSettings(PDO $sqlitePdo): void
    {
        try {
            $settings = DB::table('site_settings')->get();
        } catch (\Throwable $e) {
            $this->warn('Tidak dapat membaca tabel site_settings dari database utama: ' . $e->getMessage());
            return;
        }

        $sqlitePdo->exec("DELETE FROM site_settings");

        $stmt = $sqlitePdo->prepare("
            INSERT OR REPLACE INTO site_settings (id, `key`, `value`, `group`, created_at, updated_at)
            VALUES (:id, :key, :value, :group, :created_at, :updated_at)
        ");

        $count = 0;
        foreach ($settings as $s) {
            $val = $s->value;

            // Jika foto hero/about diunggah di local uploads, embed sebagai Data URI
            if (!empty($val) && !str_starts_with($val, 'data:') && !str_starts_with($val, 'http')) {
                $publicFile = public_path($val);
                if (file_exists($publicFile) && str_starts_with($val, 'uploads/')) {
                    $val = $this->fileToOptimizedDataUri($publicFile) ?: $val;
                }
            }

            $group = $s->group ?? 'general';

            $stmt->execute([
                ':id'         => $s->id,
                ':key'        => $s->key,
                ':value'      => $val,
                ':group'      => $group,
                ':created_at' => $s->created_at ?? date('Y-m-d H:i:s'),
                ':updated_at' => $s->updated_at ?? date('Y-m-d H:i:s'),
            ]);
            $count++;
        }

        $this->line("• Pengaturan website tersinkronisasi: <info>{$count}</info> setting");
    }

    /**
     * Sinkronisasi akun user dari database default.
     */
    protected function syncUsers(PDO $sqlitePdo): void
    {
        try {
            $users = DB::table('users')->get();
        } catch (\Throwable $e) {
            $this->warn('Tidak dapat membaca tabel users dari database utama: ' . $e->getMessage());
            return;
        }

        $sqlitePdo->exec("DELETE FROM users");

        $stmt = $sqlitePdo->prepare("
            INSERT OR REPLACE INTO users (id, name, email, email_verified_at, password, role, remember_token, created_at, updated_at)
            VALUES (:id, :name, :email, :email_verified_at, :password, :role, :remember_token, :created_at, :updated_at)
        ");

        $count = 0;
        foreach ($users as $u) {
            $stmt->execute([
                ':id'                => $u->id,
                ':name'              => $u->name,
                ':email'             => $u->email,
                ':email_verified_at' => $u->email_verified_at,
                ':password'          => $u->password,
                ':role'              => $u->role ?? 'admin',
                ':remember_token'    => $u->remember_token ?? null,
                ':created_at'        => $u->created_at ?? date('Y-m-d H:i:s'),
                ':updated_at'        => $u->updated_at ?? date('Y-m-d H:i:s'),
            ]);
            $count++;
        }

        $this->line("• User admin tersinkronisasi: <info>{$count}</info> akun");
    }

    /**
     * Konversi file gambar lokal ke Data URI WebP terkompresi.
     */
    protected function fileToOptimizedDataUri(string $filePath): ?string
    {
        if (!file_exists($filePath) || !is_file($filePath)) {
            return null;
        }

        if (extension_loaded('gd') && function_exists('imagecreatefromstring')) {
            try {
                $content = file_get_contents($filePath);
                $src = @imagecreatefromstring($content);
                if ($src !== false) {
                    $origWidth = imagesx($src);
                    $origHeight = imagesy($src);
                    $maxDim = 800;

                    if ($origWidth > $maxDim || $origHeight > $maxDim) {
                        if ($origWidth >= $origHeight) {
                            $newWidth = $maxDim;
                            $newHeight = (int) round(($origHeight / $origWidth) * $maxDim);
                        } else {
                            $newHeight = $maxDim;
                            $newWidth = (int) round(($origWidth / $origHeight) * $maxDim);
                        }

                        $dst = imagecreatetruecolor($newWidth, $newHeight);
                        imagealphablending($dst, false);
                        imagesavealpha($dst, true);
                        imagecopyresampled($dst, $src, 0, 0, 0, 0, $newWidth, $newHeight, $origWidth, $origHeight);
                        imagedestroy($src);
                        $src = $dst;
                    }

                    ob_start();
                    if (function_exists('imagewebp')) {
                        imagewebp($src, null, 80);
                        $compressed = ob_get_clean();
                        imagedestroy($src);
                        if ($compressed) {
                            return 'data:image/webp;base64,' . base64_encode($compressed);
                        }
                    } else {
                        imagejpeg($src, null, 80);
                        $compressed = ob_get_clean();
                        imagedestroy($src);
                        if ($compressed) {
                            return 'data:image/jpeg;base64,' . base64_encode($compressed);
                        }
                    }
                }
            } catch (\Throwable $e) {
                // fallback
            }
        }

        // Fallback raw base64 jika file di bawah 2MB
        if (filesize($filePath) <= 2 * 1024 * 1024) {
            $raw = file_get_contents($filePath);
            $mime = mime_content_type($filePath) ?: 'image/jpeg';
            return 'data:' . $mime . ';base64,' . base64_encode($raw);
        }

        return null;
    }
}
