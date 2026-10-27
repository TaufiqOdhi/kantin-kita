@extends('layouts.app')
@section('title', $kelola ? 'Kelola Produk' : 'Katalog Kantin')
@section('content')
<div class="heading">
    <div>
        <p class="eyebrow">KANTIN KITA</p>
        <h1>{{ $kelola ? 'Kelola produk' : 'Mau beli apa hari ini?' }}</h1>
        <p>Harga dan stok kantin sekolah dalam satu tempat.</p>
    </div>
    @if($kelola)
        <a class="button" href="{{ route('produk.create') }}">+ Tambah produk</a>
    @endif
</div>
<form method="GET" action="{{ $kelola ? route('produk.index') : route('katalog') }}" class="search">
    <label for="q">Cari nama atau SKU</label>
    <input id="q" name="q" value="{{ $q }}" maxlength="100" placeholder="Contoh: roti">
    <button type="submit">Cari</button>
    <a href="{{ $kelola ? route('produk.index') : route('katalog') }}">Reset</a>
    @error('q')<p class="error">{{ $message }}</p>@enderror
</form>
<div class="table-wrap">
<table>
    <caption>{{ $produk->total() }} produk ditemukan</caption>
    <thead><tr>
        <th scope="col">SKU</th><th scope="col">Produk</th><th scope="col">Kategori</th>
        <th scope="col">Harga</th><th scope="col">Stok</th>
        @if($kelola)<th scope="col">Aksi</th>@endif
    </tr></thead>
    <tbody>
    @forelse($produk as $item)
        <tr>
            <td>{{ $item->sku }}</td><td>{{ $item->nama }}</td>
            <td>{{ $item->kategori->nama }}</td>
            <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
            <td><x-status-stok :stok="$item->stok" /></td>
            @if($kelola)
            <td class="actions">
                <a href="{{ route('produk.edit', $item) }}">Ubah</a>
                <form method="POST" action="{{ route('produk.destroy', $item) }}"
                      data-confirm-delete>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="danger" aria-label="Hapus {{ $item->nama }}">Hapus</button>
                </form>
            </td>
            @endif
        </tr>
    @empty
        <tr><td colspan="{{ $kelola ? 6 : 5 }}">Produk tidak ditemukan.</td></tr>
    @endforelse
    </tbody>
</table>
</div>
<nav class="pagination" aria-label="Halaman produk">
    @if($produk->previousPageUrl())<a href="{{ $produk->previousPageUrl() }}">← Sebelumnya</a>@endif
    <span>Halaman {{ $produk->currentPage() }} / {{ $produk->lastPage() }}</span>
    @if($produk->nextPageUrl())<a href="{{ $produk->nextPageUrl() }}">Berikutnya →</a>@endif
</nav>
@endsection
