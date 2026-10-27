# Kantin Kita

contoh Proyek: katalog dan pengelolaan produk
kantin/koperasi sekolah. Satu kasus dipakai dari analisis kebutuhan sampai aplikasi
dan serah terima, mengikuti materi hari 1–10.

## Fitur

- Katalog, pencarian nama/SKU, pagination, kategori, harga Rupiah, dan status stok.
- Tambah, ubah, dan hapus produk melalui form.
- Validasi server, SKU unik yang dinormalisasi menjadi huruf besar, pesan per field,
  serta pengembalian isian ketika validasi gagal.
- Penghapusan produk dengan riwayat transaksi ditolak; relasi dijaga foreign key.
- Data contoh: 3 kategori dan 6 produk. Seed ulang mempertahankan edit siswa.
- Latihan PHP dasar, OOP, PHP native dengan PDO/Composer/MVC, dan katalog array.

Target minimum onsite adalah **CRUD produk dan validasi**. Akun/peran, checkout,
pemotongan stok otomatis, nota, dan laporan menjadi pengembangan berikutnya.
Model serta tabel transaksi/detail disiapkan untuk materi relasi.
Katalog dan kelola merupakan dua tampilan; autentikasi belum diterapkan.

## Menjalankan

Prasyarat: PHP 8.2+ **64-bit**, Composer 2, dan ekstensi `pdo_sqlite`.
Untuk jalur MySQL, aktifkan `pdo_mysql` dan jalankan MySQL/MariaDB.
Instalasi dependensi pertama membutuhkan internet. CSS/JavaScript tersedia lokal,
tanpa Node, npm, Vite, atau CDN.

Dari folder yang berisi `artisan`:

```bash
composer install
composer setup
composer dev
```

`composer setup` digunakan saat instalasi awal: menyiapkan `.env`, APP_KEY,
berkas SQLite, migration, dan seeder. Untuk membuka lagi cukup `composer dev`.

Buka:

| Alamat | Kegunaan |
|---|---|
| http://127.0.0.1:8000/katalog | Katalog dari database |
| http://127.0.0.1:8000/produk | Tambah, ubah, dan hapus produk |
| http://127.0.0.1:8000/belajar/array | Tahap H7 tanpa query database |
| http://127.0.0.1:8000/sapa | Contoh route sederhana |

Cara manual sebagai pengganti `composer setup`:

```bash
cp .env.example .env
php -r "file_exists('database/database.sqlite') || touch('database/database.sqlite');"
php artisan key:generate
php artisan migrate --seed
php artisan serve
```

Di Windows, salin `.env.example` melalui Explorer atau gunakan
`Copy-Item .env.example .env` pada PowerShell. Pastikan ekstensi berkas tetap `.env`.

## Menggunakan MySQL sesuai materi H8/H9

1. Buat database latihan baru:

   ```sql
   CREATE DATABASE kasir_kantin CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
   ```

2. Salin `.env.mysql.example` menjadi `.env`, lalu sesuaikan user/password/port lokal.
3. Jalankan `php artisan key:generate`, `php artisan config:clear`, dan
   `php artisan migrate --seed`.
4. Jalankan server seperti biasa.

Variabel lingkungan sistem dapat menimpa `.env`. Jika muncul database yang tidak
sesuai, periksa `DB_CONNECTION`, `DB_DATABASE`, dan `DB_URL` di terminal/runner.
Hapus konfigurasi `DB_URL` SQLite lokal ketika beralih ke MySQL.
Gunakan database latihan terpisah untuk setiap kelompok.

## Struktur modular

```text
app/
  Http/
    Controllers/           # KatalogController, ProdukController, latihan array
    Requests/              # PencarianProdukRequest dan ProdukRequest
  Models/                  # Kategori, Produk, Transaksi, DetailTransaksi
database/
  migrations/              # Satu file per tabel; induk sebelum anak
  seeders/                 # DatabaseSeeder memanggil KatalogSeeder
resources/views/
  layouts/                 # Struktur HTML bersama
  components/              # Status stok yang dipakai ulang
  produk/                  # Daftar serta form tambah/ubah
  latihan/                 # Katalog menggunakan array
public/
  css/kantin.css
  js/kantin.js
routes/web.php
latihan/                   # CLI dasar/OOP serta proyek PHP native terpisah
tests/Feature/             # Tes perilaku HTTP, validasi, relasi, dan seeder
docs/                      # Kebutuhan, PRD/FSD, diagram, kegiatan kelas, QA
.github/workflows/tests.yml
```

