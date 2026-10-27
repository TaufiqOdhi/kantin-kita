<?php

use App\Http\Controllers\KatalogController;
use App\Http\Controllers\KatalogLatihanController;
use App\Http\Controllers\ProdukController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/katalog');
Route::get('/katalog', [KatalogController::class, 'index'])->name('katalog');
Route::resource('produk', ProdukController::class)
    ->parameters(['produk' => 'produk'])->except(['show']);

Route::get('/belajar/array', [KatalogLatihanController::class, 'index'])->name('belajar.array');
Route::get('/sapa', fn () => 'Halo, Kelompok Kantin Kita!')->name('sapa');
