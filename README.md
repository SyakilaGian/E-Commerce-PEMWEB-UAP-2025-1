# KiStore (KariSya Store) - E-Commerce Web Application

**KiStore** adalah sebuah aplikasi web E-Commerce berbasis **Laravel** yang mempertemukan Penjual (Seller) dan Pembeli (Buyer) dalam satu platform. Aplikasi ini dilengkapi dengan sistem manajemen produk, verifikasi toko, dan sistem pembayaran digital internal (E-Wallet).

Proyek ini dibuat untuk memenuhi tugas Final Project / UAP Pemrograman Web.

---

## Anggota Kelompok

| No  | Nama Lengkap | NIM | Peran / Jobdesk |
| :-- | :--- | :--- | :--- |
| 1.  | **Syakila Gian Nayla** | **245150607111010** | **Frontend & User Features** (Homepage, Checkout, Wallet, Profile) |
| 2.  | **Karina Amelia Wulandari** | **245150607111013** | **Backend & Admin/Seller** (Dashboard, CRUD Produk, Verifikasi Toko) |

## Fitur Utama

Aplikasi ini memiliki 3 hak akses (Role) dengan fitur yang berbeda:

### 1. Pengguna (Buyer/Member)
* **Registrasi & login:** Autentikasi pengguna yang aman.
* **Browsing produk:** Mencari produk berdasarkan kategori dan melihat detail produk.
* **Profil toko:** Melihat etalase dan informasi toko penjual.
* **Pembelian (Checkout):** Membeli produk secara langsung (*Direct Purchase*).
* **E-Wallet (Saldo):** Fitur Top-up saldo dan pembayaran menggunakan saldo akun.
* **Riwayat pesanan:** Melacak status pembelian (Paid/Unpaid).
* **Daftar toko:** Mengajukan permintaan untuk menjadi Seller.

### 2. Penjual (Seller)
* **Dashboard seller:** Ringkasan penjualan dan stok.
* **Manajemen produk:** Tambah, Edit, Hapus produk dengan fitur upload gambar.
* **Manajemen pesanan:** Melihat pesanan masuk dari pembeli.
* **Dompet toko:** Melihat pendapatan hasil penjualan.

### 3. Admin
* **Verifikasi toko:** Menyetujui atau menolak pengajuan toko baru dari member.
* **User management:** Mengelola pengguna yang terdaftar.

---

## Teknologi yang Digunakan

* **Framework:** Laravel 10 / 11
* **Bahasa Pemrograman:** PHP 8.2+
* **Database:** MySQL
* **Frontend Styling:** Tailwind CSS (via CDN/Vite)
* **Library Tambahan:**
    * `intervention/image` (Untuk manipulasi & resize upload foto produk)
    * `laravel/breeze` (Untuk sistem autentikasi)

---

## Cara Instalasi (Run Locally)

Ikuti langkah berikut untuk menjalankan proyek ini di komputer lokal:

1.  **Clone Repositori**
    ```bash
    git clone [https://github.com/USERNAME/NAMA-REPO.git](https://github.com/SyakilaGian/E-Commerce-PEMWEB-UAP-2025-1.git)
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    npm install && npm run build
    ```

3.  **Setup Environment**
    Salin file `.env.example` menjadi `.env`:
    ```bash
    cp .env.example .env
    ```
    Buka file `.env` dan sesuaikan konfigurasi database:
    ```env
    DB_DATABASE=nama_database_kalian
    DB_USERNAME=root
    DB_PASSWORD=
    ```

4.  **Generate Key & Storage Link**
    ```bash
    php artisan key:generate
    php artisan storage:link
    ```

5.  **Migrasi & Seeding Database**
    Jalankan perintah ini untuk membuat tabel dan mengisi data dummy (Admin, Seller, Produk):
    ```bash
    php artisan migrate:fresh --seed
    ```

6.  **Jalankan Server**
    ```bash
    php artisan serve
    ```
    Buka browser dan akses: `http://127.0.0.1:8000`

---

## Akun Demo (Login Credentials)

Setelah melakukan seeding (`php artisan migrate:fresh --seed`), gunakan akun berikut untuk mencoba aplikasi:

* **Admin:** `admin@toko.com` / `password`
* **Seller:** `amelia@store.com` / `password`
* **Buyer:** `gian@gmail.com` / `password`
