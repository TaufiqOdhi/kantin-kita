<?php

namespace Tests\Feature;

use Tests\TestCase;

class LatihanKatalogTest extends TestCase
{
    public function test_katalog_array_berjalan_tanpa_migration_database(): void
    {
        $this->get('/belajar/array')->assertOk()->assertSee('Kopi Ende')->assertSee('Habis');
        $this->get('/belajar/array?q=ROTI')->assertOk()->assertSee('Roti')->assertDontSee('Kopi Ende');
        $this->get('/belajar/array?q=xyz')->assertOk()->assertSee('Produk tidak ditemukan.');
        $this->get('/sapa')->assertOk()->assertSee('Halo, Kelompok Kantin Kita!');
    }
}
