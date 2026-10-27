# Belajar melalui satu proyek, 10 hari

Setiap kelompok memakai produk yang sama dari problem sampai handoff.
Semua siswa tetap menulis dan menjelaskan kode meskipun peran utamanya berbeda.
Gunakan enam peran H1: PM, Analyst, UI/UX, Frontend, Backend, QA.
Daftar siswa, PIC, tenggat, dan nilai diisi dari kegiatan nyata.

## H1 — Software house dan Teaching Factory
Kenali masalah kantin. Tetapkan anggota/peran dan kesepakatan komunikasi.
Salin tugas dari tugas.csv secara manual ke Plane, atau gunakan papan offline.
Gunakan status To do -> In progress -> Review -> Done.
Bukti: daftar peran, tautan board, minimal tiga tugas dengan PIC/kriteria/bukti.
Cek individu: jelaskan satu hasil kerja dan siapa penerima hasil berikutnya.

## H2 — Algoritma dan flowchart
Baca docs/02-alur-dan-erd.md. Bedakan input, proses, keputusan, dan perulangan.
Gambar alur CRUD serta rancangan transaksi: stok 3 beli 2, stok 3 beli 4,
uang pas, uang kurang, keranjang kosong, dan pembatalan.
Bukti: file diagram edit + ekspor + hasil telusur expected/actual.
Cek individu: kapan stok boleh berkurang?

## H3 — Computational Thinking dan pemrograman dasar
Dekomposisi: produk, stok, hitung, pembayaran. Pola: harga x jumlah.
Abstraksi: harga/jumlah diperlukan; warna meja tidak. SKU disimpan string.
Jalankan php latihan/03-logika.php. Hasil awal total 21000 dan kembali 4000.
Ubah satu masukan setiap percobaan. Tulis tabel variabel sebelum/sesudah.
Bukti: lembar input-proses-output dan empat percobaan batas.
Cek individu: apa beda integer, string, boolean, float dan array?
Gunakan integer untuk uang; float dapat dicontohkan pada berat barang.

## H4 — Kebutuhan dan user stories
Simulasikan wawancara pemilik/penjaga kantin dengan pertanyaan docs/01.
Pisahkan masalah, fakta simulasi, asumsi, dan ide solusi.
Review 10 story, tandai Must/Should/Could/Won't, lalu tulis acceptance criteria.
Bukti: catatan wawancara, 10 story, prioritas, kriteria yang bisa diuji.
Cek individu: ubah keinginan 'aplikasi bagus' menjadi kebutuhan yang terukur.

## H5 — PRD dan FSD
Sesuaikan tujuan/scope pada docs/01; lengkapi flowchart, ERD, dan wireframe.
Pastikan istilah sku, batas angka, harga nol, dan kebijakan hapus konsisten.
Mentor memberi review; status contoh tidak otomatis berarti disetujui.
Bukti: PRD/FSD versi kelompok, keputusan review, pemetaan story -> field -> tes.
Cek individu: bedakan tujuan PRD dengan rincian teknis FSD.

## H6 — HTML/CSS, PHP, OOP, Composer, MVC
Baca HTML pada Blade dan CSS lokal. Telusuri form POST, validasi, dan redirect.
Jalankan php latihan/06-oop.php (hasil 16000); coba jumlah 0 dan stok berlebih.
Jelaskan constructor, property, method, public/private, dan exception.
Gunakan latihan/php-native/README.md untuk membandingkan PDO,
prepared statement, Composer PSR-4, controller, model, dan view tanpa Laravel.
Bukti: perubahan OOP, peta MVC, satu form HTML berlabel, catatan PDO vs Eloquent.
Cek individu: mengapa query tidak ditaruh dalam template?
Composer pada proyek utama memuat class App, bukan mengganti PHP.

## H7 — Laravel route, controller, Blade
Mulai dari salinan framework bersih Laravel 12 agar siswa menulis sendiri.
Buat GET /sapa; lanjutkan katalog dengan array empat produk, tanpa database.
Contoh array tersedia di /belajar/array dan KatalogLatihanController.
Gunakan framework 12 yang sama; jangan upgrade.
Tulis layout @yield/@section, @forelse, @if, dan komponen status stok.
Bukti: array katalog berjalan, route:list, kondisi kosong dan stok nol.
Cek individu: jelaskan request GET /katalog dari URL sampai HTML.
Solusi akhir proyek ini memakai database; /belajar/array adalah checkpoint terpisah.

## H8 — Database, migration, model, Eloquent
Buat DB latihan dan .env. Baca migration, hubungkan FK, jalankan migrate --seed.
Jelaskan Kategori hasMany Produk dan Produk belongsTo Kategori.
Verifikasi 3 kategori, 6 produk, 5 produk dengan stok >0; ulangi seed tanpa duplikasi.
Bandingkan sumber data array dengan query model dan with('kategori').
Bukti: migrate:status, diagram relasi, query Tinker, katalog database.
Cek individu: bedakan migration, model, dan seeder.
Empat migration bisnis dipisah per tabel agar urutan induk dan anak mudah dilihat.
Untuk tahap awal dapat memakai SQLite, lalu gunakan .env.mysql.example saat praktik MySQL.

## H9 — CRUD dan validasi
Ikuti route resource -> form -> ProdukRequest -> controller -> model.
Coba tambah, edit SKU tetap, SKU duplikat, harga negatif, stok pecahan,
kategori tidak ada, 404, pembatalan hapus, dan produk dengan riwayat.
Jelaskan @csrf, @method('PUT'/'DELETE'), old(), validated(), dan escaping.
Bukti: hasil QA, screenshot, perubahan database, satu kontribusi kode per siswa.
Cek individu: mengapa required di browser tidak cukup?

## H10 — Review dan handoff
Demo 15 menit: 2 menit masalah, 6 menit CRUD + input gagal,
2 menit kode/contribusi, 4 menit tanya jawab, 1 menit tindak lanjut.
Bandingkan acceptance criteria dengan aplikasi. Isi hasil aktual dan known issues.
Serahkan README, PRD/FSD, flowchart/ERD, source, lock, QA, board, dan PIC.
Nilai kelompok: kesesuaian 25, CRUD/validasi 30, kode/data 15,
pengujian 10, kerja kelompok 10, presentasi 10.
Nilai individu dicatat terpisah: pemahaman 40, kontribusi 40, komunikasi 20.
Bukti yang belum diperiksa ditandai belum dinilai.

## Pengayaan online berurutan
1. Tutup temuan FEAT-01 dan selesaikan review FSD.
2. Tambah akun dan otorisasi pemilik/kasir.
3. Implementasikan FEAT-02: gabung SKU, stok kumulatif, lockForUpdate,
   DB::transaction, validasi uang, harga historis, dan cegah pembayaran ganda.
4. FEAT-03: laporan omzet dari transaksi tersimpan, sesuai tanggal WITA.
Jangan mengurangi stok melalui form produk sebagai pengganti checkout.
