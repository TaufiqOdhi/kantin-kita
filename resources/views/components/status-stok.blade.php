@props(['stok'])
@if($stok > 0)
    <span class="badge">{{ $stok }} tersedia</span>
@else
    <span class="badge habis">Habis</span>
@endif
