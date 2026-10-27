<?php

declare(strict_types=1);
session_start();
require __DIR__.'/../vendor/autoload.php';
use App\Controllers\ProductController;
use App\Models\Product;

$_SESSION['token'] ??= bin2hex(random_bytes(32));
$c = require __DIR__.'/../config.php';
try {
    $db = new PDO($c['dsn'], $c['user'], $c['password'], [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false]);
    (new ProductController(new Product($db)))->index();
} catch (PDOException $e) {
    error_log($e->getMessage());
    http_response_code(500);
    echo 'Database gagal diakses. Periksa konfigurasi dan log server.';
}
