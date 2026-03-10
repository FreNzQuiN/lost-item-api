# Sistem Pelaporan Barang Hilang FILKOM UB (Lost Item Reporting API)

## 1. Deskripsi Studi Kasus

Di lingkungan Fakultas Ilmu Komputer Universitas Brawijaya (FILKOM UB), pelaporan barang hilang di ruang kelas atau area kampus masih dilakukan secara manual, misalnya dengan bertanya kepada petugas atau menyebarkan informasi secara informal. Hal ini sering menyebabkan informasi tidak tersampaikan dengan baik dan proses pencarian barang menjadi tidak efisien. Oleh karena itu, dibuat sebuah sistem berbasis API yang memungkinkan pengguna melaporkan barang hilang secara terstruktur sehingga data dapat tersimpan dan dikelola secara sistematis.

Sistem ini menyediakan layanan **REST API** untuk mengelola data barang hilang menggunakan operasi **CRUD (Create, Read, Update, Delete)**. Melalui API ini, pengguna dapat menambahkan laporan barang hilang, melihat daftar barang yang dilaporkan, memperbarui informasi laporan, serta menghapus laporan yang tidak diperlukan.

---

## 2. Tujuan Sistem

Tujuan dari sistem ini adalah:

- Menyediakan sistem pelaporan barang hilang secara digital.
- Menyimpan data laporan barang secara terstruktur dalam database.
- Mempermudah pengguna untuk mencari dan mengelola informasi barang hilang.
- Mengimplementasikan konsep **REST API CRUD menggunakan Laravel**.

---

## 3. Struktur Data

Data utama yang digunakan dalam sistem ini adalah **Lost Item** dengan atribut sebagai berikut:

| Field         | Tipe Data          | Deskripsi               |
| ------------- | ------------------ | ----------------------- |
| id            | integer            | ID unik barang          |
| item_name     | string             | Nama barang yang hilang |
| description   | text               | Deskripsi barang        |
| location_lost | string             | Lokasi barang hilang    |
| date_lost     | date               | Tanggal barang hilang   |
| reporter_name | string             | Nama pelapor            |
| contact       | string             | Kontak pelapor          |
| status        | enum (lost, found) | Status barang           |
| created_at    | timestamp          | Waktu data dibuat       |
| updated_at    | timestamp          | Waktu data diperbarui   |

---

## 4. Daftar Endpoint API

Sistem ini menyediakan beberapa endpoint API yang digunakan untuk mengelola data barang hilang.

| Method      | Endpoint             | Deskripsi                                |
| ----------- | -------------------- | ---------------------------------------- |
| GET         | /api/lost-items      | Menampilkan seluruh data barang hilang   |
| GET         | /api/lost-items/{id} | Menampilkan detail barang berdasarkan ID |
| POST        | /api/lost-items      | Menambahkan laporan barang hilang        |
| PUT / PATCH | /api/lost-items/{id} | Memperbarui data laporan barang          |
| DELETE      | /api/lost-items/{id} | Menghapus laporan barang                 |

---

## 5. Implementasi Sistem

Sistem ini dikembangkan menggunakan framework **Laravel** dengan pendekatan **REST API**. Endpoint API didefinisikan pada file `routes/api.php`, sedangkan logika pengolahan data berada pada `LostItemController`. Setiap endpoint memanggil fungsi tertentu pada controller untuk menjalankan operasi CRUD terhadap database.

Struktur fungsi yang digunakan pada controller adalah sebagai berikut:

- `index()` → mengambil seluruh data barang hilang
- `show($id)` → mengambil data barang berdasarkan ID
- `store(Request $request)` → menambahkan data laporan baru
- `update(Request $request, $id)` → memperbarui data laporan
- `destroy($id)` → menghapus data laporan

Database dikelola menggunakan fitur **Laravel Migration** sehingga struktur tabel dapat dibuat dan dikelola secara terkontrol.

---

## 6. Teknologi yang Digunakan

Beberapa teknologi yang digunakan dalam pengembangan sistem ini adalah:

- **Laravel Framework** – backend API development
- **PHP** – bahasa pemrograman utama
- **MySQL** – sistem manajemen basis data
- **Git & GitHub** – version control dan kolaborasi tim

---

## 7. Manual Penggunaan Singkat

### 7.1 Setup Proyek

1. Install dependency:

```bash
composer install
```

2. Buat file environment:

```bash
copy .env.example .env
# atau (PowerShell)
Copy-Item .env.example .env
```

3. Atur database di file `.env` (contoh: `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

4. Generate app key:

```bash
php artisan key:generate
```

### 7.2 Siapkan Database

Jalankan migrasi + seed data contoh:

```bash
php artisan migrate --seed
```

### 7.3 Jalankan Aplikasi

```bash
php artisan serve
```

Base URL API:

```text
http://127.0.0.1:8000/api
```

### 7.4 Endpoint Utama

| Method    | Endpoint           | Fungsi                     |
| --------- | ------------------ | -------------------------- |
| GET       | `/lost-items`      | Menampilkan semua laporan  |
| GET       | `/lost-items/{id}` | Menampilkan detail laporan |
| POST      | `/lost-items`      | Menambah laporan baru      |
| PUT/PATCH | `/lost-items/{id}` | Memperbarui laporan        |
| DELETE    | `/lost-items/{id}` | Menghapus laporan          |

### 7.5 Contoh Request (Copy-Paste)

Create data:

```bash
curl -X POST http://127.0.0.1:8000/api/lost-items \
  -H "Content-Type: application/json" \
  -d '{
    "item_name": "Kunci Motor",
    "description": "Gantungan merah",
    "location_lost": "Parkiran FILKOM",
    "date_lost": "2026-03-10",
    "reporter_name": "Nadia",
    "contact": "089876543210"
  }'
```

Get semua data:

```bash
curl http://127.0.0.1:8000/api/lost-items
```

Update status:

```bash
curl -X PATCH http://127.0.0.1:8000/api/lost-items/1 \
  -H "Content-Type: application/json" \
  -d '{"status":"found"}'
```

Delete data:

```bash
curl -X DELETE http://127.0.0.1:8000/api/lost-items/1
```

### 7.6 Verifikasi Cepat

```bash
php artisan route:list
php artisan test
```

### 7.7 Coba Tanpa Terminal (Postman/Thunder Client)

1. Buat request `POST` ke `http://127.0.0.1:8000/api/lost-items`.
2. Pilih `Body -> raw -> JSON`, lalu isi:

```json
{
    "item_name": "Kartu KTM",
    "description": "Kartu mahasiswa FILKOM",
    "location_lost": "Gedung G",
    "date_lost": "2026-03-10",
    "reporter_name": "Budi",
    "contact": "081200000000"
}
```

3. Kirim request `GET` ke `http://127.0.0.1:8000/api/lost-items` untuk memastikan data masuk.
