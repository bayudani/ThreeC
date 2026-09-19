<div align="center">

# Three-C (Cakra Control Center)

**Sistem Informasi Manajemen Organisasi Kemahasiswaan**

Platform manajemen, monitoring, dan evaluasi organisasi mahasiswa (Ormawa) & Unit Kegiatan Mahasiswa (UKM) berbasis web — digunakan oleh admin kemahasiswaan kampus dan pengurus organisasi.

![Laravel](https://img.shields.io/badge/Laravel-13-FF2D20?style=flat-square&logo=laravel&logoColor=white) ![PHP](https://img.shields.io/badge/PHP-8.3+-777BB4?style=flat-square&logo=php&logoColor=white) ![Livewire](https://img.shields.io/badge/Livewire-3.6-4E56A6?style=flat-square&logo=livewire&logoColor=white) ![TailwindCSS](https://img.shields.io/badge/TailwindCSS-3-06B6D4?style=flat-square&logo=tailwindcss&logoColor=white) ![MySQL](https://img.shields.io/badge/MySQL-8-4479A1?style=flat-square&logo=mysql&logoColor=white)

</div>

---

## Daftar Isi

- [Ringkasan](#ringkasan)
- [Fitur Utama](#fitur-utama)
- [Struktur Peran](#struktur-peran)
- [Teknologi](#teknologi)
- [Alur Aplikasi](#alur-aplikasi)
- [Arsitektur](#arsitektur)
- [Skema Database](#skema-database)
- [Struktur Direktori](#struktur-direktori)
- [Instalasi](#instalasi)
- [Akun Default (Local Dev)](#akun-default-local-dev)
- [PDF & CSV Export](#pdf--csv-export)
- [Desain Sistem](#desain-sistem)

---

## Ringkasan

**Three-C (Cakra Control Center)** adalah platform digital tata kelola organisasi kemahasiswaan untuk lingkungan kampus. Sistem ini menghubungkan dua aktor utama:

| Aktor | Peran |
|---|---|
| **Admin Kemahasiswaan** | Mengelola ormawa/UKM, memvalidasi program kerja, memantau progress, mengevaluasi kinerja, mengelola laporan & pengumuman |
| **Admin Ormawa/UKM** | Mengusulkan program kerja, memperbarui progress, mengunggah dokumentasi/bukti kegiatan |

Setiap program kerja (Proker) yang diajukan oleh ormawa **harus divalidasi/disetujui** oleh admin kampus sebelum ormawa dapat menjalankannya dan memperbarui progresnya.

---

## Fitur Utama

### Panel Admin Kampus (`/admin/*`)

1. **Dashboard Monitoring**
   - Statistik total ormawa & UKM (terpisah), total proker, proker yang berjalan/selesai
   - Grafik jumlah proker per kategori (Legislatif, Eksekutif, UKM)
   - Tingkat keberhasilan (success rate)
   - *Activity feed* — aktivitas terbaru (upload dokumentasi, proker baru)

2. **Manajemen Ormawa & UKM**
   - Halaman **terpisah**: `Manajemen Ormawa` dan `Manajemen UKM`
   - CRUD data organisasi — nama, kategori, fakultas, periode, logo
   - Mode tampilan: **tabel** dan **kartu (grid)**
   - Pencarian, filter kategori, pagination
   - **Akun otomatis**: saat menambah ormawa, sistem membuat akun `admin_ormawa` sekaligus (username + password ditampilkan di UI)
   - Lihat password admin ormawa (toggle tampil/sembunyi)

3. **Validasi Program Kerja**
   - Daftar semua proker dari seluruh ormawa
   - **Setujui** → `validated_at` diisi, status menjadi `berjalan`
   - **Tolak** → wajib mengisi alasan penolakan (`rejection_reason`)
   - Filter status: Semua / Menunggu / Berjalan / Selesai / Ditolak
   - Statistik: berjalan, menunggu validasi, ditolak, success rate

4. **Detail Program Kerja** (read-only)
   - Header hero dengan info ormawa & target waktu
   - Kartu progress dengan bar dinamis
   - Timeline 4 tahapan (Belum Dimulai → Berjalan → Selesai)
   - Grid dokumentasi dengan hover & link buka
   - Sidebar info terperinci (ormawa, kategori, status, progress, target)

5. **Monitoring & Evaluasi (Monev)**
   - Tabel evaluasi per ormawa dengan `withCount`:
     - Total proker, selesai, berjalan, belum dimulai
     - **Success rate** agregat per ormawa
   - Filter kategori & periode

6. **Dokumentasi / Laporan**
   - Upload & kelola dokumen (PDF, DOC, XLSX, gambar; maks 10MB)
   - Filter per ormawa
   - 📄 **Export PDF** (via dompdf, A4 landscape) dan **CSV** (dengan BOM untuk Excel)
   - Preview dokumen dalam modal

7. **Manajemen Pengumuman**
   - CRUD pengumuman (judul, isi, tipe: mendesak/info/kegiatan)
   - Toggle aktif/nonaktif, hapus
   - Tampil terbatas di dashboard ormawa

### Panel Admin Ormawa / UKM (`/ormawa/*`)

1. **Dashboard**
   - Kartu metrik: total proker, berjalan, selesai, butuh dokumentasi
   - Daftar proker terkini dengan progress bar
   - Pengumuman kampus terbaru (border warna sesuai tipe)

2. **Program Kerja**
   - **Buat proker** (modal inline); status awal `belum_dimulai`, menunggu validasi
   - Daftar proker dengan status validasi (Menunggu / Ditolak dengan alasan)
   - **Update progress** — otomatis mengubah status:
     - `0%` → `belum_dimulai`
     - `<100%` → `berjalan`
     - `100%` → `selesai`
   - **Upload dokumentasi/bukti** (JPG, PNG, PDF; maks 2MB)
   - ⛔ Proker yang **belum divalidasi** atau **ditolak** tidak dapat di-update progress/dokumentasinya

3. **Detail Proker**
   - Detail lengkap + update progress & upload/hapus dokumentasi
   - Dibatasi hanya proker milik ormawa sendiri (guard role)

### Fitur Umum

- **Login** menggunakan email **atau** username (auto-detect)
- **Profile**: update informasi akun + ganti password
- **Search global** di topbar (search ormawa & proker lintas menu)
- **Pagination kustom** berbahasa Indonesia (`1 — 10 dari 50 data`)
- **Role-based middleware** (`auth` + `role:admin_kampus` / `role:admin_ormawa`)
- Notifikasi toast sukses di setiap aksi

---

## Struktur Peran

```
┌────────────────────────────┐
│     ADMIN KAMPUS           │  role: admin_kampus
│  (Super Admin / Kabag     │
│   Kemahasiswaan)          │
└─────────────┬──────────────┘
              │  Validasi Proker
              ▼
┌────────────────────────────┐
│   ADMIN ORMAWA / UKM       │  role: admin_ormawa
│  (Pengurus organisasi)     │  terikat ormawa_id
└────────────────────────────┘
```

**Alur Validasi Program Kerja:**

```
[Ormawa] Usulkan Proker         → status: belum_dimulai, validated_at: null
      ▼
[Admin] Setujui                 → validated_at: now, status: berjalan
      ▼
[Ormawa] Update progress +      → progress 0-100 → status otomatis
         upload dokumentasi        (100% = selesai)
      ▼
[Admin] Pantau di Dashboard / Monev / Export

── Alternatif ─────────────────────────────────────────────
[Admin] Tolak (dengan alasan)   → rejection_reason: "..." (proker terkunci)
[Ormawa] Perbaiki & ajukan lagi (opsional)
```

Bantuan sebaran peran di middleware: `app/Http/Middleware/CheckRole.php`.

---

## Teknologi

| Layer | Teknologi | Versi |
|---|---|---|
| Backend | Laravel (PHP 8.3+) | ^13.8 |
| Reactive UI | Livewire + Volt | ^3.6 / ^1.7 |
| Frontend | Blade + Tailwind CSS + Alpine.js | Tailwind ^3.1 |
| Build tool | Vite + laravel-vite-plugin | ^8.0 / ^3.1 |
| Database | MySQL | 8.x |
| PDF | barryvdh/laravel-dompdf | ^3.1 |
| Package tambahan | laravel/breeze (scaffold), laravel/pint, laravel/pail, tinker | — |
| Form handling | @tailwindcss/forms + Alpine inline | — |
| Testing | PHPUnit (SQLite in-memory) | ^12.5 |

> Sistem ini **tidak** menggunakan framework frontend (React/Vue). Seluruh interaktivitas ditangani Livewire + Alpine.js inline di Blade.

---

## Alur Aplikasi

### 1. Autentikasi
- Login menerima `username` **atau** `email` (deteksi otomatis dengan `FILTER_VALIDATE_EMAIL`)
- Redirect sesuai role: `admin_kampus` → `/admin/dashboard`, lainnya → `/ormawa/dashboard`
- `/` dan `/dashboard` adalah redirector pintar berdasarkan role & status autentikasi

### 2. Alur data ormawa (admin kampus)
1. Admin menambah ormawa/UKM → sistem otomatis membuat akun `admin_ormawa` (username = nama tanpa spasi, password pola `{username}unsera@26`)
2. Akun & password bisa dilihat/ditampilkan di tabel/card ("lihat password" toggle)
3. Menghapus ormawa → akun dan data terkait ikut terhapus

### 3. Alur program kerja
1. **Ormawa** membuka `/ormawa/proker` → "Buat Program Kerja"
2. Proker tersimpan dengan `validated_at = null` → status badge "Menunggu Validasi"
3. **Admin** membuka `/admin/proker` → lihat badge "Menunggu Validasi"
   - **Setujui** → `validated_at = now()`, `status = berjalan`
   - **Tolak** → isi alasan → `rejection_reason` tersimpan, badge "Ditolak" + alasan
4. **Ormawa** pada proker valid → tombol "Update Progress" & "Upload Bukti" aktif
   - Proker pending/ditolak → tombol nonaktif ("Menunggu"/"Ditolak")
5. Progress tersimpan → status otomatis berubah di model & badge
6. **Admin** memantau via detail proker, dashboard, monev, atau export laporan

### 4. Monitoring & Evaluasi
- Halaman `/admin/evaluasi` menampilkan tabel agregat per ormawa (jumlah & sukses rate)
- `LaporanExportController` mengenerate **PDF/CSV** dengan parameter `periode` & `format`

---

## Arsitektur

```
                            ┌─────────────────────────────┐
                            │        HTTP (Web)           │
                            └──────────────┬──────────────┘
                                           ▼
                            ┌─────────────────────────────┐
                            │   routes/web.php (+auth)    │
                            │   middleware: auth, role:*   │
                            └──────────────┬──────────────┘
                                           ▼
              ┌──────────────────────────────────────────────┐
              │            LIVE WIRE COMPONENTS              │
              │   Admin/: Dashboard, ManajemenOrmawa,        │
              │     ProgramKerja, ProkerDetail, Laporan,     │
              │     Evaluasi, ManajemenPengumuman            │
              │   Ormawa/: Dashboard, ProgramKerja,          │
              │     DetailProker, Laporan                    │
              │   Root/: Auth\Login, Profile, TopbarSearch,  │
              │     Actions\Logout                           │
              └──────────────┬───────────────────────────────┘
                             │  Eloquent ORM
                             ▼
              ┌──────────────────────────────────────────────┐
              │   app/Models                                 │
              │   User · Ormawa · Proker ·                   │
              │   Dokumentasi · Pengumuman                   │
              └──────────────┬───────────────────────────────┘
                             ▼
              ┌─────────────────┐   ┌──────────────────────────┐
              │     MySQL       │   │  Storage (public disk)   │
              │   (10 tables)   │   │  logos/ · dokumentasi/ · │
              └─────────────────┘   │  laporan/                │
                                    └──────────────────────────┘
```

### Pola yang digunakan

- **Full-page Livewire components** (setiap halaman = 1 class + 1 blade) dengan layout `#[Layout('layouts.app')]` / `layouts.guest`
- `#[Fillable]`, `#[Hidden]`, `#[Append]` — atribut PHP native (gaya Laravel modern) di model
- Middleware aliased `role` di `bootstrap/app.php` untuk proteksi berbasis peran
- `WithPagination` + `WithFileUploads` traits dari Livewire
- Custom pagination vendor (`resources/views/vendor/livewire/tailwind.blade.php`)
- Upload file ke `storage/app/public/{logos,dokumentasi,laporan}` lalu disajikan via `Storage::url()`
- Komponen `ManajemenOrmawa` **dipakai ulang** untuk halaman Ormawa **dan** UKM (mode ditentukan dari nama route di `mount()`)

---

## Skema Database

```
┌───────────────┐          ┌───────────────┐          ┌─────────────────┐
│    users      │          │   ormawas     │          │    prokers      │
├───────────────┤          ├───────────────┤          ├─────────────────┤
│ id            │◄─────────│ id            │◄─────────│ id              │
│ name          │  FK set  │ nama          │   CASCADE│ ormawa_id   FK  │
│ username (uniq)│  NULL    │ kategori      │          │ nama_proker     │
│ email (uniq)  │          │ fakultas (nul)│          │ deskripsi (nul) │
│ email_verified│          │ periode (nul) │          │ target_waktu    │
│ password      │          │ logo (nul)    │          │ status   (enum) │
│ role (enum)   │          └───────────────┘          │ progress (tint)│
│ ormawa_id  FK │                                    │ validated_at    │
│ rememberToken │                                    │ rejection_reason│
│ timestamps    │                                    └────────┬────────┘
└───────────────┘                                             │ CASCADE
                                                              ▼
┌──────────────────┐         ┌──────────────────┐   ┌─────────────────┐
│   pengumumans    │         │   dokumentasis   │   │ password_reset  │
├──────────────────┤         ├──────────────────┤   │ tokens          │
│ id               │         │ id               │   ├─────────────────┤
│ judul            │         │ proker_id     FK │   │ email (PK)      │
│ isi              │         │ file_path        │   │ token           │
│ tipe (enum)      │         │ keterangan (nul) │   │ created_at      │
│ is_active (bool) │         │ timestamps       │   └─────────────────┘
│ timestamps       │         └──────────────────┘
└──────────────────┘
```

### Detail tabel

| Tabel | Kolom penting | Catatan |
|---|---|---|
| **users** | `role` enum `[admin_kampus, admin_ormawa, viewer]`, `ormawa_id` FK (SET NULL on delete) | `username` unique, login pakai username/email |
| **ormawas** | `kategori` (`Legislatif` / `Eksekutif` / `UKM`), `logo` nullable | `Ormawa` model meng-*append* `admin_password` (computed) |
| **prokers** | `status` enum `[belum_dimulai, berjalan, selesai]` (default `belum_dimulai`), `progress` tinyInt default 0, `validated_at` nullable, `rejection_reason` nullable | CASCADE on ormawa delete |
| **dokumentasis** | `file_path`, `keterangan` nullable | CASCADE on proker delete |
| **pengumumans** | `tipe` enum `[mendesak, info, kegiatan]`, `is_active` bool default true | Berdiri sendiri |
| **jobs / job_batches / failed_jobs** | Standar Laravel queue | Untuk job queue |
| **cache / cache_locks / sessions** | Standar Laravel | — |

---

## Struktur Direktori

```
three-c/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/LaporanExportController.php   # Export PDF & CSV
│   │   │   └── Auth/VerifyEmailController.php
│   │   └── Middleware/CheckRole.php                # Penjaga role
│   ├── Livewire/
│   │   ├── Admin/            # 7 komponen admin
│   │   ├── Ormawa/           # 4 komponen ormawa
│   │   ├── Auth/Login.php
│   │   ├── Actions/Logout.php
│   │   ├── Forms/LoginForm.php
│   │   ├── Profile.php
│   │   └── TopbarSearch.php
│   ├── Models/               # User, Ormawa, Proker, Dokumentasi, Pengumuman
│   ├── Providers/
│   └── View/Components/      # AppLayout, GuestLayout
├── bootstrap/app.php         # Alias middleware 'role'
├── database/
│   ├── factories/
│   ├── migrations/           # 10 file migration
│   └── seeders/              # DatabaseSeeder, OrmawaSeeder, ProkerSeeder
├── public/images/            # logo.png, bg.jpeg
├── resources/
│   ├── css/app.css
│   ├── js/app.js
│   └── views/
│       ├── components/       # sidebar, topbar, modal, buttons, input, dll
│       ├── export/laporan-pdf.blade.php
│       ├── layouts/          # app.blade.php, guest.blade.php
│       ├── livewire/         # Halaman per komponen
│       └── vendor/livewire/  # Custom pagination
├── routes/
│   ├── web.php
│   ├── auth.php
│   └── console.php
├── storage/app/public/       # logos/ · dokumentasi/ · laporan/
├── tailwind.config.js
├── vite.config.js
├── composer.json
└── package.json
```

---

## Instalasi

### Prasyarat

- PHP **8.3+**
- Composer
- Node.js & NPM
- MySQL 8.x
- (Opsional) Ngrok untuk akses publik https

### Langkah

```bash
# 1. Clone repositori
git clone <repository-url> three-c
cd three-c

# 2. Install dependency
composer install
npm install

# 3. Setup environment
cp .env.example .env
php artisan key:generate

# 4. Konfigurasi .env
#    DB_DATABASE=three_c
#    DB_USERNAME=root
#    DB_PASSWORD=
#    APP_URL=http://127.0.0.1:8000

# 5. Migrasi & seeder
php artisan migrate --seed

# 6. Symlink storage
php artisan storage:link

# 7. Build aset
npm run build
# atau saat development: npm run dev

# 8. Jalankan server
php artisan serve
```

> Alternatif: gunakan script bawaan — `composer setup` (install + key + migrate + build) dan `composer dev` (menjalankan `artisan serve`, queue, pail, dan Vite secara paralel).

### Akses

```
Admin Kampus   → http://127.0.0.1:8000/admin/dashboard
Admin Ormawa   → http://127.0.0.1:8000/ormawa/dashboard
```

---

## Akun Default (Local Dev)

Seeder membuat akun berikut (hanya untuk pengembangan lokal):

| Role | Username | Password |
|---|---|---|
| **Admin Kampus** (`admin_kampus`) | `adminkampus` | `password123` |
| **Admin Ormawa** (`admin_ormawa`) | `himatif`, `bemu`, `dpmu`, ... (30 org) | `{username}unsera@26` |

> ⚠️ Ubah kredensial ini sebelum production.

---

## PDF & CSV Export

Endpoint: `GET /admin/laporan/export?periode={periode}&format={pdf|csv}`

- **PDF** — via `barryvdh/laravel-dompdf`, orientasi *landscape* A4, view `resources/views/export/laporan-pdf.blade.php`
- **CSV** — streamed response dengan **BOM** (`\xEF\xBB\xBF`) agar terbuka rapi di Excel, header + ringkasan statistik + data per ormawa
- Default `periode` = periode pertama dari daftar ormawa

---

## Desain Sistem

Sistem mengikuti design system yang didefinisikan di `design.md`:

- **Brand**: "Three-C (Cakra Control Center)"
- **Warna utama**: Blue `#2563EB`, dark navy `#0F172A`, slate surface `#F8FAFC`
- **Tipografi**: Inter (via fonts.bunny.net)
- **Spacing**: skala 8px (4 / 4.5 / 5 / 6 spacing tersedia)
- **Radius**: 12 / 16 / 24px (rounded-xl / 2xl / 3xl)
- **Shadow**: lembut, minimal
- Pola UI: kartu statistik dengan ikon+hover lift, badge status dengan dot warna, progress bar dinamis, timeline, empty state & loading state yang premium, toast notifikasi

**Status badge & warna:**

| Status Proker | Warna |
|---|---|
| Menunggu Validasi | Amber |
| Ditolak | Red (dengan alasan) |
| Berjalan | Blue |
| Selesai | Emerald |
| Belum Dimulai | Slate |

---

## Lisensi

Proyek ini bersifat internal kampus. Silakan sesuaikan dengan kebijakan institusi Anda.

---

*Dokumentasi disusun untuk memudahkan pengembangan, pemeliharaan, dan on-boarding tim.*