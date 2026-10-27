# Verifikasi lokal

Pemeriksaan pada 27 Oktober 2026, PHP 8.4.27, Laravel 12.70.2, SQLite.

| Pemeriksaan | Hasil |
|---|---|
| `composer test` | 14 tes lulus, 97 assertions |
| `php artisan view:cache` | Seluruh Blade berhasil dikompilasi |
| `vendor/bin/pint --test` | Lulus |
| Pemeriksaan sintaks PHP | 49 berkas valid |
| `composer check-platform-reqs` | Kebutuhan runtime terpenuhi |
| HTTP ke server Laravel | 8 pemeriksaan lulus |
| Latihan logika CLI | Total 21000, kembalian 4000 |
| Latihan OOP CLI | Subtotal 16000 |
| Git ignore | `.env`, SQLite, vendor, dan konfigurasi native pribadi diabaikan |

Tes HTTP memeriksa halaman dan aset, penolakan token CSRF yang hilang,
validasi stok negatif, tambah produk, escaping HTML, ubah harga, pencarian,
serta hapus produk. Produk sementara untuk pengujian dihapus kembali;
database aplikasi tetap berisi 3 kategori dan 6 produk contoh.

Tes fitur memakai SQLite dalam memori dan memaksa konfigurasi database tes
agar tidak memakai variabel database sistem atau data aplikasi.

Workflow GitHub Actions telah disediakan untuk PHP 8.2 dan 8.4. Workflow tersebut
baru berjalan setelah repository dipush ke GitHub; hasil di atas adalah hasil lokal.
Jalur MySQL, konfirmasi browser, tampilan responsif, dan keyboard tetap diperiksa
oleh guru/kelompok menggunakan matriks QA.
