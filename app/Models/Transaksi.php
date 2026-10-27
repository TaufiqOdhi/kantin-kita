<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaksi extends Model
{
    protected $table = 'transaksi';

    protected $fillable = ['nomor', 'waktu', 'total'];

    protected $casts = ['waktu' => 'datetime', 'total' => 'integer'];

    public function detail(): HasMany
    {
        return $this->hasMany(DetailTransaksi::class, 'transaksi_id');
    }
}
