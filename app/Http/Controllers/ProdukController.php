<?php

namespace App\Http\Controllers;

use App\Http\Requests\PencarianProdukRequest;
use App\Http\Requests\ProdukRequest;
use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProdukController extends Controller
{
    public function index(PencarianProdukRequest $request): View
    {
        $q = $request->kataKunci();
        $produk = Produk::with('kategori')->cari($q)->orderBy('nama')
            ->paginate(10)->withQueryString();

        return view('produk.index', ['produk' => $produk, 'q' => $q, 'kelola' => true]);
    }

    public function create(): View
    {
        return view('produk.form', ['produk' => new Produk,
            'kategori' => Kategori::orderBy('nama')->get()]);
    }

    public function store(ProdukRequest $request): RedirectResponse
    {
        Produk::create($request->validated());

        return to_route('produk.index')->with('success', 'Produk ditambahkan.');
    }

    public function edit(Produk $produk): View
    {
        return view('produk.form', ['produk' => $produk,
            'kategori' => Kategori::orderBy('nama')->get()]);
    }

    public function update(ProdukRequest $request, Produk $produk): RedirectResponse
    {
        $produk->update($request->validated());

        return to_route('produk.index')->with('success', 'Produk diperbarui.');
    }

    public function destroy(Produk $produk): RedirectResponse
    {
        if ($produk->detailTransaksi()->exists()) {
            return to_route('produk.index')->with('error',
                'Produk sudah memiliki riwayat transaksi dan tidak dapat dihapus.');
        }

        try {
            $produk->delete();
        } catch (QueryException $e) {
            $foreignKeyViolation = (int) ($e->errorInfo[1] ?? 0) === 1451
                || str_contains($e->getMessage(), 'FOREIGN KEY constraint failed');
            if (! $foreignKeyViolation) {
                throw $e;
            }

            return to_route('produk.index')->with('error',
                'Produk sedang dipakai transaksi dan tidak dapat dihapus.');
        }

        return to_route('produk.index')->with('success', 'Produk dihapus.');
    }
}
