

DOKUMENTASI LENGKAP SISTEM INFORMASI AKADEMIK SIAKAD
UNIVERSITAS NUGRAHA - FAKULTAS TEKNIK INFORMATIKA

Dibuat oleh: Galuh Pauline Nugraha
NPM: 5520124008
Kelas: IFA 2024
Mata Kuliah: Pemrograman Web II


1. PENDAHULUAN

Aplikasi Sistem Informasi Akademik atau SIAKAD ini dibuat untuk memenuhi Tugas Besar Mata Kuliah Pemrograman Web II. Aplikasi ini bertujuan untuk mengelola data akademik secara digital, meliputi data dosen, mahasiswa, mata kuliah, jadwal perkuliahan, dan Kartu Rencana Studi atau KRS.

Universitas Nugraha adalah nama fiktif yang digunakan untuk project ini. Sistem ini dikhususkan untuk Fakultas Teknik Informatika saja, sehingga semua data yang dikelola berada dalam satu fakultas.


2. TENTANG APLIKASI

SIAKAD adalah aplikasi web yang memungkinkan tiga jenis pengguna dengan hak akses berbeda.

2.1. Admin memiliki akses penuh untuk mengelola semua data, yaitu data dosen, data mahasiswa, data mata kuliah, dan KRS. Admin juga bisa melihat laporan dalam bentuk Excel.

2.2. Dosen dapat mengelola jadwal mengajar dan melihat daftar mahasiswa bimbingannya. Dosen juga bisa melihat dashboard statistik terkait mahasiswa bimbingan dan jadwal mengajar.

2.3. Mahasiswa dapat mengambil mata kuliah melalui KRS, menghapus mata kuliah yang sudah diambil, melihat jadwal kuliah, dan melihat nilai beserta grade kelulusan. Mahasiswa juga bisa mengexport KRS miliknya ke dalam file PDF.

2.4. Batasan dalam sistem ini adalah mahasiswa maksimal hanya bisa mengambil 24 SKS per semester. Admin tidak bisa mengedit nilai, hanya bisa melihat. Dosen tidak bisa mengelola data di luar mahasiswa bimbingannya.


3. HALAMAN BERANDA PUBLIK

Sebelum login, terdapat halaman Beranda yang bisa diakses oleh siapa saja tanpa perlu login. Halaman ini bertujuan untuk memperkenalkan Universitas Nugraha dan Program Studi Teknik Informatika kepada masyarakat umum.

3.1. Halaman Beranda berisi hero section dengan judul Teknik Informatika dan deskripsi singkat tentang program studi. Terdapat tombol untuk menuju halaman Visi dan Misi serta tombol Program Studi yang masih dalam pengembangan.

3.2. Halaman ini juga menampilkan statistik jumlah mahasiswa aktif yang mencapai 120 lebih, dosen profesional sebanyak 15 lebih, mitra industri sebanyak 25 lebih, dan prestasi nasional sebanyak 10 lebih.

3.3. Ada juga bagian Sekilas Tentang Prodi yang menjelaskan bahwa Program Studi Teknik Informatika Universitas Nugraha didirikan untuk memenuhi kebutuhan tenaga profesional di bidang teknologi informasi. Kurikulum yang dirancang mengacu pada kebutuhan industri 4.0 dan society 5.0.

3.4. Bagian Berita Terbaru menampilkan contoh berita seperti Wisuda Sarjana Periode 2025, Webinar Kecerdasan Buatan, dan Magang di PT Digital Inovasi.

3.5. Bagian bawah halaman berisi kontak berupa alamat Jalan Pasir Gede Raya Cianjur, telepon nomor 0263 283578, dan email informatikat n u g r a h a . a c . i d.

3.6. Halaman Visi dan Misi berisi visi program studi yang berbunyi menjadi Program Studi Teknik Informatika yang unggul dan inovatif dalam pengembangan teknologi digital berkelanjutan untuk mendukung transformasi digital nasional pada tahun 2030.

3.7. Terdapat enam misi yaitu pendidikan berkualitas, penelitian inovatif, pengabdian masyarakat, kemitraan strategis, sumber daya unggul, dan tata kelola profesional. Halaman ini juga menampilkan tujuan program studi.


