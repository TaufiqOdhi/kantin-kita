<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KatalogLatihanController extends Controller
{
    public function index(Request $request)
    {
        $input = $request->validate(['q' => ['nullable', 'string', 'max:100']]);
        $q = trim($input['q'] ?? '');
        $produk = [
            ['nama' => 'Kopi Ende', 'kategori' => 'Minuman', 'harga' => 15000, 'stok' => 12],
            ['nama' => 'Teh Kotak', 'kategori' => 'Minuman', 'harga' => 5000, 'stok' => 0],
            ['nama' => 'Roti', 'kategori' => 'Makanan', 'harga' => 8000, 'stok' => 7],
            ['nama' => 'Buku Tulis', 'kategori' => 'Alat Tulis', 'harga' => 6000, 'stok' => 15],
        ];
        $produk = array_values(array_filter($produk,
            fn (array $item) => $q === '' || stripos($item['nama'], $q) !== false));

        return view('latihan.katalog', compact('produk', 'q'));
    }
}
