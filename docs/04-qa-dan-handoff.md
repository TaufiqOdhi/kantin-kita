# QA dan serah terima

Tes otomatis tersedia di tests/Feature dan dijalankan dengan composer test.
Matriks ini dipakai untuk mencatat hasil uji manual setiap kelompok.
Isi actual, lulus/gagal, bukti, pemeriksa, dan tanggal setelah mencoba.
Gunakan produk uji di database latihan.

| ID | Langkah | Expected |
|---|---|---|
| QA-01 | Buka katalog setelah seed | 6 produk, kategori tampil, rupiah |
| QA-02 | Cari KOP-001 lalu kata tanpa hasil | Kopi Ende lalu pesan kosong |
| QA-03 | Lihat Teh Kotak | Habis, bukan stok negatif |
| QA-04 | Tambah UJI-001 valid | tepat satu produk baru dan flash |
| QA-05 | Nama kosong, harga -1, stok 1.5 (uji terpisah) | error terkait, DB tidak berubah |
| QA-06 | Ulangi SKU yang sudah ada | ditolak, field lain tetap |
| QA-07 | Ubah kategori_id menjadi ID tak ada via DevTools | ditolak server |
| QA-08 | Edit harga dengan SKU sendiri | sukses, ID/jumlah baris tetap |
| QA-09 | Edit menjadi SKU milik produk lain | ditolak, data lama tetap |
| QA-10 | Hapus produk uji: Cancel lalu konfirmasi | cancel tetap, konfirmasi terhapus |
| QA-11 | Hapus produk yang dirujuk detail | ditolak, produk dan riwayat tetap |
| QA-12 | Harga 0 dan stok 0 | diterima sesuai FSD |
| QA-13 | Nama berupa tag script | ditampilkan sebagai teks, tidak dieksekusi |
| QA-14 | Hapus token CSRF dari form melalui DevTools | request ditolak (419) |
| QA-15 | Refresh halaman setelah simpan | tidak menggandakan produk |
| QA-16 | ID edit tidak ada | 404 |
| QA-17 | Seed ulang setelah edit harga | tidak duplikat dan edit tetap |
| QA-18 | Lebih dari 10 produk, cari lalu ganti halaman | navigasi menjaga query |
| QA-19 | Lebar layar kecil dan navigasi keyboard | form/navigasi dapat digunakan |

Format hasil: ID | expected | actual | status | bukti | pemeriksa | tanggal.
QA-11 memerlukan fixture transaksi/detail seperti pada ProdukTest.
Pengujian otomatis memakai SQLite memory agar terpisah dari data MySQL latihan.
Jalankan juga QA pada MySQL untuk memastikan foreign key dan kolasi.
Dialog konfirmasi, keyboard, layout, dan CSRF harus diperiksa lewat browser.

## Catatan bug
ID/story:
Langkah reproduksi:
Expected:
Actual:
Bukti:
Dampak/prioritas:
PIC dan tenggat:
Perbaikan dan hasil uji ulang:

## Handoff kelompok
Versi/commit:
Nama kelompok dan anggota/peran:
URL board dan kanal:
Cara install, versi PHP/Laravel/MySQL:
PRD/FSD versi dan status review:
Fitur sesuai / sebagian / belum:
Hasil QA dan tautan bukti:
Known issues:
Backlog berikut, dependensi, PIC, tenggat:
Kontribusi setiap siswa:
Pemeriksa dan tanggal:

Source mencakup composer.lock hasil instalasi. .env pribadi tidak disertakan.
Untuk paket offline, mentor menyiapkan vendor yang cocok dengan PC lab,
lalu memeriksa arsip pada komputer tanpa internet.
