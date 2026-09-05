<?php

// Ensure /tmp storage directories exist for Vercel serverless environment
$tmpStorage = '/tmp/storage';
if (!file_exists($tmpStorage)) {
    @mkdir($tmpStorage . '/framework/views', 0755, true);
    @mkdir($tmpStorage . '/framework/sessions', 0755, true);
    @mkdir($tmpStorage . '/framework/cache', 0755, true);
    @mkdir($tmpStorage . '/logs', 0755, true);
}

// Fallback APP_KEY if not set in Vercel Environment Variables
if (!getenv('APP_KEY')) {
    putenv('APP_KEY=base64:VNxlKyGHR0nxDa9xB2Pa1MA5KFQ3Bex1SlFpL0DZS+s=');
}

// Enable APP_DEBUG by default so runtime errors display exact trace on Vercel
if (getenv('APP_DEBUG') === false) {
    putenv('APP_DEBUG=true');
}

// Safe session and cache driver fallbacks for serverless environment
if (!getenv('SESSION_DRIVER')) {
    putenv('SESSION_DRIVER=cookie');
}
if (!getenv('CACHE_STORE')) {
    putenv('CACHE_STORE=array');
}

// If DB_HOST is unset or localhost on Vercel, fallback DB_CONNECTION to sqlite
$sqliteDb = '/tmp/database.sqlite';
if (!file_exists($sqliteDb)) {
    @touch($sqliteDb);
}
if (!getenv('DB_HOST') || getenv('DB_HOST') === '127.0.0.1') {
    putenv('DB_CONNECTION=sqlite');
    putenv('DB_DATABASE=' . $sqliteDb);
}

putenv('VIEW_COMPILED_PATH=' . $tmpStorage . '/framework/views');
putenv('APP_SERVICES_CACHE=' . $tmpStorage . '/services.php');
putenv('APP_PACKAGES_CACHE=' . $tmpStorage . '/packages.php');
putenv('APP_CONFIG_CACHE=' . $tmpStorage . '/config.php');
putenv('APP_ROUTES_CACHE=' . $tmpStorage . '/routes.php');
putenv('APP_EVENTS_CACHE=' . $tmpStorage . '/events.php');

define('LARAVEL_START', microtime(true));

// Register Composer autoloader
require __DIR__ . '/../vendor/autoload.php';

// Bootstrap Laravel
/** @var \Illuminate\Foundation\Application $app */
$app = require_once __DIR__ . '/../bootstrap/app.php';

// Override storage path to /tmp/storage for Vercel read-only filesystem
$app->useStoragePath($tmpStorage);

// Handle request
$app->handleRequest(\Illuminate\Http\Request::capture());


