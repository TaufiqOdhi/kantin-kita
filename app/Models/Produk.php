<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produk extends Model
{
    protected $table = 'produk';

    protected $fillable = ['kategori_id', 'sku', 'nama', 'harga', 'stok'];

    protected $casts = ['harga' => 'integer', 'stok' => 'integer'];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function detailTransaksi(): HasMany
    {
        return $this->hasMany(DetailTransaksi::class, 'produk_id');
    }

    public function scopeCari(Builder $query, string $kataKunci): Builder
    {
        return $query->when($kataKunci !== '', function (Builder $query) use ($kataKunci) {
            $query->where(function (Builder $query) use ($kataKunci) {
                $query->where('nama', 'like', '%'.$kataKunci.'%')
                    ->orWhere('sku', 'like', '%'.$kataKunci.'%');
            });
        });
    }
}
