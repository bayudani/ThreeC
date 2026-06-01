# Project Context: Sistem Web Laporan Progres Ormawa Kampus (Three-C (cakra control center	))

## Deskripsi

Sistem Informasi Manajemen (SIM) berbasis web untuk monitoring, evaluasi (monev), dan pelaporan program kerja (proker) Organisasi Mahasiswa (Ormawa) di lingkungan kampus. Sistem ini memfasilitasi transparansi antara Ormawa dan pihak Kampus (Rektorat/Kemahasiswaan).

## Tech Stack

* **Backend:** Laravel 13.x
* **Frontend / Reactivity:** Livewire v3 (Class-based components) + Alpine.js
* **Styling:** Tailwind CSS (mengacu pada `design.md`)
* **Database:** MySQL
* **Storage:** Local Storage Laravel (`storage/app/public`)

## Role & Akses (RBAC)

1. **Admin Kampus (Superadmin):**
   * Bisa CRUD data master Ormawa.
   * Bisa membuatkan akun (User) untuk Admin Ormawa.
   * View/Monitoring semua Proker dan progresnya (Dashboard Analitik).
   * Export Laporan.
2. **Admin Ormawa:**
   * Login menggunakan `username` (nama ormawa/singkatan) atau `email`.
   * Mengelola (CRUD) Proker milik ormawanya sendiri.
   * Update status proker (Belum Dimulai, Berjalan, Selesai).
   * Upload file bukti dokumentasi (gambar/pdf).
3. **Viewer (Opsional):**
   * Hanya Read-Only data progres.

## Aturan Pengembangan (Developer Rules untuk AI)

1. **Livewire First:** Gunakan Livewire v3 dengan pendekatan class-based (`php artisan make:livewire ComponentName`). Pisahkan logic di `.php` dan view di `.blade.php`.
2. **Single Responsibility:** Buat komponen Livewire yang spesifik (contoh: `OrmawaTable`, `ProkerForm`, `ProgresChart`).
3. **Validasi:** Selalu gunakan form validation di Livewire sebelum menyimpan ke database.
4. **File Upload:** Gunakan fitur `WithFileUploads` bawaan Livewire, simpan ke disk `public`.
5. **No N+1 Queries:** Selalu gunakan eager loading (`with()`) di model Eloquent saat memanggil relasi.