4. SISTEM LOGIN DAN AUTHENTICATION

Cara login ke aplikasi sangat mudah. Buka aplikasi di alamat http://127.0.0.1:8000, maka akan otomatis diarahkan ke halaman login. Masukkan email dan password sesuai role yang diinginkan, lalu klik tombol MASUK.

Berikut adalah akun default untuk mengakses aplikasi.

4.1. Untuk Admin, email adalah admin@gmail.com dengan password admin12345.

4.2. Untuk Dosen, email adalah ahmad.rizki@gmail.com dengan password dosen12345. Dosen lainnya yang bisa digunakan untuk login adalah siti.nurhaliza@gmail.com, budi.santoso@gmail.com, dewi.lestari@gmail.com, dan eko.prasetyo@gmail.com dengan password yang sama yaitu dosen12345.

4.3. Untuk Mahasiswa, email adalah galuh.pauline@gmail.com dengan password mahasiswa12345. Mahasiswa lainnya yang bisa digunakan untuk login adalah andi.saputra@gmail.com, budi.wijaya@gmail.com, citra.amalia@gmail.com, dian.permata@gmail.com, eka.saputri@gmail.com, fajar.nugroho@gmail.com, gita.puspita@gmail.com, hendra.gunawan@gmail.com, dan indah.sari@gmail.com dengan password yang sama yaitu mahasiswa12345.

4.4. Teknologi authentication yang digunakan adalah Laravel Breeze untuk package authentication dan Spatie Laravel Permission untuk manajemen role. Setiap password disimpan dalam bentuk hash menggunakan bcrypt.

4.5. Middleware role digunakan untuk membatasi akses halaman berdasarkan role user. Contohnya route dengan prefix dosen hanya bisa diakses oleh user yang memiliki role dosen. File middleware ini bernama RoleMiddleware dan disimpan di folder app Http Middleware.


5. STRUKTUR DATABASE

Database aplikasi ini terdiri dari beberapa tabel utama.

5.1. Tabel dosen memiliki primary key nidn dengan tipe data char 10. Tabel ini menyimpan data dosen seperti nidn, nama, email, no telepon, dan alamat.

5.2. Tabel mahasiswa memiliki primary key npm dengan tipe data char 10. Tabel ini memiliki foreign key nidn yang merujuk ke tabel dosen. Field yang ada adalah npm, nidn, nama, email, no telepon, dan alamat.

5.3. Tabel matakuliah memiliki primary key kode_matakuliah dengan tipe data char 8. Field yang ada adalah kode_matakuliah, nama_matakuliah, sks, dan semester.

5.4. Tabel jadwal memiliki primary key id auto increment. Tabel ini memiliki foreign key kode_matakuliah ke tabel matakuliah dan foreign key nidn ke tabel dosen. Field yang ada adalah id, kode_matakuliah, nidn, kelas, hari, jam_mulai, jam_selesai, ruangan, dan tahun_akademik.

5.5. Tabel krs memiliki primary key id auto increment. Tabel ini memiliki foreign key npm ke tabel mahasiswa dan foreign key kode_matakuliah ke tabel matakuliah. Field yang ada adalah id, npm, kode_matakuliah, status, dan tahun_akademik.

5.6. Tabel users menyimpan data user login dengan field id, name, email, password, mahasiswa_id, nidn, remember_token, dan timestamps. Foreign key mahasiswa_id merujuk ke tabel mahasiswa dan foreign key nidn merujuk ke tabel dosen.

5.7. Relasi antar tabel dapat dijelaskan sebagai berikut. Satu dosen bisa menjadi wali dari banyak mahasiswa, ini adalah relasi one to many. Satu dosen bisa memiliki banyak jadwal mengajar, ini juga relasi one to many. Satu mahasiswa bisa mengambil banyak mata kuliah melalui tabel krs. Satu mata kuliah bisa diambil oleh banyak mahasiswa melalui tabel krs. Satu mata kuliah bisa memiliki banyak jadwal. Satu user terhubung ke satu mahasiswa atau satu dosen, ini adalah relasi one to one.

