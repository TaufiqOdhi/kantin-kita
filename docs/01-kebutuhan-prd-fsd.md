# Kebutuhan, PRD, dan FSD — Kantin Kita

Versi 1.0 · contoh pembelajaran · review mentor: BELUM DILAKUKAN.
Pemilik dan penjaga kantin adalah persona rekaan. Temuan wawancara nyata diisi siswa.

## Masalah dan tujuan
Harga dicari di buku, stok sulit dipantau, dan produk sering dicatat berulang.
Versi pertama membantu petugas melihat katalog dan memperbarui data barang.
Ukuran keberhasilan: 6 produk contoh tampil, CRUD valid tersimpan tepat, input
tidak valid ditolak tanpa perubahan DB, produk yang memiliki riwayat tidak terhapus.

## Pertanyaan wawancara (H4)
Siapa yang mencatat produk? Kapan stok dihitung? Apa penyebab data ganda?
Apa yang dilakukan ketika harga berubah? Apa bukti pencatatan sudah benar?
Pisahkan fakta hasil wawancara, asumsi, dan usulan fitur pada catatan kelompok.

## User stories dan prioritas
| ID | Sebagai pengguna, saya ingin... | Prioritas | Kriteria penerimaan |
|---|---|---|---|
| US-01 | melihat produk agar tahu harga/stok | Must | katalog menampilkan kategori, rupiah, Habis |
| US-02 | mencari nama/SKU agar cepat menemukan barang | Must | hasil cocok dan keadaan kosong jelas |
| US-03 | menambah produk agar katalog mutakhir | Must | satu data valid tersimpan |
| US-04 | mengubah harga/stok agar sesuai kondisi | Must | ID tetap, SKU sendiri diterima |
| US-05 | menghapus produk salah input | Must | konfirmasi, hanya tanpa riwayat |
| US-06 | memahami kesalahan input | Must | error per field, isian lain tetap |
| US-07 | memilih kategori agar barang terkelompok | Must | kategori harus terdaftar |
| US-08 | memakai keranjang agar dapat membeli beberapa barang | Could, lanjutan | gabungkan SKU, jumlah kumulatif <= stok |
| US-09 | membayar tunai agar memperoleh nota | Could, lanjutan | uang cukup, transaksi atomik, harga historis |
| US-10 | melihat omzet harian | Could, lanjutan | hitung dari transaksi tersimpan |

Kata pemilik/kasir menunjukkan persona rancangan. Baseline belum memiliki login.
Prioritas disepakati sebelum coding. Hasil online tidak menggantikan CRUD wajib.

## Scope
FEAT-01: katalog, pencarian, tambah, ubah, hapus, kategori, validasi.
FEAT-02: checkout dan akun/peran, setelah FEAT-01 lulus; belum diimplementasikan.
FEAT-03: laporan dari transaksi FEAT-02; belum diimplementasikan.
Barcode, pembayaran digital, pajak, diskon dan multi-cabang di luar versi pertama.

## FSD dan kontrak data
SKU: string, trim dan huruf besar sebelum validasi, wajib, unik, maksimal 50 karakter.
Nama: string, wajib, maksimal 255 karakter.
Kategori: integer merujuk kategori.id yang tersedia.
Harga/stok: integer 0–4294967295; harga dalam rupiah utuh tanpa pemisah ribuan.
Harga 0 dan stok 0 diizinkan pada contoh. Jumlah transaksi nanti harus >=1.
Field kode pada FSD H5 diseragamkan menjadi sku mengikuti H8/H9.
Batas FSD H5 contoh berbeda; dokumen proyek ini memakai batas H9 secara konsisten.
Kategori disiapkan seeder, bukan fitur CRUD kategori.

| Aksi | Route | Hasil |
|---|---|---|
| Lihat katalog | GET /katalog | daftar tanpa tombol pengelolaan |
| Daftar kelola | GET /produk | daftar dengan tombol tambah/ubah/hapus |
| Tambah | GET /produk/create, POST /produk | validasi -> create -> redirect |
| Ubah | GET /produk/{produk}/edit, PUT /produk/{produk} | binding -> validasi -> update |
| Hapus | DELETE /produk/{produk} | tolak bila sudah dirujuk detail transaksi |

KatalogController dan ProdukController memakai scope Produk::cari(),
eager loading kategori, dan pagination 10. PencarianProdukRequest memvalidasi kata kunci.
Pencarian nama/SKU memakai LIKE MySQL; kolasi contoh tidak peka huruf besar-kecil.
Sukses diarahkan kembali ke daftar agar refresh tidak mengirim ulang POST.
Gagal validasi mengembalikan pesan dan old input. ID tidak ada menghasilkan 404.
Hapus dibatasi foreign key, riwayat dipertahankan. Tidak ada cascade-delete riwayat.

## Kamus data
kategori: id PK, nama unik, timestamps.
produk: id PK, kategori_id FK wajib, sku unik, nama, harga uint, stok uint, timestamps.
transaksi: id PK, nomor unik, waktu, total unsigned bigint, timestamps.
detail_transaksi: id PK, transaksi_id FK, produk_id FK,
jumlah uint, harga_satuan uint, subtotal unsigned bigint, timestamps.
Tabel transaksi/detail disiapkan untuk belajar relasi; tidak berarti checkout sudah ada.

## Wireframe
Katalog: judul -> cari -> tabel SKU/nama/kategori/harga/stok -> halaman.
Kelola: katalog + tambah + aksi ubah/hapus.
Form: SKU -> nama -> harga -> stok -> kategori -> simpan/batal.
Error ditampilkan dekat isian. Habis ditulis sebagai teks, bukan warna saja.
Tidak ada tombol bayar karena proses pembayaran belum dibuat.

## Traceability
| Story | Implementasi | Bukti |
|---|---|---|
| US-01/02 | KatalogController::index, ProdukController::index, Produk::cari | QA-01/02/03 |
| US-03/06/07 | ProdukRequest, store, produk/form | QA-04/05/06/07 |
| US-04 | ProdukRequest unique ignore, update | QA-08/09 |
| US-05 | destroy, FK detail_transaksi | QA-10/11 |
| US-08/09/10 | backlog | belum diimplementasikan |
