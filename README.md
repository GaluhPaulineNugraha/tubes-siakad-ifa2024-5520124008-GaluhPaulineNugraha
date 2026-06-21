**Dibuat oleh: Galuh Pauline Nugraha**
**NPM: 5520124008**
**Kelas: IFA 2024**
**Mata Kuliah: Pemrograman Web Lanjutan**

## SIAKAD - Sistem Informasi Akademik Sederhana

---

### 1. JUDUL PROJECT

SIAKAD - Sistem Informasi Akademik Sederhana

---

### 2. DESKRIPSI APLIKASI

SIAKAD adalah aplikasi web berbasis Laravel yang mensimulasikan Sistem Informasi Akademik sederhana. Aplikasi ini digunakan untuk mengelola data dosen, mahasiswa, mata kuliah, jadwal perkuliahan, dan Kartu Rencana Studi (KRS). Terdapat 3 role dengan hak akses berbeda yaitu Admin, Dosen, dan Mahasiswa. Admin memiliki akses penuh untuk mengelola semua data. Dosen dapat melihat jadwal mengajar dan daftar mahasiswa bimbingan. Mahasiswa dapat mengambil mata kuliah, melihat KRS, dan melihat jadwal kuliah.

---

### 3. TEKNOLOGI YANG DIGUNAKAN

Aplikasi ini dibangun menggunakan beberapa teknologi sebagai berikut:

3.1 PHP versi 8.3 sebagai bahasa pemrograman backend

3.2 Laravel versi 12 sebagai framework PHP

3.3 MySQL sebagai database

3.4 Bootstrap sebagai CSS framework

3.5 Laravel Breeze sebagai authentication scaffolding

3.6 Spatie Permission untuk manajemen role dan permission

3.7 Laravel Excel untuk export data ke Excel

3.8 DomPDF / Barryvdh untuk generate PDF

3.9 Font Awesome untuk icon

3.10 Google Fonts (Inter) untuk typography

3.11 Laragon sebagai local development environment

---

### 4. ROLE DAN HAK AKSES

Aplikasi ini memiliki 3 role dengan hak akses masing-masing sebagai berikut:

#### 4.1 Admin

Admin memiliki hak akses penuh untuk mengelola semua data yang ada di aplikasi. Fitur yang dapat diakses oleh Admin adalah:

4.1.1 Dashboard Admin yang menampilkan statistik total dosen, total mahasiswa, total mata kuliah, dan total pengambilan KRS serta grafik jadwal per hari dan mahasiswa per dosen wali

4.1.2 Data Dosen meliputi tambah, edit, hapus, lihat data dosen, dan export ke Excel

4.1.3 Data Mahasiswa meliputi tambah, edit, hapus, lihat data mahasiswa, dan export ke Excel

4.1.4 Data Mata Kuliah meliputi tambah, edit, hapus, lihat daftar mata kuliah, dan export ke Excel

4.1.5 Data Jadwal meliputi tambah, edit, hapus, lihat daftar jadwal per kelas (A sampai E), cek bentrok jadwal, dan export ke Excel

4.1.6 Manajemen KRS meliputi lihat semua KRS mahasiswa, filter berdasarkan mahasiswa, hapus KRS, dan export ke Excel

4.1.7 Profile untuk mengedit nama dan email

#### 4.2 Dosen

Dosen memiliki hak akses terbatas untuk melihat data yang berkaitan dengan dirinya. Fitur yang dapat diakses oleh Dosen adalah:

4.2.1 Dashboard Dosen yang menampilkan statistik mahasiswa bimbingan, jadwal mengajar, total pengambilan KRS, dan grafik jadwal mengajar per hari serta grafik mahasiswa bimbingan

4.2.2 Jadwal untuk melihat jadwal mengajar pribadi (Read Only) dan export ke PDF

4.2.3 Mahasiswa Bimbingan untuk melihat daftar mahasiswa bimbingan dan export ke PDF

4.2.4 Profile untuk mengedit nama dan email

#### 4.3 Mahasiswa

Mahasiswa memiliki hak akses untuk mengelola KRS dan melihat jadwal kuliah. Fitur yang dapat diakses oleh Mahasiswa adalah:

4.3.1 Dashboard Mahasiswa yang menampilkan statistik total mata kuliah diambil, total SKS, dan informasi pribadi

