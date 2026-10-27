<?php

declare(strict_types=1);

final class ProdukLatihan
{
    public function __construct(
        public string $nama,
        private int $harga,
        private int $stok,
    ) {
        if ($harga < 0 || $stok < 0) {
            throw new InvalidArgumentException('Harga dan stok tidak boleh negatif.');
        }
    }

    public function subtotal(int $jumlah): int
    {
        if ($jumlah < 1 || $jumlah > $this->stok) {
            throw new InvalidArgumentException('Jumlah tidak sesuai stok.');
        }

        return $this->harga * $jumlah;
    }
}

$roti = new ProdukLatihan('Roti', 8000, 7);
echo $roti->subtotal(2).PHP_EOL; // 16000
// Tugas: tambah method stokTersedia(), lalu jelaskan public dan private.
// Perhitungan ini tidak menyimpan transaksi atau mengurangi stok di database.
