<?php

namespace Database\Seeders;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Database\Seeder;

class KatalogSeeder extends Seeder
{
    public function run(): void
    {
        foreach ([
            ['Minuman', 'KOP-001', 'Kopi Ende', 15000, 12],
            ['Minuman', 'TEH-001', 'Teh Kotak', 5000, 0],
            ['Makanan', 'ROT-001', 'Roti', 8000, 7],
            ['Makanan', 'NAS-001', 'Nasi Bungkus', 18000, 5],
            ['Alat Tulis', 'PEN-001', 'Pulpen', 3000, 20],
            ['Alat Tulis', 'BUK-001', 'Buku Tulis', 6000, 15],
        ] as [$namaKategori, $sku, $nama, $harga, $stok]) {
            $kategori = Kategori::firstOrCreate(['nama' => $namaKategori]);
            // Pengulangan seeder mempertahankan harga/stok yang diedit siswa.
            Produk::firstOrCreate(['sku' => $sku], [
                'kategori_id' => $kategori->id, 'nama' => $nama,
                'harga' => $harga, 'stok' => $stok,
            ]);
        }
    }
}
