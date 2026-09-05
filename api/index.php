<?php

// Ensure /tmp storage directories exist for Vercel serverless environment
$tmpStorage = '/tmp/storage';
if (!file_exists($tmpStorage)) {
    @mkdir($tmpStorage . '/framework/views', 0755, true);
    @mkdir($tmpStorage . '/framework/sessions', 0755, true);
    @mkdir($tmpStorage . '/framework/cache', 0755, true);
    @mkdir($tmpStorage . '/logs', 0755, true);
}

// Helper to set environment variable across getenv, $_ENV, and $_SERVER
$setEnv = function ($key, $val) {
    if (empty($_ENV[$key]) && empty($_SERVER[$key]) && getenv($key) === false) {
        putenv("{$key}={$val}");
        $_ENV[$key] = $val;
        $_SERVER[$key] = $val;
    }
};

$setEnv('APP_KEY', 'base64:VNxlKyGHR0nxDa9xB2Pa1MA5KFQ3Bex1SlFpL0DZS+s=');
$setEnv('APP_ENV', 'production');
$setEnv('APP_DEBUG', 'true');
$setEnv('SESSION_DRIVER', 'cookie');
$setEnv('CACHE_STORE', 'array');

// If DB_HOST is unset or localhost on Vercel, fallback DB_CONNECTION to sqlite if available
$sqliteDb = '/tmp/database.sqlite';
if (!file_exists($sqliteDb)) {
    @touch($sqliteDb);
}
$dbHost = getenv('DB_HOST') ?: ($_ENV['DB_HOST'] ?? null);
if ((empty($dbHost) || $dbHost === '127.0.0.1') && extension_loaded('pdo_sqlite')) {
    putenv("DB_CONNECTION=sqlite");
    $_ENV['DB_CONNECTION'] = 'sqlite';
    $_SERVER['DB_CONNECTION'] = 'sqlite';
    putenv("DB_DATABASE={$sqliteDb}");
    $_ENV['DB_DATABASE'] = $sqliteDb;
    $_SERVER['DB_DATABASE'] = $sqliteDb;
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