5.8. Migration yang dibuat terdiri dari beberapa file. create_users_table untuk membuat tabel users. create_dosen_table untuk membuat tabel dosen. create_matakuliah_table untuk membuat tabel matakuliah. create_mahasiswa_table untuk membuat tabel mahasiswa. create_jadwal_table untuk membuat tabel jadwal. create_krs_table untuk membuat tabel krs. add_mahasiswa_id_to_users_table untuk menambah kolom mahasiswa_id ke tabel users. create_permission_tables untuk membuat tabel roles dan permissions dari package Spatie. add_foreign_keys_to_users_table untuk menambahkan foreign key ke tabel users.

5.9. Untuk menjalankan migration dan mengisi data awal, gunakan perintah php artisan migrate freesh seed. Perintah ini akan menghapus semua tabel jika sudah ada, membuat ulang tabel sesuai migration, lalu mengisi data awal dari seeder.


6. SEEDER DAN DATA DUMMY

Seeder adalah file di Laravel yang digunakan untuk mengisi data awal ke dalam database. Data dummy atau contoh data sangat berguna untuk memudahkan testing fitur tanpa harus menginput data satu per satu secara manual. Data dummy juga membuat dashboard statistik tidak kosong saat pertama kali aplikasi dijalankan, dan mempercepat demo aplikasi ke dosen.

Berikut adalah daftar seeder yang dibuat beserta isi datanya.

6.1. DosenSeeder berisi 5 data dosen dengan nidn, nama, dan email.

6.2. MatakuliahSeeder berisi 10 mata kuliah dengan kode matakuliah, nama matakuliah, sks, dan semester.

6.3. MahasiswaSeeder berisi 10 mahasiswa dengan npm, nama, dan nidn dosen wali yang dipilih secara acak.

6.4. JadwalSeeder berisi jadwal mengajar otomatis untuk setiap mata kuliah dengan data hari, jam, kelas, dan ruangan yang dihasilkan secara acak.

6.5. KrsSeeder berisi data KRS untuk setiap mahasiswa, di mana setiap mahasiswa mengambil antara 4 sampai 6 mata kuliah secara acak.

6.6. RolePermissionSeeder berfungsi untuk membuat role admin, dosen, dan mahasiswa menggunakan package Spatie, serta membuat user login untuk setiap dosen dan mahasiswa dengan password default.

6.7. Cara membuat seeder baru adalah dengan perintah php artisan make seeder NamaSeeder, kemudian mengisi method run dengan data yang diinginkan.


7. STRUKTUR FILE DAN FUNGSINYA

7.1. Semua controller disimpan di folder app Http Controllers.

7.1.1. DashboardController berfungsi menampilkan dashboard berdasarkan role user yang sedang login.

7.1.2. DosenController mengelola data dosen secara CRUD, menampilkan dashboard dosen, dan mengelola jadwal mengajar dosen.

7.1.3. MahasiswaController mengelola数据 mahasiswa secara CRUD.

7.1.4. MatakuliahController mengelola data mata kuliah secara CRUD.

7.1.5. JadwalController menampilkan jadwal kuliah untuk admin dan mahasiswa.

7.1.6. KRSController mengelola KRS, yaitu mengambil mata kuliah, menghapus mata kuliah, dan mengexport PDF untuk mahasiswa serta export Excel untuk admin.

7.1.7. NilaiController menampilkan nilai untuk admin hanya bisa lihat, untuk dosen bisa edit nilai mahasiswa bimbingannya, dan untuk mahasiswa hanya bisa melihat nilai sendiri.

7.1.8. ProdiController menampilkan halaman publik yaitu beranda dan visi misi.

7.1.9. ProfileController mengatur edit profile user.

7.2. Semua model disimpan di folder app Models.

7.2.1. Model Dosen memiliki relasi hasMany ke Mahasiswa dan Jadwal.

7.2.2. Model Mahasiswa memiliki relasi belongsTo ke Dosen dan hasMany ke KRS.

7.2.3. Model Matakuliah memiliki relasi hasMany ke Jadwal dan KRS.

