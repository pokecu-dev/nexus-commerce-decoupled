# 📖 Kitab Suci Panduan Laravel - Nexus Commerce

Dokumentasi mandiri ini dirancang khusus untuk tim *developer* agar bisa memahami alur kerja, struktur folder, serta daftar perintah Artisan secara lengkap, bahkan saat sedang *coding offline*.

---

## 📂 1. Anatomi Struktur Direktori & File Laravel

Laravel menggunakan arsitektur **MVC (Model-View-Controller)**. Berikut adalah jeroan folder penting yang wajib dipahami:

* **`app/` (Jantung Utama Logika)**
    * **`Models/`**: Berisi file representasi tabel database. Contoh: `User.php`. Di sini tempat mengatur komunikasi ke database menggunakan gaya OOP (Eloquent ORM). Nama file disepakati menggunakan bentuk **Tunggal (Singular)**.
    * **`Http/Controllers/`**: Otak dari segala logika bisnis *backend* (proses registrasi, kalkulasi harga, login, dll). Controller menerima *request* dari Frontend, menyuruh Model mengambil data dari DB, lalu mengirimkannya kembali dalam bentuk JSON.
* **`config/`**: Kumpulan file PHP berisi pengaturan global aplikasi (koneksi database, konfigurasi email, keamanan, session, dll).
* **`database/` (Pusat Pengelolaan Data)**
    * **`migrations/`**: Berisi file cetak biru/skema tabel database. Ini adalah *version control* database kita, sehingga tidak perlu ekspor-impor file `.sql` manual.
    * **`seeders/`**: Tempat menyimpan file penyuntik data awal/dummy (seperti akun admin default atau data dump kelompok di `UserSeeder.php`).
* **`routes/` (Pengatur Pintu Gerbang URL)**
    * **`api.php`**: Khusus untuk mendaftarkan URL endpoint REST API yang akan dikonsumsi oleh Frontend (`fetch`). Semua rute di sini otomatis memiliki prefix `/api/` (Contoh: `localhost/api/users`).
    * **`web.php`**: Digunakan jika Frontend dan Backend digabung menjadi satu (Monolithic menggunakan Blade). Di proyek decoupled ini, file ini diabaikan.
* **`public/`**: Folder yang menampung aset yang bisa diakses langsung secara publik oleh browser (gambar produk, file upload, file index utama).
* **`vendor/`**: Gudang berisi ribuan library pihak ketiga hasil download dari Composer. **Catatan: Folder ini super berat dan WAJIB dimasukkan ke dalam file `.gitignore`!**
* **`.env`**: File konfigurasi sensitif (Credential database, Password, App Key). Jangan pernah men-share file ini ke publik!

---

## 🛠️ 2. Kamus Perintah Utama Artisan (Artisan Command Reference)

*Catatan untuk Pengguna Docker Sail:* Jika kamu menggunakan Laravel Sail di WSL/Linux, jalankan perintah di bawah dengan awalan `./vendor/bin/sail` (Contoh: `./vendor/bin/sail artisan list`).

### 🏗️ Core Commands (Perintah Dasar)
* `php artisan list` : Menampilkan seluruh daftar perintah Artisan yang tersedia di aplikasi.
* `php artisan help [command]` : Menampilkan dokumentasi bantuan spesifik untuk perintah tertentu.
* `php artisan serve` : Menjalankan local development server bawaan PHP.
* `php artisan tinker` : Membuka shell interaktif (REPL) untuk mengetes kode PHP dan Eloquent secara langsung tanpa lewat browser.
* `php artisan about` : Menampilkan informasi dasar mengenai environment, versi PHP, caching, dan aplikasi.

### 🔨 Scaffolding (Perintah Pembuat File / Make)
* `php artisan make:model [Name]` : Membuat file Model baru (Gunakan huruf kapital tunggal, misal: `Product`).
* `php artisan make:model [Name] -m` : Membuat file Model sekaligus dengan file cetak biru Migration-nya secara otomatis.
* `php artisan make:controller [Name]` : Membuat file Controller baru (Contoh: `UserController`).
* `php artisan make:migration [Name]` : Membuat file cetak biru database baru secara manual.
* `php artisan make:seeder [Name]` : Membuat file Seeder baru untuk pengisian data awal.
* `php artisan make:factory [Name]` : Membuat model Factory untuk menghasilkan ratusan data palsu otomatis demi keperluan testing.
* `php artisan make:middleware [Name]` : Membuat kelas Middleware untuk memfilter request HTTP (misal: cek login).
* `php artisan make:request [Name]` : Membuat kelas Custom Request khusus untuk validasi form input agar Controller tetap bersih.

### 🗄️ Database Management (Pengelolaan Database)
* `php artisan migrate` : Menjalankan semua file migration yang berstatus pending ke database.
* `php artisan migrate:rollback` : Membatalkan atau menarik mundur batch migrasi database terakhir (seperti perintah Undo/Ctrl+Z).
* `php artisan migrate:fresh` : Menghapus (*drop*) seluruh tabel di database tanpa sisa, lalu membangunnya ulang dari nol.
* `php artisan db:seed` : Menjalankan class seeder untuk mengisi database dengan data bawaan.
* `php artisan migrate:fresh --seed` : Menghapus semua tabel, membangun ulang dari awal, dan langsung menyuntikkan seluruh data seeder. (Sangat berguna saat reset data).
* `php artisan db:show` : Memberikan gambaran umum mengenai tipe database, port, dan status koneksi aktif.
* `php artisan db:table [Name]` : Menampilkan detail struktur, atribut, dan jumlah baris data dari tabel tertentu.

### ⚡ Optimization & Cache (Performa Produksi)
* `php artisan optimize` : Membuat cache untuk konfigurasi, rute, dan view sekaligus demi mendongkrak performa di server production.
* `php artisan optimize:clear` : Menghapus seluruh file cache yang dihasilkan oleh perintah optimasi.
* `php artisan config:cache` : Menggabungkan semua file konfigurasi menjadi satu file cache tunggal agar loading lebih kilat.
* `php artisan config:clear` : Menghapus file cache konfigurasi.
* `php artisan route:cache` : Membuat cache rute untuk mempercepat pencarian URL.
* `php artisan route:clear` : Menghapus cache rute.
* `php artisan cache:clear` : Mengosongkan seluruh media penyimpanan cache aplikasi.

### 🌐 Routing & Security (Lalu Lintas & Keamanan)
* `php artisan route:list` : Menampilkan tabel komprehensif berisi seluruh rute URL, metode HTTP (`GET/POST`), nama controller, dan middleware yang terdaftar.
* `php artisan key:generate` : Membuat kunci enkripsi aplikasi (`APP_KEY`) baru dan otomatis menyimpannya ke dalam file `.env`.
* `php artisan down` : Mengubah status aplikasi menjadi mode maintainance (Website tidak bisa diakses publik sementara).
* `php artisan up` : Mengaktifkan kembali aplikasi dari mode maintainance.

### 📦 Queue & Storage (Antrean & Penyimpanan)
* `php artisan queue:work` : Menjalankan sistem antrean background job (seperti pengiriman email massal di balik layar).
* `php artisan storage:link` : Membuat symlink (jembatan jalan pintas) dari folder `storage/app/public` ke folder `public/storage` agar file yang diupload user bisa diakses langsung via URL browser.