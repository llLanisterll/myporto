<?php

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Vercel read-only filesystem fix for Laravel
$storagePath = '/tmp/storage';
if (!is_dir($storagePath)) {
    mkdir($storagePath . '/framework/views', 0777, true);
    mkdir($storagePath . '/framework/cache/data', 0777, true);
    mkdir($storagePath . '/framework/sessions', 0777, true);
    mkdir($storagePath . '/logs', 0777, true);
}
$_ENV['APP_STORAGE'] = $storagePath;

// Verify vendor exists
if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
    die('Error: vendor/autoload.php not found. Composer dependencies may not have been installed. Current directory: ' . __DIR__ . ' Contents: ' . implode(', ', scandir(__DIR__ . '/..')));
}

require __DIR__ . '/../public/index.php';