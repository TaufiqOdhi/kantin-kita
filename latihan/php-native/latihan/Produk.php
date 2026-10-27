<?php

declare(strict_types=1);

namespace Latihan;

class Produk
{
    public function __construct(public string $nama, private int $harga) {}

    public function subtotal(int $jumlah): int
    {
        if ($jumlah < 1) {
            throw new \InvalidArgumentException('Jumlah minimal 1');
        }

        return $this->harga * $jumlah;
    }
}
$p = new Produk('Kopi Flores', 15000);
echo $p->subtotal(2).PHP_EOL; // 30000
