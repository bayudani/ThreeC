# Design System & UI Guidelines

Desain mengacu pada referensi UI dashboard analitik modern (berdasarkan file `Dashboard - Three-C.png` dkk). Kesan yang ditimbulkan harus bersih, profesional, dan fokus pada data.

## 1. Color Palette (Tailwind CSS)

Gunakan kombinasi warna berikut untuk konsistensi:

* **Primary (Brand):** `indigo-600` (#4F46E5) untuk tombol utama, active state, dan progress bar.
* **Background Utama:** `gray-50` (#F9FAFB) untuk latar belakang halaman.
* **Sidebar Background:** `slate-50` / `blue-50` (Warna sangat terang, hampir putih dengan sedikit tint biru).
* **Surface / Cards:** `white` (#FFFFFF) dengan shadow lembut (`shadow-sm` atau `shadow-md`).
* **Text (Heading):** `gray-900` (#111827) font bold.
* **Text (Body/Muted):** `gray-500` (#6B7280).
* **Status Colors:**
  * **Completed / Success:** `emerald-500` (#10B981) - Untuk proker selesai.
  * **In Progress / Active:** `indigo-500` (#6366F1) - Untuk proker berjalan.
  * **Not Started / Delayed:** `gray-300` atau `red-500` (#EF4444) untuk warning keterlambatan.

## 2. Typography

* **Font Family:** Inter, Roboto, atau sistem sans-serif default Tailwind.
* **Hierarki:**
  * Page Title: `text-2xl font-bold text-gray-900`
  * Card Title: `text-lg font-semibold text-gray-800`
  * Metrik Angka (Dashboard): `text-4xl font-bold text-indigo-700`

## 3. UI Components (Berdasarkan Referensi)

* **Sidebar:** Fixed di sebelah kiri, icon minimalis, highlight background biru muda (`bg-indigo-100 text-indigo-700`) untuk menu yang sedang aktif.
* **Summary Cards (Atas):** Kotak putih, border tipis (`border-gray-100`), menampilkan Angka besar (Total Ormawa, Total Proker, Sedang Berjalan).
* **Progress Bar:** Menggunakan rounded-full.
  ```
  <!-- Contoh Progress Bar -->
  <div class="w-full bg-gray-200 rounded-full h-2.5">
    <div class="bg-indigo-600 h-2.5 rounded-full" style="width: 75%"></div>
  </div>
  ```
* **Tabel Data:** Clean design. Header abu-abu terang (`bg-gray-50`), teks kecil uppercase (`text-xs uppercase`), tanpa border vertikal, hanya border bawah horizontal tipis di tiap baris (`border-b border-gray-100`).

## 4. Layouting

* Layout utama menggunakan CSS Grid atau Flexbox: `<div class="flex h-screen bg-gray-50">`
* Konten diletakkan di dalam `<main class="flex-1 overflow-y-auto p-8">`
