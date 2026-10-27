<?php

namespace Tests\Feature;

use App\Models\Kategori;
use App\Models\Produk;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class KatalogTest extends TestCase
{
    use RefreshDatabase;

    public function test_halaman_awal_mengarah_ke_katalog(): void
    {
        $this->get('/')->assertRedirect('/katalog');
    }

    public function test_katalog_menampilkan_data_seed_dan_kondisi_kosong(): void
    {
        $this->get('/katalog')->assertOk()->assertSee('Produk tidak ditemukan.');
        $this->seed();
        $this->get('/katalog')->assertOk()->assertSee('Kopi Ende')->assertSee('Minuman')
            ->assertSee('Rp 15.000')->assertSee('Habis')->assertDontSee('+ Tambah produk');
        $this->get('/produk')->assertOk()->assertSee('+ Tambah produk');
    }

    public function test_pagination_mempertahankan_kata_kunci(): void
    {
        $kategori = Kategori::create(['nama' => 'Makanan']);
        for ($i = 1; $i <= 12; $i++) {
            Produk::create(['kategori_id' => $kategori->id, 'sku' => 'ROTI-'.$i,
                'nama' => sprintf('Roti %02d', $i), 'harga' => 8000, 'stok' => 3]);
        }
        Produk::create(['kategori_id' => $kategori->id, 'sku' => 'NASI-01',
            'nama' => 'Nasi', 'harga' => 18000, 'stok' => 5]);

        $this->get('/katalog?q=roti')->assertOk()->assertSee('12 produk ditemukan')
            ->assertSee('q=roti&amp;page=2', false)->assertDontSee('NASI-01');
        $this->get('/katalog?q=roti&page=2')->assertOk()->assertSee('Roti 11')
            ->assertSee('Roti 12')->assertDontSee('Roti 01');
    }

    public function test_pencarian_array_ditolak_tanpa_error_server(): void
    {
        $this->get('/katalog?q[]=roti')->assertSessionHasErrors('q');
    }
}
