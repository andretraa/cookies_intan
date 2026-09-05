<?php

// Forward Vercel requests to normal index.php
// Set storage path for compiled Blade views and caches to /tmp for Vercel serverless environment
if (!getenv('VIEW_COMPILED_PATH')) {
    putenv('VIEW_COMPILED_PATH=/tmp');
}
if (!getenv('APP_SERVICES_CACHE')) {
    putenv('APP_SERVICES_CACHE=/tmp/services.php');
}
if (!getenv('APP_PACKAGES_CACHE')) {
    putenv('APP_PACKAGES_CACHE=/tmp/packages.php');
}
if (!getenv('APP_CONFIG_CACHE')) {
    putenv('APP_CONFIG_CACHE=/tmp/config.php');
}
if (!getenv('APP_ROUTES_CACHE')) {
    putenv('APP_ROUTES_CACHE=/tmp/routes.php');
}
if (!getenv('APP_EVENTS_CACHE')) {
    putenv('APP_EVENTS_CACHE=/tmp/events.php');
}

require __DIR__ . '/../public/index.php';