7.2.4. Model Jadwal memiliki relasi belongsTo ke Matakuliah dan Dosen.

7.2.5. Model KRS memiliki relasi belongsTo ke Mahasiswa dan Matakuliah.

7.2.6. Model User memiliki relasi belongsTo ke Mahasiswa dan Dosen serta menggunakan trait HasRoles dari Spatie.

7.3. Middleware RoleMiddleware disimpan di folder app Http Middleware. File ini berfungsi untuk memeriksa apakah user memiliki role yang diizinkan sebelum mengakses halaman.

7.4. Semua view disimpan di folder resources views.

7.4.1. Folder auth berisi halaman login.

7.4.2. Folder dosen berisi dashboard dosen, jadwal mengajar, dan mahasiswa bimbingan.

7.4.3. Folder jadwal berisi halaman jadwal untuk admin dan mahasiswa.

7.4.4. Folder krs berisi halaman KRS untuk admin dan mahasiswa.

7.4.5. Folder layouts berisi template utama yaitu app.blade.php untuk halaman setelah login dengan sidebar, public.blade.php untuk halaman publik tanpa sidebar, dan sidebar.blade.php untuk menu navigasi.

7.4.6. Folder mahasiswa berisi CRUD mahasiswa untuk admin.

7.4.7. Folder matakuliah berisi CRUD mata kuliah untuk admin.

7.4.8. Folder nilai berisi halaman nilai untuk admin, dosen, dan mahasiswa.

7.4.9. Folder prodi berisi halaman publik beranda dan visi misi.

7.4.10. Folder profile berisi edit profile.

7.5. File routes web.php adalah file utama routing yang menghubungkan URL dengan Controller. Route dibagi menjadi beberapa kategori. Route publik seperti prodi dan prodi visi misi bisa diakses tanpa login. Route auth membutuhkan login untuk semua route kecuali publik. Route admin digunakan untuk mengelola data dosen, mahasiswa, matakuliah, dan KRS. Route dosen menggunakan prefix dosen dan middleware role dosen. Route mahasiswa digunakan untuk KRS, jadwal, dan nilai.


8. FITUR BONUS

Aplikasi ini memiliki beberapa fitur bonus.

8.1. Export Excel terdapat di halaman Manajemen KRS untuk Admin. File yang terlibat adalah app Exports KRSExport.php dan method exportExcel di KRSController. Fitur ini berfungsi untuk mendownload semua data KRS ke file xlsx.

8.2. Export PDF terdapat di halaman KRS Mahasiswa. File yang terlibat adalah method exportPdf di KRSController dan view krs pdf.blade.php. Fitur ini berfungsi untuk mendownload KRS milik mahasiswa yang sedang login ke file pdf.

8.3. Fitur pencarian dan filter terdapat di semua halaman data seperti dosen, mahasiswa, mata kuliah, dan KRS. Fitur ini memungkinkan user mencari data berdasarkan keyword tertentu.

8.4. Fitur dashboard statistik terdapat di dashboard admin, dashboard dosen, dan dashboard mahasiswa. Fitur ini menampilkan ringkasan data seperti jumlah total dan informasi terbaru.


9. PACKAGE YANG DIGUNAKAN

Aplikasi ini menggunakan beberapa package tambahan.

9.1. Laravel Breeze diinstall dengan perintah composer require laravel breeze. Package ini digunakan untuk authentication seperti login dan logout.

9.2. Spatie Laravel Permission diinstall dengan perintah composer require spatie laravel permission. Package ini digunakan untuk manajemen role seperti admin, dosen, dan mahasiswa.

9.3. DomPDF diinstall dengan perintah composer require barryvdh laravel dompdf. Package ini digunakan untuk export PDF.

9.4. Maatwebsite Excel diinstall dengan perintah composer require maatwebsite excel. Package ini digunakan untuk export Excel.


10. CARA INSTALL DAN MENJALANKAN PROJECT

Berikut adalah langkah langkah untuk menginstall dan menjalankan project ini.

10.1. Langkah pertama, clone repository dari GitHub menggunakan perintah git clone diikuti dengan alamat repository. Setelah itu masuk ke folder project.

