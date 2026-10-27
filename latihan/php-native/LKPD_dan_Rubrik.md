# LKPD individu dan panduan mentor H6
Nama: … | Kelompok/role: … | ID fitur FSD: …
## 1. HTML/CSS (15 poin)
Tandai field yang berasal dari wireframe FSD. Buat label yang terhubung dengan input (tambahkan id/for), layout rapi pada layar sempit, dan jelaskan atribut name. Bukti: tangkapan layar + file.
## 2. Recap PHP (25 poin)
Selesaikan latihan/recap.php: function subtotal (5), foreach akumulasi (10), kondisi diskon benar untuk kedua kasus README (10). Tulis hasil prediksi sebelum menjalankan.
## 3. Form dan MySQL (25 poin)
Jalankan aplikasi; tambah produk valid (10), buktikan harga nol/stok negatif ditolak server (10), jelaskan placeholder prepared statement (5). Catat input, hasil yang diharapkan, hasil aktual.
## 4. OOP (20 poin)
Buat dua objek Produk berbeda (5), jelaskan property vs method (5), constructor (5), namespace dan private (5). Pengayaan: tangani exception jumlah nol menggunakan try/catch.
## 5. Peta MVC (15 poin)
Tuliskan urutan file untuk GET dan POST (10). Sebutkan file yang diubah ketika aturan harga berubah dan ketika warna tabel berubah (5).
Total 100. Tuntas individu jika nilai >=70 dan bukti recap PHP serta OOP tersedia. Target checklist #9: sedikitnya 70% siswa tuntas; ini berbeda dari ambang nilai individu. Rekap 58 siswa berarti minimal 41 siswa tuntas.

## Kunci ringkas mentor
Recap: subtotal=harga*jumlah; total ditambah setiap iterasi; diskon total>=50000 ? (int)round(total*0.10) : 0; bayar=total-diskon. Hasil 38000/0/38000 dan 53000/5300/47700.
OOP: class cetak biru, object instance; property data, method perilaku; constructor dipanggil saat new; private tidak diakses langsung dari luar; use mengimpor nama, autoload memuat berkas.
GET: index → controller.index → model.all → view. POST valid: index → controller.index → model.create → redirect GET. POST invalid: controller menyiapkan errors, model.all lalu view.
Aturan harga: controller; warna tabel: public/style.css. Siswa dapat mengusulkan validasi di domain/model sebagai pengembangan selama menjelaskan pembagian tanggung jawab.

## Pembagian waktu mentor
08.00–08.15 cek alat & review FSD; 08.15–08.40 recap HTML/CSS; 08.40–09.20 praktik form; 09.20–09.30 cek pasangan.
09.45–10.10 array/function; 10.10–10.35 latihan; 10.35–11.15 form–PDO; 11.15–11.30 uji input.
12.30–12.45 class/object; 12.45–13.05 praktik; 13.05–13.15 namespace.
13.15–13.30 Composer; 13.30–13.45 telusur MVC; 13.45–14.00 exit ticket & bukti.
Semua role mengerjakan latihan individu. Pasangan boleh berdiskusi; satu siswa tetap menjelaskan kodenya sendiri.
Exit ticket: beda validasi vs escaping? Apa yang dikerjakan constructor? Mengapa view tidak menulis SQL? File apa yang dimuat vendor/autoload.php?
Rekap: nama | nilai | recap PHP | OOP | MVC | status | kendala | tindak lanjut. Belum tuntas: latihan 20 menit + pendampingan, catat untuk fase online.

## Catatan verifikasi paket
Kode disiapkan untuk PHP 8.2+; lingkungan penyusunan tidak menyediakan PHP/MySQL, sehingga runtime belum dieksekusi di sini. Mentor wajib menjalankan skenario README di komputer lab sebelum kelas.
