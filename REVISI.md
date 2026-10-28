# Revisi Three-C dari Rektor UNSERA
**Tanggal:** 28 Oktober 2026  
**Status:** In Progress

---

## A. Database & Model Changes

- [x] **A1. Tabel `fakultas`** - CRUD fakultas untuk dropdown (dengan seed FTI, FEB-SIP, FISIPKUM, FT, Universitas)
- [x] **A2. Tabel `kontak_admins`** - CRUD kontak admin untuk footer (email, WA, Instagram, dll)
- [x] **A3. Kolom `prokers.tahapan_saat_ini`** - enum 5 fase (perencanaan → persiapan → pelaksanaan → evaluasi → selesai)
- [x] **A4. Kolom `ormawas.fakultas_id`** - foreign key ke tabel fakultas (migrasi data lama)
- [x] **A5. Model Fakultas & KontakAdmin** - dengan relasi
- [x] **A6. Model Proker accessor** - `computed_progress` & `computed_status` dari tahapan

---

## B. Web Admin (Mendagri)

### B1. Halaman Program Kerja
- [ ] **B1.1** - Tampilkan deskripsi proker di card/list (sekarang hanya nama)
- [ ] **B1.2** - Modal/detail page untuk lihat proker lengkap saat approve/reject

### B2. Halaman Evaluasi
- [ ] **B2.1** - Rename "Evaluasi & Monev" → "Monitoring" di sidebar & header

### B3. Halaman Manajemen Ormawa/UKM
- [ ] **B3.1** - Dropdown fakultas (dari tabel `fakultas`)
- [ ] **B3.2** - Dropdown periode (2024-2025 s/d 2034-2035, hardcode)
- [ ] **B3.3** - Semua field required (nama, kategori, fakultas, periode)
- [ ] **B3.4** - Form UKM: fakultas auto-hide (set ke "Universitas"), periode opsional
- [ ] **B3.5** - Validasi deskripsi proker wajib diisi

### B4. CRUD Fakultas (New)
- [ ] **B4.1** - Halaman `/admin/fakultas` - list, tambah, edit, hapus fakultas
- [ ] **B4.2** - Route & menu sidebar

### B5. CRUD Kontak Admin (New)
- [ ] **B5.1** - Halaman `/admin/kontak` - list, tambah, edit, hapus kontak (email, WA, IG, dll)
- [ ] **B5.2** - Route & menu sidebar

### B6. Detail Proker
- [ ] **B6.1** - Tampilkan tahapan saat ini di detail proker
- [ ] **B6.2** - Progress bar auto dari tahapan (read-only, tidak bisa edit manual)

---

## C. Web Ormawa

### C1. Dashboard
- [ ] **C1.1** - Tampilkan badge status approval (Menunggu/Ditolak/Berjalan/Selesai) di card proker
- [ ] **C1.2** - Badge "Ditolak" untuk proker yang rejected (bukan "Belum Dimulai")
- [ ] **C1.3** - Progress bar auto dari tahapan

### C2. Pengumuman
- [ ] **C2.1** - Card pengumuman bisa diklik → modal popup untuk baca isi lengkap

### C3. Program Kerja
- [ ] **C3.1** - List proker langsung tampil penuh (tidak perlu klik "Lihat Semua")
- [ ] **C3.2** - Form tambah/edit proker: deskripsi wajib diisi (validation)
- [ ] **C3.3** - Tanggal proker hanya bisa pilih >= hari ini (date picker min=today)
- [ ] **C3.4** - Dropdown tahapan (5 fase) untuk update progress
- [ ] **C3.5** - Progress & status auto dari tahapan (read-only display)

### C4. Detail Proker
- [ ] **C4.1** - Tampilkan tahapan saat ini
- [ ] **C4.2** - Progress bar auto dari tahapan

---

## D. Global (Admin + Ormawa)

### D1. Footer
- [ ] **D1.1** - Footer global di semua halaman (copyright + kontak dari DB)
- [ ] **D1.2** - Layout: `© 2026 Three-C UNSERA | Email | WhatsApp`
- [ ] **D1.3** - View composer untuk inject `$kontaks` ke semua view

### D2. Konsistensi Bahasa
- [ ] **D2.1** - Audit & standardisasi: semua Indonesia (atau semua Inggris jika lebih cocok)
- [ ] **D2.2** - Perbaiki mixed "Program Kerja" vs "Proker", "Dashboard" vs "Beranda", dll

---

## Progress Summary
- **Total:** 36 tasks
- **Done:** 6 tasks (16.7%)
- **Remaining:** 30 tasks

**Last Updated:** 2026-10-28 13:37 WIB
