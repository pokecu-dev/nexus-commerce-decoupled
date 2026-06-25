# 🌌 Nexus Commerce - Decoupled Architecture

Repositori resmi untuk pengembangan sistem **Nexus Commerce** menggunakan arsitektur modern *Decoupled* (Pemisahan total antara Sisi Backend API dan Sisi Frontend UI).

---

## 🚀 Anggota Tim Kelompok
* **Backend Developer / QA Bug Hunter:** pokecu-dev 🎯
* **Contributor / UI Frontend Team:** none 👥

---

## 🛠️ Tech Stack yang Digunakan
* **Backend Engine:** Laravel 11+ (PHP 8.2+)
* **Database:** MySQL via Docker Containers
* **Development Environment:** Laravel Sail & Windows Subsystem for Linux (WSL - Kali Linux)
* **Frontend UI:** Vanilla HTML, JavaScript Modern (`fetch` API), dan Tailwind CSS v4

---

## 🔌 Dokumentasi Endpoint API Aktif

Saat ini Backend telah menyediakan endpoint yang siap dikonsumsi secara real-time oleh sisi Frontend:

### 1. Ambil Semua Data Pengguna
* **URL:** `/api/users`
* **Method:** `GET`
* **Format Respons (JSON):**
    ```json
    {
      "status": "success",
      "message": "Data user berhasil diambil!",
      "data": [
        {
          "ID": 1,
          "USERNAME": "adin",
          "NAMA_LENGKAP": "MUHAMMAD SAIFUDDIN",
          "ROLE": "PEMBELI",
          "STATUS": "1"
        },
        {
          "ID": 3,
          "USERNAME": "mulyono",
          "NAMA_LENGKAP": "bapak mulyono",
          "ROLE": "PEMBELI",
          "STATUS": "1"
        }
      ]
    }
    ```

---

## 🏃‍♂️ Panduan Cara Menjalankan Proyek di Lokal

### Prasyarat (Prerequisites)
Pastikan laptop/komputer kamu sudah menginstal **Docker Desktop** dan **WSL** (rekomendasi Kali Linux/Ubuntu).

### Langkah-Langkah Menjalankan Backend:
1.  Masuk ke terminal WSL kamu, lalu navigasi ke folder project:
    ```bash
    cd mini-ecommerce-api
    ```
2.  Nyalakan container Docker Sail dalam mode background (detached):
    ```bash
    ./vendor/bin/sail up -d
    ```
3.  Lakukan reset database, migrasi skema struktur kustom kelompok, sekaligus jalankan seeding data otomatis:
    ```bash
    ./vendor/bin/sail artisan migrate:fresh --seed
    ```
4.  Akses API di browser kamu untuk memastikan server menyala:
    `http://localhost/api/users`

### Langkah-Langkah Menjalankan Frontend:
1.  Buka folder `front-end/` menggunakan VS Code.
2.  Klik tombol **"Go Live"** (Live Server extension) di pojok kanan bawah VS Code.
3.  Halaman web otomatis terbuka di browser Windows kamu dan langsung melakukan integrasi fetch data secara real-time dari container Docker Laravel.

---

## 📜 Panduan Mandiri Perintah Laravel
Untuk daftar lengkap penjelasan folder, arsitektur backend, dan seluruh list perintah Artisan esensial untuk ngoding *offline*, silakan baca file panduan internal kelompok di: [LARAVEL_GUIDE.md](./LARAVEL_GUIDE.md).