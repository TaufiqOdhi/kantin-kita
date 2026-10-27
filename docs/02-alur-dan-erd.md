# Algoritma, flowchart, dan ERD

## Alur utama versi pertama
Browser -> routes/web.php -> KatalogController/ProdukController -> Produk/Kategori -> database.
Jalur cepat memakai SQLite; jalur MySQL tersedia untuk praktik sesuai materi H8/H9.
Controller mengirim data ke Blade -> HTML kembali ke browser.
Composer menyediakan autoloader; vendor dikelola dependensi.

## Flowchart simpan produk
~~~mermaid
flowchart TD
    A([Mulai]) --> B[/Isi form produk/]
    B --> C{Token CSRF valid?}
    C -- Tidak --> D[Permintaan ditolak]
    C -- Ya --> E{Input dan SKU valid?}
    E -- Tidak --> F[Tampilkan error dan isian lama]
    F --> B
    E -- Ya --> G[Simpan melalui Eloquent]
    G --> H[Redirect daftar dan pesan sukses]
    H --> I([Selesai])
~~~

## Flowchart transaksi untuk latihan H2/H3
Ini rancangan lanjutan; latihan/03-logika.php hanya menghitung contoh di memori.
Akun/peran, penyimpanan, rollback, dan penggabungan SKU belum dibuat.
~~~mermaid
flowchart TD
    A([Mulai]) --> B[Siapkan keranjang kosong]
    B --> C[/Pilih produk dan jumlah/]
    C --> D{Jumlah bulat positif dan stok cukup?}
    D -- Tidak --> C
    D -- Ya --> E[Gabungkan jumlah SKU dalam keranjang]
    E --> F{Tambah barang?}
    F -- Ya --> C
    F -- Tidak --> G[Hitung total]
    G --> H[/Masukkan uang/]
    H --> I{Uang cukup?}
    I -- Tidak --> H
    I -- Ya --> J[Simpan transaksi, detail, dan stok secara atomik]
    J --> K{Berhasil?}
    K -- Tidak --> L[Rollback seluruh perubahan]
    K -- Ya --> M[Tampilkan nota dan kembalian]
    L --> N([Selesai])
    M --> N
~~~
Tambahkan jalur batal pada rancangan kelompok. Stok diperiksa ulang dalam
transaksi database; jangan memakai stok dari tampilan sebagai sumber kebenaran.

## ERD
~~~mermaid
erDiagram
    KATEGORI ||--o{ PRODUK : memiliki
    PRODUK ||--o{ DETAIL_TRANSAKSI : dirujuk
    TRANSAKSI ||--|{ DETAIL_TRANSAKSI : berisi
~~~
Satu produk wajib memiliki satu kategori. Detail menyimpan harga saat dijual
agar nota lama tidak berubah ketika harga master berubah.
Induk dibuat dahulu, anak dihapus dahulu ketika rollback.
