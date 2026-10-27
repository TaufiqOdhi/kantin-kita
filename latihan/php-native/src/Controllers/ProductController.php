<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Product;

final class ProductController
{
    public function __construct(private Product $model) {}

    public function index(): void
    {
        $errors = [];
        $old = ['name' => '', 'price' => '', 'stock' => ''];
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            foreach ($old as $key => $v) {
                $value = $_POST[$key] ?? '';
                $old[$key] = is_string($value) ? trim($value) : '';
            }
            $token = $_POST['token'] ?? null;
            if (! is_string($token) || ! hash_equals($_SESSION['token'], $token)) {
                $errors[] = 'Token tidak valid; muat ulang form.';
            }
            if ($old['name'] === '' || strlen($old['name']) > 100) {
                $errors[] = 'Nama wajib diisi, maksimal 100 byte.';
            }
            $price = filter_var($old['price'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 0, 'max_range' => 4294967295]]);
            $stock = filter_var($old['stock'], FILTER_VALIDATE_INT, ['options' => ['min_range' => 0, 'max_range' => 4294967295]]);
            if ($price === false) {
                $errors[] = 'Harga harus bilangan bulat 0 sampai 4294967295.';
            }
            if ($stock === false) {
                $errors[] = 'Stok harus bilangan bulat 0 sampai 4294967295.';
            }
            if (! $errors) {
                $this->model->create($old['name'], $price, $stock);
                $_SESSION['flash'] = 'Produk tersimpan.';
                header('Location: index.php');
                exit;
            }
        }
        $products = $this->model->all();
        $flash = $_SESSION['flash'] ?? '';
        unset($_SESSION['flash']);
        require __DIR__.'/../../views/products.php';
    }
}