4.3.2 KRS Saya untuk mengambil mata kuliah, menghapus mata kuliah, melihat daftar KRS, dan export ke PDF dengan batas maksimal 24 SKS

4.3.3 Jadwal Kuliah untuk melihat jadwal kuliah berdasarkan KRS yang diambil dan export ke PDF

4.3.4 Profile untuk mengedit nama dan email

---

### 5. STRUKTUR DATABASE

Aplikasi ini memiliki 6 tabel utama yang saling terhubung melalui relasi. Berikut penjelasan masing-masing tabel dan field-nya:

#### 5.1 Tabel users

Tabel users digunakan untuk menyimpan data akun login semua pengguna aplikasi. Field yang terdapat dalam tabel ini adalah:

5.1.1 id sebagai primary key bertipe bigint

5.1.2 name untuk menyimpan nama lengkap pengguna bertipe string

5.1.3 email untuk menyimpan alamat email yang bersifat unik bertipe string

5.1.4 email_verified_at untuk menyimpan waktu verifikasi email bertipe timestamp

5.1.5 password untuk menyimpan password yang telah di-hash bertipe string

5.1.6 mahasiswa_id sebagai foreign key ke tabel mahasiswa bertipe char 10 dan dapat bernilai null

5.1.7 nidn sebagai foreign key ke tabel dosen bertipe char 10 dan dapat bernilai null

5.1.8 remember_token untuk menyimpan token remember me bertipe string

5.1.9 created_at untuk menyimpan waktu data dibuat bertipe timestamp

5.1.10 updated_at untuk menyimpan waktu data diupdate bertipe timestamp

#### 5.2 Tabel dosen

Tabel dosen digunakan untuk menyimpan data dosen. Field yang terdapat dalam tabel ini adalah:

5.2.1 nidn sebagai primary key bertipe char 10

5.2.2 nama untuk menyimpan nama lengkap dosen bertipe string 50

5.2.3 created_at untuk menyimpan waktu data dibuat bertipe timestamp

5.2.4 updated_at untuk menyimpan waktu data diupdate bertipe timestamp

#### 5.3 Tabel mahasiswa

Tabel mahasiswa digunakan untuk menyimpan data mahasiswa. Field yang terdapat dalam tabel ini adalah:

5.3.1 npm sebagai primary key bertipe char 10

5.3.2 nidn sebagai foreign key ke tabel dosen yang merupakan dosen wali bertipe char 10

5.3.3 nama untuk menyimpan nama lengkap mahasiswa bertipe string 50

5.3.4 created_at untuk menyimpan waktu data dibuat bertipe timestamp

5.3.5 updated_at untuk menyimpan waktu data diupdate bertipe timestamp

#### 5.4 Tabel matakuliah

Tabel matakuliah digunakan untuk menyimpan data mata kuliah. Field yang terdapat dalam tabel ini adalah:

5.4.1 kode_matakuliah sebagai primary key bertipe char 8

5.4.2 nama_matakuliah untuk menyimpan nama mata kuliah bertipe string 50

5.4.3 sks untuk menyimpan jumlah SKS bertipe integer

5.4.4 created_at untuk menyimpan waktu data dibuat bertipe timestamp

5.4.5 updated_at untuk menyimpan waktu data diupdate bertipe timestamp

#### 5.5 Tabel jadwal

Tabel jadwal digunakan untuk menyimpan data jadwal perkuliahan. Field yang terdapat dalam tabel ini adalah:

5.5.1 id sebagai primary key bertipe bigint

5.5.2 kode_matakuliah sebagai foreign key ke tabel matakuliah bertipe char 10

5.5.3 nidn sebagai foreign key ke tabel dosen bertipe char 10

5.5.4 kelas untuk menyimpan kode kelas (A, B, C, D, E) bertipe char 1

5.5.5 hari untuk menyimpan hari perkuliahan (Senin sampai Jumat) bertipe string 10

5.5.6 jam untuk menyimpan waktu perkuliahan bertipe timestamp

5.5.7 created_at untuk menyimpan waktu data dibuat bertipe timestamp

5.5.8 updated_at untuk menyimpan waktu data diupdate bertipe timestamp

#### 5.6 Tabel krs

Tabel krs digunakan untuk menyimpan data Kartu Rencana Studi. Field yang terdapat dalam tabel ini adalah:

5.6.1 id sebagai primary key bertipe bigint

5.6.2 npm sebagai foreign key ke tabel mahasiswa bertipe char 10

5.6.3 kode_matakuliah sebagai foreign key ke tabel matakuliah bertipe char 8

5.6.4 created_at untuk menyimpan waktu data dibuat bertipe timestamp

5.6.5 updated_at untuk menyimpan waktu data diupdate bertipe timestamp

#### 5.7 Relasi Antar Tabel

Relasi antar tabel dalam aplikasi ini adalah sebagai berikut:

5.7.1 users berelasi dengan mahasiswa melalui field mahasiswa_id yang mengacu ke npm pada tabel mahasiswa

5.7.2 users berelasi dengan dosen melalui field nidn yang mengacu ke nidn pada tabel dosen

5.7.3 mahasiswa berelasi dengan dosen melalui field nidn yang mengacu ke nidn pada tabel dosen

5.7.4 jadwal berelasi dengan matakuliah melalui field kode_matakuliah yang mengacu ke kode_matakuliah pada tabel matakuliah

5.7.5 jadwal berelasi dengan dosen melalui field nidn yang mengacu ke nidn pada tabel dosen

5.7.6 krs berelasi dengan mahasiswa melalui field npm yang mengacu ke npm pada tabel mahasiswa

5.7.7 krs berelasi dengan matakuliah melalui field kode_matakuliah yang mengacu ke kode_matakuliah pada tabel matakuliah

---

### 6. PENJELASAN HALAMAN

Berikut penjelasan singkat fungsi dari masing-masing halaman yang terdapat dalam aplikasi:

#### 6.1 Halaman Publik

6.1.1 Halaman Beranda menampilkan informasi umum tentang program studi Teknik Informatika Universitas Nugraha, meliputi deskripsi program studi, statistik mahasiswa, dosen, mitra industri, dan prestasi, serta berita terbaru dan kontak.

6.1.2 Halaman Visi dan Misi menampilkan visi, misi, dan tujuan dari program studi Teknik Informatika Universitas Nugraha.

6.1.3 Halaman Login digunakan oleh semua pengguna (Admin, Dosen, Mahasiswa) untuk masuk ke sistem dengan memasukkan email dan password. Halaman ini dilengkapi dengan tampilan yang menarik dan fitur toggle password.

#### 6.2 Halaman Admin

6.2.1 Dashboard Admin menampilkan statistik total dosen, total mahasiswa, total mata kuliah, dan total pengambilan KRS. Juga menampilkan grafik jadwal per hari (Senin-Jumat), grafik mahasiswa per dosen wali, serta daftar data dosen dan data mahasiswa.

6.2.2 Halaman Data Dosen menampilkan daftar dosen dengan fitur pencarian, pagination, tombol tambah dosen, edit dosen, hapus dosen dengan modal konfirmasi, dan export ke Excel.

6.2.3 Halaman Tambah Dosen digunakan untuk menambahkan data dosen baru dengan validasi NIDN unik dan nama wajib diisi. Sistem akan membuat akun login otomatis dengan email dari nama dosen dan password NIDN.

6.2.4 Halaman Edit Dosen digunakan untuk mengubah data dosen. NIDN tidak dapat diubah karena terhubung dengan data lain.

6.2.5 Halaman Data Mahasiswa menampilkan daftar mahasiswa dengan fitur pencarian, pagination, tombol tambah mahasiswa, edit mahasiswa, hapus mahasiswa dengan modal konfirmasi, status aktif atau tidak aktif berdasarkan pengambilan KRS, dan export ke Excel.

6.2.6 Halaman Tambah Mahasiswa digunakan untuk menambahkan data mahasiswa baru dengan validasi NPM unik, nama wajib diisi, dan memilih dosen wali. Sistem akan membuat akun login otomatis.

6.2.7 Halaman Edit Mahasiswa digunakan untuk mengubah data mahasiswa. NPM tidak dapat diubah dan status mahasiswa ditampilkan secara otomatis. Status mahasiswa aktif ketika mahasiswa mengambil KRS, jika tidak maka dianggap statusnya non-aktif.

6.2.8 Halaman Data Mata Kuliah menampilkan daftar mata kuliah dengan fitur pencarian, pagination, tombol tambah mata kuliah, edit mata kuliah, hapus mata kuliah dengan modal konfirmasi, dan export ke Excel.