10.2. Langkah kedua, install dependencies dengan perintah composer install dan npm install.

10.3. Langkah ketiga, copy file env example menjadi env lalu edit file env tersebut. Isi konfigurasi database seperti DB_CONNECTION mysql, DB_HOST 127.0.0.1, DB_PORT 3306, DB_DATABASE siakad_db, DB_USERNAME root, dan DB_PASSWORD dikosongkan saja.

10.4. Langkah keempat, generate key dengan perintah php artisan key generate.

10.5. Langkah kelima, jalankan migration dan seeder dengan perintah php artisan migrate fresh seed. Perintah ini akan menghapus semua tabel yang sudah ada, membuat ulang tabel sesuai migration, dan mengisi data awal dari seeder.

10.6. Langkah keenam, jalankan server dengan perintah php artisan serve.

10.7. Langkah ketujuh, buka browser dan akses alamat http://127.0.0.1:8000. Aplikasi siap digunakan.


11. CARA LOGIN DAN TESTING

11.1. Untuk login sebagai Admin, gunakan email admin@gmail.com dan password admin12345. Setelah login, akan masuk ke Dashboard Admin. Yang bisa dilakukan adalah melihat statistik, mengelola data dosen, mengelola数据 mahasiswa, mengelola mata kuliah, mengelola KRS, dan export Excel.

11.2. Untuk login sebagai Dosen, gunakan email ahmad.rizki@gmail.com dan password dosen12345. Setelah login, akan masuk ke Dashboard Dosen. Yang bisa dilakukan adalah melihat statistik mahasiswa bimbingan, mengelola jadwal mengajar tambah edit hapus, dan melihat mahasiswa bimbingan.

11.3. Untuk login sebagai Mahasiswa, gunakan email galuh.pauline@gmail.com dan password mahasiswa12345. Setelah login, akan masuk ke Dashboard Mahasiswa. Yang bisa dilakukan adalah melihat statistik pribadi, mengambil mata kuliah melalui KRS, menghapus mata kuliah, export PDF KRS, melihat jadwal kuliah, dan melihat nilai.


12. SCREENSHOT

Semua screenshot halaman disimpan di folder screenshots dengan nama file sebagai berikut.

12.1. login.png untuk halaman login
12.2. beranda-prodi.png untuk halaman beranda prodi
12.3. visi-misi.png untuk halaman visi misi
12.4. admin-dashboard.png untuk dashboard admin
12.5. admin-dosen.png untuk data dosen di admin
12.6. admin-mahasiswa.png untuk data mahasiswa di admin
12.7. admin-matakuliah.png untuk data mata kuliah di admin
12.8. admin-krs.png untuk manajemen KRS di admin
12.9. dosen-dashboard.png untuk dashboard dosen
12.10. dosen-jadwal.png untuk jadwal mengajar dosen
12.11. dosen-mahasiswa.png untuk mahasiswa bimbingan dosen
12.12. mahasiswa-dashboard.png untuk dashboard mahasiswa
12.13. mahasiswa-krs.png untuk KRS mahasiswa
12.14. mahasiswa-jadwal.png untuk jadwal kuliah mahasiswa
12.15. mahasiswa-nilai.png untuk nilai mahasiswa


13. VALIDASI LARAVEL

Setiap form yang dibuat menggunakan validasi Laravel.

13.1. Pada DosenController untuk method store, validasi yang digunakan adalah nidn harus diisi, unik di tabel dosen, dan maksimal 10 karakter, serta nama harus diisi dan maksimal 50 karakter.

13.2. Pada MahasiswaController untuk method store, validasi yang digunakan adalah npm harus diisi, unik di tabel mahasiswa, dan maksimal 10 karakter, nidn harus diisi dan ada di tabel dosen, serta nama harus diisi dan maksimal 50 karakter.

13.3. Pada KRSController untuk method store, validasi yang digunakan adalah kode_matakuliah harus diisi dan ada di tabel matakuliah.

