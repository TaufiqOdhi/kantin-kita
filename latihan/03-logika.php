<?php

declare(strict_types=1);

// Jalankan dari root proyek: php latihan/03-logika.php
// Tidak terhubung database. Harga rupiah menggunakan integer.
function hitungBelanja(array $keranjang, int $uang): array
{
    if ($keranjang === []) {
        throw new InvalidArgumentException('Keranjang kosong.');
    }
    $total = 0;
    foreach ($keranjang as $item) {
        foreach (['harga', 'jumlah', 'stok'] as $field) {
            if (! isset($item[$field]) || ! is_int($item[$field])) {
                throw new InvalidArgumentException('Harga, jumlah, dan stok harus integer.');
            }
        }
        if ($item['harga'] < 0 || $item['jumlah'] < 1 || $item['jumlah'] > $item['stok']) {
            throw new InvalidArgumentException('Harga atau jumlah tidak valid; periksa stok.');
        }
        $total += $item['harga'] * $item['jumlah'];
    }
    if ($uang < $total) {
        throw new InvalidArgumentException('Uang kurang Rp '.($total - $uang));
    }

    return ['total' => $total, 'kembalian' => $uang - $total];
}

$keranjang = [
    ['nama' => 'Roti', 'harga' => 8000, 'jumlah' => 2, 'stok' => 7],
    ['nama' => 'Teh Kotak', 'harga' => 5000, 'jumlah' => 1, 'stok' => 3],
];
try {
    print_r(hitungBelanja($keranjang, 25000)); // total 21000, kembalian 4000
} catch (InvalidArgumentException $e) {
    echo $e->getMessage().PHP_EOL;
}
// Tugas: coba jumlah 0, jumlah melebihi stok, uang kurang, dan keranjang kosong.
// Data contoh harus memiliki satu baris per produk. Penggabungan SKU menjadi tugas lanjutan.
