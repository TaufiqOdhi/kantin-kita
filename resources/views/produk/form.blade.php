@extends('layouts.app')
@section('title', $produk->exists ? 'Ubah Produk' : 'Tambah Produk')
@section('content')
<h1>{{ $produk->exists ? 'Ubah produk' : 'Tambah produk' }}</h1>
<p>Masukkan harga dalam rupiah utuh, misalnya 5000.</p>
@if($errors->any())
    <p class="error" role="alert">Periksa isian yang ditandai. Data belum disimpan.</p>
@endif
@if($kategori->isEmpty())
    <p class="error">Kategori belum tersedia. Jalankan seeder terlebih dahulu.</p>
@endif
<form method="POST" class="product-form"
      action="{{ $produk->exists ? route('produk.update', $produk) : route('produk.store') }}">
    @csrf
    @if($produk->exists) @method('PUT') @endif
    @foreach(['sku' => 'SKU', 'nama' => 'Nama produk', 'harga' => 'Harga (Rp)', 'stok' => 'Stok'] as $field => $label)
        <div>
            <label for="{{ $field }}">{{ $label }}</label>
            <input id="{{ $field }}" name="{{ $field }}" required
                   type="{{ in_array($field, ['harga', 'stok']) ? 'number' : 'text' }}"
                   @if(in_array($field, ['harga', 'stok'])) min="0" max="4294967295" step="1"
                   @else maxlength="{{ $field === 'sku' ? 50 : 255 }}" @endif
                   value="{{ old($field, $produk->$field) }}"
                   aria-invalid="{{ $errors->has($field) ? 'true' : 'false' }}"
                   aria-describedby="{{ $field }}-error">
            <small id="{{ $field }}-error" class="error">@error($field){{ $message }}@enderror</small>
        </div>
    @endforeach
    <div>
        <label for="kategori_id">Kategori</label>
        <select id="kategori_id" name="kategori_id" required
                aria-invalid="{{ $errors->has('kategori_id') ? 'true' : 'false' }}"
                aria-describedby="kategori-error">
            <option value="">Pilih kategori</option>
            @foreach($kategori as $item)
                <option value="{{ $item->id }}" @selected(old('kategori_id', $produk->kategori_id) == $item->id)>
                    {{ $item->nama }}
                </option>
            @endforeach
        </select>
        <small id="kategori-error" class="error">@error('kategori_id'){{ $message }}@enderror</small>
    </div>
    <div class="actions">
        <button type="submit" @disabled($kategori->isEmpty())>Simpan produk</button>
        <a href="{{ route('produk.index') }}">Batal</a>
    </div>
</form>
@endsection
