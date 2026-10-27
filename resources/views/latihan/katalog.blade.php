@extends('layouts.app')
@section('title', 'Latihan H7 — Array')
@section('content')
<h1>Latihan katalog dari array</h1>
<p>Data di halaman ini belum memakai database.</p>
<form method="GET" action="{{ route('belajar.array') }}" class="search">
    <label for="q">Cari produk</label>
    <input id="q" name="q" value="{{ $q }}" maxlength="100">
    <button>Cari</button>
    @error('q')<p class="error">{{ $message }}</p>@enderror
</form>
@forelse($produk as $item)
    <p>{{ $item['nama'] }} · {{ $item['kategori'] }} ·
       Rp {{ number_format($item['harga'], 0, ',', '.') }} ·
       <x-status-stok :stok="$item['stok']" /></p>
@empty
    <p>Produk tidak ditemukan.</p>
@endforelse
@endsection
