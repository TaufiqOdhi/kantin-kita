<?php

namespace Tests\Feature;

use App\Models\Kategori;
use App\Models\Produk;
use App\Models\Transaksi;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProdukTest extends TestCase
{
    use RefreshDatabase;

    private function dataProduk(array $ganti = []): array
    {
        $kategori = Kategori::firstOrCreate(['nama' => 'Makanan']);

        return array_replace(['sku' => 'UJI-001', 'nama' => 'Roti Uji',
            'kategori_id' => $kategori->id, 'harga' => 8000, 'stok' => 7], $ganti);
    }

    public function test_tambah_ubah_dengan_sku_tetap_dan_hapus(): void
    {
        $data = $this->dataProduk();
        $this->post('/produk', $data)->assertRedirect('/produk');
        $produk = Produk::firstOrFail();
        $this->put('/produk/'.$produk->id, array_replace($data, ['harga' => 9000]))
            ->assertRedirect('/produk')->assertSessionHasNoErrors();
        $this->assertDatabaseCount('produk', 1);
        $this->assertDatabaseHas('produk', ['id' => $produk->id, 'harga' => 9000]);
        $this->delete('/produk/'.$produk->id)->assertRedirect('/produk');
        $this->assertDatabaseCount('produk', 0);
    }

    public function test_input_salah_tidak_menyimpan_data(): void
    {
        foreach ([['nama' => ''], ['harga' => -1], ['stok' => '1.5'],
            ['kategori_id' => 999999]] as $salah) {
            $field = array_key_first($salah);
            $this->post('/produk', $this->dataProduk($salah))->assertSessionHasErrors($field);
        }
        $this->assertDatabaseCount('produk', 0);
    }

    public function test_sku_ganda_ditolak_pada_tambah_dan_ubah(): void
    {
        $data = $this->dataProduk();
        Produk::create($data);
        $lain = Produk::create($this->dataProduk(['sku' => 'UJI-002']));
        $this->post('/produk', $data)->assertSessionHasErrors('sku');
        $this->put('/produk/'.$lain->id, $data)->assertSessionHasErrors('sku');
        $this->assertDatabaseCount('produk', 2);
        $this->assertSame('UJI-002', $lain->fresh()->sku);
    }

    public function test_harga_dan_stok_nol_diterima(): void
    {
        $this->post('/produk', $this->dataProduk(['harga' => 0, 'stok' => 0]))
            ->assertSessionHasNoErrors();
        $this->assertDatabaseHas('produk', ['harga' => 0, 'stok' => 0]);
    }

    public function test_sku_dinormalisasi_dan_input_lama_dipertahankan(): void
    {
        $this->post('/produk', $this->dataProduk(['sku' => '  uji-001  ']))
            ->assertSessionHasNoErrors();
        $this->assertDatabaseHas('produk', ['sku' => 'UJI-001']);
        $data = $this->dataProduk(['sku' => 'uji-001', 'nama' => 'Produk Baru']);
        $this->from('/produk/create')->post('/produk', $data)
            ->assertRedirect('/produk/create')->assertSessionHasErrors('sku')
            ->assertSessionHasInput('nama', 'Produk Baru');
        $this->assertDatabaseCount('produk', 1);
    }

    public function test_batas_angka_dan_panjang_field_divalidasi(): void
    {
        foreach ([['harga' => 4294967296], ['stok' => 4294967296],
            ['sku' => str_repeat('A', 51)], ['nama' => str_repeat('A', 256)]] as $salah) {
            $this->post('/produk', $this->dataProduk($salah))
                ->assertSessionHasErrors(array_key_first($salah));
        }
        $this->assertDatabaseCount('produk', 0);
        $this->post('/produk', $this->dataProduk(['harga' => 4294967295, 'stok' => 4294967295]))
            ->assertSessionHasNoErrors();
        $this->assertDatabaseHas('produk', ['harga' => 4294967295, 'stok' => 4294967295]);
    }

    public function test_katalog_pencarian_stok_dan_escaping(): void
    {
        Produk::create($this->dataProduk(['nama' => '<script>alert(1)</script>', 'stok' => 0]));
        Produk::create($this->dataProduk(['sku' => 'NAS-001', 'nama' => 'Nasi']));
        $this->get('/katalog')->assertOk()->assertSee('Habis')
            ->assertSee('&lt;script&gt;', false)->assertDontSee('<script>alert(1)</script>', false);
        $this->get('/katalog?q=NAS-001')->assertOk()->assertSee('Nasi')->assertDontSee('UJI-001');
        $this->get('/katalog?q=zzzz')->assertOk()->assertSee('Produk tidak ditemukan.');
        $this->get('/produk/999999/edit')->assertNotFound();
    }

    public function test_produk_dengan_riwayat_tidak_dihapus(): void
    {
        $produk = Produk::create($this->dataProduk());
        $transaksi = Transaksi::create([
            'nomor' => 'UJI-TRX-01', 'waktu' => now(), 'total' => 8000,
        ]);
        $detail = $transaksi->detail()->create([
            'produk_id' => $produk->id,
            'jumlah' => 1, 'harga_satuan' => 8000, 'subtotal' => 8000,
        ]);
        $this->assertTrue($detail->produk->is($produk));
        $this->assertTrue($detail->transaksi->is($transaksi));
        $this->assertSame(1, $produk->detailTransaksi()->count());
        $this->delete('/produk/'.$produk->id)->assertSessionHas('error');
        $this->assertDatabaseHas('produk', ['id' => $produk->id]);
        $this->assertDatabaseCount('detail_transaksi', 1);
    }

    public function test_seed_ulang_tidak_menduplikasi_atau_mereset_edit(): void
    {
        $this->seed();
        $produk = Produk::where('sku', 'KOP-001')->firstOrFail();
        $produk->update(['harga' => 16000, 'stok' => 4]);
        $this->seed();
        $this->assertDatabaseCount('kategori', 3);
        $this->assertDatabaseCount('produk', 6);
        $this->assertDatabaseHas('produk', ['sku' => 'KOP-001', 'harga' => 16000, 'stok' => 4]);
    }
}
