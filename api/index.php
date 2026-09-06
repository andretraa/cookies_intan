<?php

// Ensure /tmp storage directories exist for Vercel serverless environment
$tmpStorage = '/tmp/storage';
if (!file_exists($tmpStorage)) {
    @mkdir($tmpStorage . '/framework/views', 0755, true);
    @mkdir($tmpStorage . '/framework/sessions', 0755, true);
    @mkdir($tmpStorage . '/framework/cache', 0755, true);
    @mkdir($tmpStorage . '/logs', 0755, true);
}

// ============================================================
// VERCEL SERVERLESS: Force-set all critical environment vars
// unconditionally BEFORE Laravel reads any config.
// This ensures empty-string env values from Vercel are replaced.
// ============================================================
$forceEnv = function ($key, $val) {
    putenv("{$key}={$val}");
    $_ENV[$key] = $val;
    $_SERVER[$key] = $val;
};

// App
if (empty(getenv('APP_KEY'))) {
    $forceEnv('APP_KEY', 'base64:VNxlKyGHR0nxDa9xB2Pa1MA5KFQ3Bex1SlFpL0DZS+s=');
}
$forceEnv('APP_ENV', 'production');
$forceEnv('APP_DEBUG', 'true');

// Set APP_URL dynamically from request so asset() generates correct HTTPS URLs
// This is critical for CSS/JS to load correctly on Vercel (HTTPS)
$host = $_SERVER['HTTP_HOST']
    ?? $_SERVER['HTTP_X_FORWARDED_HOST']
    ?? getenv('VERCEL_URL')
    ?? 'localhost';
$proto = $_SERVER['HTTP_X_FORWARDED_PROTO']
    ?? ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https' : 'http');
// On Vercel, always use https
if (str_contains($host, 'vercel.app') || str_contains($host, 'vercel.com') || (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] === 'https')) {
    $proto = 'https';
    $_SERVER['HTTPS'] = 'on';
    $_SERVER['SERVER_PORT'] = 443;
    $_SERVER['HTTP_X_FORWARDED_PROTO'] = 'https';
    $_SERVER['HTTP_X_FORWARDED_PORT'] = 443;
    $_SERVER['HTTP_X_FORWARDED_SSL'] = 'on';
}
$appUrl = $proto . '://' . $host;
$forceEnv('APP_URL', $appUrl);
$forceEnv('ASSET_URL', $appUrl);

// Maintenance mode — must NEVER be empty on Vercel
$forceEnv('APP_MAINTENANCE_DRIVER', 'file');
$forceEnv('APP_MAINTENANCE_STORE', 'file');

// Session — use 'cookie' driver so session data is stored in the browser cookie.
// On Vercel (serverless), each request may hit a different instance, so file-based sessions
// do NOT persist. The 'cookie' driver embeds session data directly in the signed/encrypted cookie.
$forceEnv('SESSION_DRIVER', 'cookie');
$forceEnv('SESSION_COOKIE', 'ci_session');
$forceEnv('SESSION_LIFETIME', '10080'); // 7 days in minutes (CRITICAL: prevents empty string from zeroing lifetime to 0 which kills cookies immediately)
$forceEnv('SESSION_EXPIRE_ON_CLOSE', 'false');
$forceEnv('SESSION_ENCRYPT', 'false'); // Let EncryptCookies middleware handle encryption (avoids double encryption & bloated headers)
$forceEnv('SESSION_PATH', '/');
$forceEnv('SESSION_DOMAIN', '');
$forceEnv('SESSION_SECURE_COOKIE', 'true');
$forceEnv('SESSION_SAME_SITE', 'lax');
$forceEnv('SESSION_HTTP_ONLY', 'true');

// Clear any bloated legacy cookies if present to prevent header bloat
$legacyCookies = ['laravel-session', 'cookies-intan-session', 'cookiesintan-session', 'laravel_session'];
foreach ($legacyCookies as $oldCookie) {
    if (isset($_COOKIE[$oldCookie])) {
        @setcookie($oldCookie, '', [
            'expires' => time() - 3600,
            'path' => '/',
            'secure' => true,
            'httponly' => true,
            'samesite' => 'Lax',
        ]);
        unset($_COOKIE[$oldCookie]);
    }
}

