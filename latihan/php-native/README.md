# Praktik Hari ke-6 — PHP Native, OOP dan MVC
Senin, 16 November 2026; seluruh jadwal WITA. Aplikasi lokal untuk latihan, bukan sistem kasir produksi.

## Persiapan
PHP 8.2+ CLI, Composer, MySQL/MariaDB, ekstensi pdo_mysql. Cek `php -v`, `php -m`, `composer --version`. Pada Windows pastikan folder PHP masuk PATH. Tidak memerlukan paket eksternal atau CDN.
1. Buat database lewat phpMyAdmin: impor `database/schema.sql` satu kali ke server lokal. Pengulangan INSERT menambah data contoh lagi.
2. Salin `config.example.php` menjadi `config.php`, sesuaikan user/password/port MySQL. Bila memakai port lain, tambahkan `;port=3307` pada DSN.
3. Dari root proyek jalankan `composer dump-autoload`. Perintah ini membuat autoloader untuk kode lokal tanpa mengunduh library.
4. Jalankan `php -S 127.0.0.1:8000 -t public`. Buka http://127.0.0.1:8000/index.php. Terminal harus tetap terbuka.
5. Alternatif XAMPP: simpan folder di htdocs, jalankan Apache dan MySQL; buka http://localhost/nama-folder/public/index.php. Tetap buat autoloader pada langkah 3.

## Rute praktik
Sesi 1 08.00–09.30: bawa wireframe FSD; identifikasi heading, label, tabel, field name/price/stock; ubah CSS agar cocok dengan wireframe. Istirahat 09.30–09.45.
Sesi 2 09.45–11.30: kerjakan latihan/recap.php; telusuri form POST, validasi server, prepared INSERT dan SELECT. ISHOMA 11.30–12.30.
Sesi 3 12.30–13.15: jalankan `php latihan/Produk.php`; ubah objek, jelaskan constructor dan private; coba jumlah 0 dan jelaskan exception.
Sesi 4 13.15–14.00: petakan alur public/index.php → ProductController → Product → views/products.php; jelaskan beda tanggung jawab. Setiap siswa mengumpulkan latihan dan peta MVC.

## Skenario uji manual
- Tambah Teh, 5000, 0: tersimpan dan tampil; refresh setelah sukses tidak menggandakan INSERT.
- Nama kosong, harga -1, stok -1: ditolak. Harga 0 diterima sesuai FSD proyek ini. Gunakan DevTools untuk melewati batas HTML agar validasi server terbukti.
- Nama `<b>Teh</b>`: ditampilkan sebagai teks, bukan HTML.
- Nama `Kopi 'Ende'`: tersimpan tanpa merusak SQL.
- Token POST salah: ditolak; CSRF dijelaskan singkat sebagai pengayaan.
- Matikan MySQL: pesan generik tampil; rincian ada di terminal/log.

## Struktur dan peta MVC
public/index.php = bootstrap/entry point; membuat PDO, model, controller.
src/Controllers/ProductController.php = menerima input, validasi, memanggil model, memilih view.
src/Models/Product.php = membaca/menyimpan data produk dengan PDO.
views/products.php = HTML dan escaping tampilan.
Laravel H7: route → controller → Blade. H8: Eloquent + migration menggantikan akses data dan skema manual. H9: CRUD + Form Request. MVC di sini pola pengajaran sederhana, bukan framework.

## Kendala umum
`php` tidak dikenal: atur PATH PHP; `could not find driver`: aktifkan pdo_mysql pada php.ini CLI; `Access denied`: periksa user/password; `Unknown database`: impor SQL; `vendor/autoload.php` hilang: composer dump-autoload dari root; `Class not found`: cocokkan namespace dan nama file (huruf besar penting di Linux); port 8000 dipakai: gunakan 8001.
Jika Composer belum tersedia, mentor dapat memakai require_once untuk dua class sebagai demo sementara; tugas namespace/Composer tetap dituntaskan setelah alat siap. Jangan menghapus namespace.

## Batas latihan
Tidak ada login, edit/hapus, transaksi pembayaran atau pengurangan stok. FEAT-01 bagian tambah/lihat digunakan untuk recap. Jangan mencatat transaksi nyata. Harga integer rupiah; batas input latihan disesuaikan di server. Validasi browser tidak menggantikan validasi server.

Adaptasi proyek Kantin Kita: harga/stok integer 0–4294967295, sama dengan FSD baseline H9. Nama tetap maksimal 100 byte untuk contoh native. Gunakan PHP 64-bit.