6.2.9 Halaman Tambah Mata Kuliah digunakan untuk menambahkan data mata kuliah baru dengan validasi kode mata kuliah unik, nama wajib diisi, dan SKS antara 1 sampai 6.

6.2.10 Halaman Edit Mata Kuliah digunakan untuk mengubah data mata kuliah. Kode mata kuliah tidak dapat diubah.

6.2.11 Halaman Manajemen Jadwal menampilkan daftar jadwal perkuliahan yang dikelompokkan berdasarkan kelas (A, B, C, D, E) menggunakan tab. Terdapat fitur pencarian, tombol tambah jadwal, edit jadwal, hapus jadwal dengan modal konfirmasi, dan export ke Excel.

6.2.12 Halaman Tambah Jadwal digunakan untuk menambahkan jadwal perkuliahan baru dengan memilih mata kuliah, dosen pengajar, hari, jam, dan kelas. Sistem akan mengecek bentrok jadwal pada hari, kelas, dan jam yang sama.

6.2.13 Halaman Edit Jadwal digunakan untuk mengubah data jadwal perkuliahan yang sudah ada dengan tetap mengecek bentrok jadwal.

#### 6.3 Halaman Dosen

6.3.1 Dashboard Dosen menampilkan statistik mahasiswa bimbingan, jadwal mengajar, total pengambilan KRS, grafik jadwal mengajar per hari, dan grafik mahasiswa bimbingan. Juga menampilkan jadwal mengajar terbaru dan mahasiswa bimbingan terbaru.

6.3.2 Halaman Jadwal Mengajar menampilkan daftar jadwal mengajar dosen yang bersangkutan dengan fitur pagination dan export ke PDF. Dosen hanya dapat melihat jadwal (Read Only).

6.3.3 Halaman Mahasiswa Bimbingan menampilkan daftar mahasiswa bimbingan dosen yang bersangkutan dengan fitur pagination dan export ke PDF. Menampilkan NPM, nama mahasiswa, jumlah mata kuliah diambil, dan status aktif atau tidak aktif.

#### 6.4 Halaman Mahasiswa

6.4.1 Dashboard Mahasiswa menampilkan statistik total mata kuliah diambil, total SKS dengan progress bar, dan informasi pribadi mahasiswa. Juga menampilkan daftar mata kuliah yang diambil.

6.4.2 Halaman KRS Saya menampilkan daftar mata kuliah yang sudah diambil dalam bentuk tabel dengan kolom kode MK, nama mata kuliah, SKS, dan tanggal ambil. Terdapat tombol Ambil Mata Kuliah, Export PDF, dan Hapus untuk setiap mata kuliah. Total SKS ditampilkan dengan batas maksimal 24 SKS.

6.4.3 Modal Ambil Mata Kuliah menampilkan daftar mata kuliah yang tersedia untuk diambil. Sistem akan mengecek apakah mata kuliah sudah diambil dan apakah total SKS melebihi batas 24 SKS.

6.4.4 Halaman Jadwal Kuliah menampilkan jadwal kuliah berdasarkan mata kuliah yang diambil pada KRS. Jadwal diurutkan berdasarkan hari (Senin sampai Jumat) dan jam. Terdapat tombol Export PDF.

#### 6.5 Halaman Profile

6.5.1 Halaman Profile digunakan oleh semua role untuk mengedit nama dan email. Untuk user dosen dan mahasiswa, perubahan nama juga akan mengupdate tabel dosen atau mahasiswa terkait secara otomatis ke dalam database.

---

### 7. CARA INSTALL PROJECT

Berikut langkah-langkah untuk menginstall project SIAKAD dari awal:

#### 7.1 Prasyarat

Sebelum menginstall, pastikan perangkat Anda telah terinstall:

7.1.1 PHP

7.1.2 MySQL

7.1.3 Composer

7.1.4 Laragon, XAMPP, atau WAMP sebagai local server

#### 7.2 Langkah Instalasi

7.2.1 Clone repository dari GitHub dengan perintah:
git clone https://github.com/GaluhPaulineNugraha/tubes-siakad-ifa2024-5520124008-GaluhPaulineNugraha.git

7.2.2 Masuk ke direktori project:
cd tubes-siakad-ifa2024-5520124008-GaluhPaulineNugraha