// Cache — must NEVER be empty or 'database' on Vercel
$forceEnv('CACHE_STORE', 'array');

// Queue — must NEVER try to use database on Vercel
$forceEnv('QUEUE_CONNECTION', 'sync');

// Hashing — use safe_bcrypt driver that never fails on serverless environments
$forceEnv('HASH_DRIVER', 'safe_bcrypt');

// Database — fallback to sqlite when running on Vercel (no MySQL available)
$sqliteDb = '/tmp/database.sqlite';
$bundledDb = __DIR__ . '/../database/database.sqlite';

$dbHost = $_ENV['DB_HOST'] ?? getenv('DB_HOST') ?? '';
if (empty($dbHost) || $dbHost === '127.0.0.1') {
    if (extension_loaded('pdo_sqlite')) {
        // Copy bundled pre-seeded database if /tmp database doesn't exist, is empty, or bundled DB is newer
        $shouldCopy = !file_exists($sqliteDb)
            || filesize($sqliteDb) < 5000
            || (file_exists($bundledDb) && filemtime($bundledDb) > filemtime($sqliteDb));
        if ($shouldCopy) {
            if (file_exists($bundledDb) && filesize($bundledDb) > 0) {
                @copy($bundledDb, $sqliteDb);
            } else {
                @touch($sqliteDb);
            }
        }

        // Safety verification: verify tables exist in /tmp/database.sqlite
        try {
            if (file_exists($sqliteDb) && filesize($sqliteDb) > 0) {
                $checkPdo = new PDO('sqlite:' . $sqliteDb);
                $checkPdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $tableCheck = $checkPdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='users'")->fetch();
                if (!$tableCheck && file_exists($bundledDb) && filesize($bundledDb) > 0) {
                    @copy($bundledDb, $sqliteDb);
                }
            }
        } catch (\Throwable $t) {
            // ignore
        }

        $forceEnv('DB_CONNECTION', 'sqlite');
        $forceEnv('DB_DATABASE', $sqliteDb);
    }
}

putenv('VIEW_COMPILED_PATH=' . $tmpStorage . '/framework/views');
putenv('APP_SERVICES_CACHE=' . $tmpStorage . '/services.php');
putenv('APP_PACKAGES_CACHE=' . $tmpStorage . '/packages.php');
putenv('APP_CONFIG_CACHE=' . $tmpStorage . '/config.php');
putenv('APP_ROUTES_CACHE=' . $tmpStorage . '/routes.php');
putenv('APP_EVENTS_CACHE=' . $tmpStorage . '/events.php');

define('LARAVEL_START', microtime(true));

try {
    // Register Composer autoloader
    require __DIR__ . '/../vendor/autoload.php';

    // Bootstrap Laravel
    /** @var \Illuminate\Foundation\Application $app */
    $app = require_once __DIR__ . '/../bootstrap/app.php';

    // Override storage path to /tmp/storage for Vercel read-only filesystem
    $app->useStoragePath($tmpStorage);

    // Handle request
    $app->handleRequest(\Illuminate\Http\Request::capture());
} catch (\Throwable $e) {
    http_response_code(200);
    echo '<div style="font-family: sans-serif; padding: 30px; line-height: 1.6; max-width: 800px; margin: 0 auto; color: #333;">';
    echo '<h2 style="color: #e53e3e;">⚠️ Laravel Deployment Notice</h2>';
    echo '<p><strong>Message:</strong> ' . htmlspecialchars($e->getMessage()) . '</p>';
    echo '<p><strong>File:</strong> ' . htmlspecialchars($e->getFile()) . ' <strong>Line:</strong> ' . $e->getLine() . '</p>';
    echo '<pre style="background: #f7fafc; padding: 15px; border-radius: 5px; border: 1px solid #e2e8f0; overflow-x: auto; font-size: 13px;">' . htmlspecialchars($e->getTraceAsString()) . '</pre>';
    echo '</div>';
    exit;
}



