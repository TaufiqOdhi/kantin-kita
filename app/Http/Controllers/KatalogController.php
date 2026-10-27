<?php

namespace App\Http\Controllers;

use App\Http\Requests\PencarianProdukRequest;
use App\Models\Produk;
use Illuminate\View\View;

class KatalogController extends Controller
{
    public function index(PencarianProdukRequest $request): View
    {
        $q = $request->kataKunci();
        $produk = Produk::with('kategori')->cari($q)->orderBy('nama')
            ->paginate(10)->withQueryString();

        return view('produk.index', ['produk' => $produk, 'q' => $q, 'kelola' => false]);
    }
}