7.2.3 Install semua dependensi menggunakan Composer:
composer install

7.2.4 Buat file .env dari contoh yang tersedia:
cp .env.example .env

7.2.5 Buka file .env dan sesuaikan konfigurasi database Anda:
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=siakad_db
DB_USERNAME=root
DB_PASSWORD=

7.2.6 Generate application key:
php artisan key:generate

7.2.7 Jalankan migration dan seeder untuk membuat tabel dan data awal:
php artisan migrate --seed

7.2.8 (Opsional) Install dependencies frontend jika diperlukan:
npm install
npm run build

7.2.9 Jalankan server development:
php artisan serve

7.2.10 Akses aplikasi melalui browser di alamat:
http://localhost:8000

#### 7.3 Data Awal yang Tersedia

Setelah menjalankan seeder, akan tersedia data awal:

7.3.1 1 akun Admin

7.3.2 7 akun Dosen

7.3.3 25 akun Mahasiswa

7.3.4 12 data Mata Kuliah

7.3.5 Data Jadwal untuk setiap dosen (Senin-Jumat)

7.3.6 Data KRS untuk setiap mahasiswa

#### 7.4 Link Repository

Repository GitHub dapat diakses di:
https://github.com/GaluhPaulineNugraha/tubes-siakad-ifa2024-5520124008-GaluhPaulineNugraha

---

### 8. AKUN LOGIN UNTUK PENGUJIAN

Berikut daftar akun yang dapat digunakan untuk menguji aplikasi sesuai dengan masing-masing role:

#### 8.1 Akun Admin

Email: admin@gmail.com
Password: admin12345
Role: Admin

#### 8.2 Akun Dosen

Daftar akun dosen yang tersedia beserta email dan password:

8.2.1 Email: drgatotsubrotomkom@gmail.com, Password: dosen12345, Nama: Dr. Gatot Subroto, M.Kom

8.2.2 Email: profsitinurhalizamsc@gmail.com, Password: dosen12345, Nama: Prof. Siti Nurhaliza, M.Sc

8.2.3 Email: drbudisantosomeng@gmail.com, Password: dosen12345, Nama: Dr. Budi Santoso, M.Eng

8.2.4 Email: dewilestariskomkom@gmail.com, Password: dosen12345, Nama: Dewi Lestari, S.Kom, M.Kom

8.2.5 Email: drfitrianirahayumpd@gmail.com, Password: dosen12345, Nama: Dr. Fitriani Rahayu, M.Pd

8.2.6 Email: drahmadrizkimkom@gmail.com, Password: dosen12345, Nama: Dr. Ahmad Rizki, M.Kom

#### 8.3 Akun Mahasiswa

Daftar akun mahasiswa yang tersedia beserta email dan password:

8.3.1 Email: galuhpaulinenugraha@gmail.com, Password: mahasiswa12345

8.3.2 Email: andisaputra@gmail.com, Password: mahasiswa12345

8.3.3 Email: budiwijaya@gmail.com, Password: mahasiswa12345

8.3.4 Dan seterusnya untuk mahasiswa lainnya dengan password yang sama yaitu mahasiswa12345

---

### 9. ALUR LOGIKA SISTEM

#### 9.1 Alur Login

9.1.1 User mengakses halaman login melalui URL http://localhost:8000/login

9.1.2 User memasukkan email dan password pada form yang tersedia

9.1.3 Sistem melakukan autentikasi dengan mencocokkan email dan password dengan data di tabel users

9.1.4 Jika email dan password cocok, sistem akan mengarahkan user ke dashboard sesuai dengan role yang dimiliki

9.1.5 Admin akan diarahkan ke halaman Dashboard Admin

9.1.6 Dosen akan diarahkan ke halaman Dashboard Dosen

9.1.7 Mahasiswa akan diarahkan ke halaman Dashboard Mahasiswa

9.1.8 Jika email atau password salah, sistem akan menampilkan pesan error "These credentials do not match our records"

#### 9.2 Alur Manajemen Data Dosen oleh Admin

9.2.1 Admin login dan mengakses menu Data Master kemudian memilih Data Dosen

9.2.2 Admin dapat melihat daftar semua dosen yang tersedia dengan fitur pencarian dan pagination