Alur simpan: **route → Form Request → controller → model → database → redirect**.
Blade hanya menampilkan data dan form. Logika pencarian dipakai ulang melalui
scope model, sedangkan aturan input berada di Form Request.
Migration bisnis dibuat terpisah dari tabel bawaan Laravel.

## Latihan dan panduan kelas

```bash
php latihan/03-logika.php
php latihan/06-oop.php
```

Hasil contoh: total **21000**, kembalian **4000**, dan subtotal OOP **16000**.
PHP native H6 memiliki konfigurasi, autoloader, dan database `kasir_h6` sendiri;
ikuti [README latihan](latihan/php-native/README.md).

- [Kebutuhan, user stories, PRD/FSD](docs/01-kebutuhan-prd-fsd.md)
- [Flowchart dan ERD](docs/02-alur-dan-erd.md)
- [Panduan kegiatan 10 hari](docs/03-panduan-10-hari.md)
- [QA, bug report, dan handoff](docs/04-qa-dan-handoff.md)
- [Sumber seluruh materi](docs/05-sumber.md)
- [Contoh tugas tim](docs/tugas.csv)

Laravel 12 dipakai konsisten dengan materi H8/H9; sumber H7 memakai Laravel 13.
Istilah `kode` pada FSD H5 diseragamkan menjadi `sku`.
Harga 0 diterima, harga/stok maksimum 4294967295; seluruh data adalah simulasi.

## Pemeriksaan

```bash
composer test
php artisan view:cache
vendor/bin/pint --test
```

Tes menggunakan SQLite dalam memori, terpisah dari data aplikasi.
Matriks CI menyiapkan PHP 8.2 dan 8.4. `composer.lock` disimpan dan dependensi
diselesaikan dengan target PHP 8.2 agar sesuai dengan kebutuhan minimum proyek.
Untuk merapikan kode PHP gunakan `composer format`.

Hasil pemeriksaan lokal dicatat di [catatan verifikasi](docs/06-verifikasi.md).

Dialog konfirmasi, layout layar kecil, dan navigasi keyboard diperiksa melalui
browser menggunakan skenario QA. MySQL tetap perlu diperiksa pada PC lab yang
memakai jalur MySQL.

## Menyimpan ke GitHub

Git sudah diinisialisasi pada branch `main`. Setelah membuat repository tujuan:

```bash
git add .
git commit -m "Tambah proyek pembelajaran Kantin Kita"
git remote add origin URL_REPOSITORY_ANDA
git push -u origin main
```

`vendor/`, `.env`, database SQLite, konfigurasi PHP native pribadi, log, dan cache
diabaikan oleh Git. `composer.json`, `composer.lock`, source, tes, contoh
konfigurasi, serta dokumentasi disertakan. Workflow tes siap dijalankan saat
repository dipush; publikasi dan push dilakukan pemilik repository.

## Kendala umum

| Gejala | Periksa |
|---|---|
| `php` tidak dikenal | PATH PHP CLI |
| `could not find driver` | Ekstensi pdo_sqlite/pdo_mysql pada PHP CLI |
| `Unknown database` | Nama database dan konfigurasi MySQL |
| SQLite `unable to open database file` | Berkas SQLite, izin tulis, dan variabel DB sistem |
| `No application encryption key` | `php artisan key:generate` |
| 419 pada form | Token CSRF, cookie/session, dan domain yang konsisten |
| Class tidak ditemukan | Namespace dan `composer dump-autoload` |

Untuk distribusi offline, guru menyiapkan arsip lengkap dengan `vendor/`
yang cocok dengan PHP/OS lab, contoh konfigurasi, dan petunjuk membuat APP_KEY.
Coba arsip pada komputer tanpa internet sebelum membagikannya.