13.4. Pada JadwalController untuk method store milik dosen, validasi yang digunakan adalah kode_matakuliah harus diisi dan ada di tabel matakuliah, hari harus diisi dan salah satu dari Senin Selasa Rabu Kamis Jumat Sabtu, jam_mulai harus diisi, jam_selesai harus diisi, kelas harus diisi dan salah satu dari A B C D E, serta ruangan opsional maksimal 50 karakter.

13.5. Pada NilaiController untuk method update, validasi yang digunakan adalah nilai harus diisi berupa angka antara 0 sampai 100.


14. PENJELASAN PER HALAMAN SECARA URUT

14.1. Halaman Login berada di alamat login. Halaman ini memiliki background gambar perpustakaan dengan overlay gelap, form input email dan password, link Beranda untuk menuju halaman profil prodi, dan tombol MASUK.

14.2. Halaman Beranda Prodi berada di alamat prodi. Halaman ini memiliki hero section dengan judul Teknik Informatika, tombol Visi dan Misi, statistik mahasiswa aktif, dosen profesional, mitra industri, dan prestasi nasional, bagian sekilas tentang prodi, berita terbaru, dan kontak alamat telepon email.

14.3. Halaman Visi dan Misi berada di alamat prodi visi misi. Halaman ini berisi visi program studi, enam misi program studi, dan tujuan program studi.

14.4. Dashboard Admin berada di alamat dashboard setelah login sebagai admin. Halaman ini menampilkan statistik cards yaitu total dosen, total mahasiswa, mata kuliah, dan pengambilan KRS. Juga data terbaru seperti dosen terbaru dan mahasiswa terbaru. Serta ringkasan akademik seperti total SKS terambil, rata rata SKS per mahasiswa, dan mahasiswa aktif KRS.

14.5. Data Dosen di admin berada di alamat dosen. Halaman index menampilkan tabel daftar dosen dengan kolom NIDN, Nama, dan Aksi. Ada form tambah dosen, form edit dosen, dan fitur pencarian berdasarkan nama atau NIDN.

14.6. Data Mahasiswa di admin berada di alamat mahasiswa. Halaman index menampilkan tabel daftar mahasiswa dengan kolom NPM, Nama Mahasiswa, Dosen Wali, dan Aksi. Ada form tambah mahasiswa yang memilih dosen wali, form edit mahasiswa, dan fitur pencarian.

14.7. Mata Kuliah di admin berada di alamat matakuliah. Halaman index menampilkan tabel daftar mata kuliah dengan kolom Kode MK, Nama Mata Kuliah, SKS, dan Aksi. Ada form tambah mata kuliah, form edit mata kuliah, dan fitur pencarian.

14.8. Manajemen KRS di admin berada di alamat admin krs. Halaman index menampilkan tabel semua KRS dengan kolom NPM, Nama Mahasiswa, Dosen Wali, Kode MK, Nama Mata Kuliah, SKS, dan Aksi Hapus. Ada filter untuk memilih mahasiswa tertentu, fitur pencarian, dan tombol export Excel.

14.9. Dashboard Dosen berada di alamat dosen dashboard. Halaman ini menampilkan statistik cards yaitu mahasiswa bimbingan, jadwal mengajar, dan total KRS. Juga data terbaru seperti jadwal mengajar terbaru dan mahasiswa bimbingan terbaru.

14.10. Jadwal Mengajar Dosen berada di alamat dosen jadwal. Halaman index menampilkan tabel jadwal mengajar dengan kolom Mata Kuliah, Hari, Jam, Ruangan, Kelas, dan Aksi Edit Hapus. Ada form tambah jadwal yang memilih mata kuliah, hari, jam mulai, jam selesai, kelas, dan ruangan. Ada form edit jadwal. Ada tombol hapus dengan konfirmasi.

14.11. Mahasiswa Bimbingan Dosen berada di alamat dosen mahasiswa. Halaman ini menampilkan tabel mahasiswa bimbingan dengan kolom NPM, Nama Mahasiswa, Jumlah MK Diambil, dan Status.

14.12. Dashboard Mahasiswa berada di alamat dashboard setelah login sebagai mahasiswa. Halaman ini menampilkan statistik cards yaitu mata kuliah diambil, total SKS dengan progres bar, dan IPK semester ini. Juga informasi mahasiswa seperti NPM, Nama Lengkap, Dosen Wali, Status, dan Semester. Serta tabel mata kuliah yang diambil dan informasi sisa kuota SKS.