9.2.3 Admin dapat menambahkan dosen baru dengan mengklik tombol Tambah Dosen

9.2.4 Admin mengisi form NIDN dan Nama dosen untuk tambah data dosen

9.2.5 Sistem melakukan validasi NIDN harus unik dan nama wajib diisi

9.2.6 Sistem otomatis membuat akun user dengan email dari nama dosen dan password NIDN

9.2.7 Admin dapat mengedit data dosen dengan mengklik tombol Edit

9.2.8 Admin dapat menghapus data dosen dengan mengklik tombol Hapus dan mengkonfirmasi melalui modal

9.2.9 Admin dapat mengekspor data dosen ke Excel dengan mengklik tombol Export Excel

#### 9.3 Alur Manajemen Jadwal oleh Admin

9.3.1 Admin login dan mengakses menu Akademik kemudian memilih Jadwal Kuliah

9.3.2 Admin dapat melihat jadwal perkuliahan yang dikelompokkan berdasarkan kelas (A sampai E) menggunakan tab button kategori kelas

9.3.3 Admin dapat menambahkan jadwal baru dengan mengklik tombol Tambah Jadwal

9.3.4 Admin mengisi form mata kuliah, dosen pengajar, hari, jam, dan kelas

9.3.5 Sistem melakukan pengecekan bentrok jadwal pada hari, kelas, dan jam yang sama

9.3.6 Jika terjadi bentrok, sistem menampilkan pesan error

9.3.7 Jika tidak terjadi bentrok, jadwal berhasil disimpan

9.3.8 Admin dapat mengedit dan menghapus jadwal yang sudah ada

9.3.9 Admin dapat mengekspor data jadwal ke Excel

#### 9.4 Alur Pengambilan KRS oleh Mahasiswa

9.4.1 Mahasiswa login dan mengakses menu KRS Saya

9.4.2 Mahasiswa melihat daftar mata kuliah yang sudah diambil beserta total SKS

9.4.3 Mahasiswa mengklik tombol Ambil Mata Kuliah untuk menambah mata kuliah

9.4.4 Muncul modal berisi daftar mata kuliah yang tersedia

9.4.5 Mahasiswa memilih mata kuliah yang ingin diambil

9.4.6 Sistem melakukan pengecekan apakah mata kuliah sudah diambil sebelumnya

9.4.7 Sistem melakukan pengecekan apakah total SKS setelah penambahan tidak melebihi 24 SKS

9.4.8 Jika lolos pengecekan, mata kuliah ditambahkan ke KRS

9.4.9 Jika tidak lolos, sistem menampilkan pesan error yang sesuai

9.4.10 Mahasiswa dapat menghapus mata kuliah dari KRS dengan mengklik tombol Hapus

9.4.11 Mahasiswa dapat mengekspor KRS ke PDF

#### 9.5 Alur Jadwal Mengajar oleh Dosen

9.5.1 Dosen login dan mengakses menu Jadwal Mengajar

9.5.2 Sistem menampilkan jadwal mengajar berdasarkan NIDN dosen yang sedang login

9.5.3 Dosen hanya dapat melihat jadwal (Read Only) tanpa bisa menambah, mengedit, atau menghapus

9.5.4 Dosen dapat mengekspor jadwal mengajar ke PDF

9.5.5 Jika tidak ada jadwal, sistem menampilkan pesan "Belum ada jadwal mengajar"

#### 9.6 Alur Menentukan Role Pengguna

9.6.1 Sistem menentukan role pengguna berdasarkan data di tabel users

9.6.2 Jika email pengguna adalah admin@gmail.com, maka role adalah Admin

9.6.3 Jika field nidn tidak null, maka role adalah Dosen

9.6.4 Jika field mahasiswa_id tidak null, maka role adalah Mahasiswa

9.6.5 Setiap role memiliki menu dan hak akses yang berbeda sesuai dengan kebutuhan

---

### 10. LINK REPOSITORI DAN HOSTING

#### 10.1 Link Repository

Repository GitHub untuk source code aplikasi ini dapat diakses di:
https://github.com/GaluhPaulineNugraha/tubes-siakad-ifa2024-5520124008-GaluhPaulineNugraha

#### 10.2 Link Hosting

Aplikasi ini di-hosting secara online dan dapat diakses melalui URL:
https://siakad-universitas-nugraha.com

---