14.13. KRS Mahasiswa berada di alamat krs. Halaman ini menampilkan statistik cards yaitu total mata kuliah, total SKS dengan progres bar, dan maksimal SKS. Juga tabel KRS dengan kolom Kode MK, Mata Kuliah, SKS, Tanggal Ambil, dan Aksi Hapus. Ada tombol export PDF dan tombol ambil mata kuliah yang membuka modal berisi daftar mata kuliah yang belum diambil.

14.14. Jadwal Kuliah Mahasiswa berada di alamat jadwal. Halaman ini menampilkan tabel jadwal dengan kolom Kode MK, Mata Kuliah, SKS, Hari, Jam, Ruangan, dan Dosen. Jadwal diurutkan berdasarkan hari dari Senin sampai Jumat.

14.15. Nilai Saya Mahasiswa berada di alamat nilai. Halaman ini menampilkan tabel nilai dengan kolom Kode MK, Mata Kuliah, SKS, Nilai, Grade, dan Status. Juga statistik total SKS dan IPS semester ini. Serta keterangan grade yaitu A untuk nilai 85 sampai 100, B untuk nilai 75 sampai 84, C untuk nilai 65 sampai 74, dan D atau E untuk nilai kurang dari atau sama dengan 64.


15. KESIMPULAN

Semua komponen yang diminta dalam tugas besar telah terpenuhi.

15.1. Migration sudah dibuat untuk semua tabel sesuai ERD.

15.2. Seeder sudah dibuat dan berisi data awal untuk dosen, mahasiswa, mata kuliah, jadwal, dan KRS.

15.3. Eloquent ORM digunakan di semua model.

15.4. Eloquent Relationship sudah didefinisikan dengan benar antara tabel dosen, mahasiswa, matakuliah, jadwal, krs, dan users.

15.5. Middleware Role berfungsi dengan baik untuk membatasi akses berdasarkan role user.

15.6. Authentication login dan logout menggunakan Laravel Breeze berfungsi dengan baik.

15.7. CRUD Dosen yang meliputi tambah, edit, hapus, lihat, dan cari sudah berfungsi.

15.8. CRUD Mahasiswa yang meliputi tambah, edit, hapus, lihat, dan cari sudah berfungsi.

15.9. CRUD Mata Kuliah yang meliputi tambah, edit, hapus, lihat, dan cari sudah berfungsi.

15.10. CRUD Jadwal untuk dosen yang meliputi tambah, edit, hapus, lihat sudah berfungsi.

15.11. CRUD KRS untuk mahasiswa yang meliputi ambil mata kuliah dan hapus mata kuliah sudah berfungsi.

15.12. Validasi form menggunakan Laravel Validation sudah diterapkan di semua form.

15.13. Dashboard statistik untuk admin, dosen, dan mahasiswa sudah berfungsi.

15.14. Fitur pencarian dan filter data sudah berfungsi di semua halaman data.

15.15. Export Excel untuk admin sudah berfungsi.

15.16. Export PDF untuk mahasiswa sudah berfungsi.

15.17. Halaman publik Beranda dan Visi Misi sudah berfungsi dengan baik.

Dengan demikian, aplikasi SIAKAD ini dinyatakan SELESAI dan SESUAI dengan semua ketentuan tugas yang diberikan. Aplikasi siap dikumpulkan dan dipresentasikan kepada dosen pembimbing.


16. LINK REPOSITORY

Repository GitHub dari project ini dapat diakses melalui alamat https://github.com/GaluhPaulineNugraha/tubes-siakad-ifa2024-5520124008-GaluhPaulineNugraha.git


17. PENUTUP

Terima kasih kepada dosen pembimbing yang telah memberikan arahan selama pengerjaan tugas besar ini. Aplikasi ini dibuat dengan sebaik baiknya sesuai dengan kemampuan dan pengetahuan yang dimiliki. Semoga tugas besar ini dapat memberikan manfaat dan mendapatkan penilaian yang terbaik.
