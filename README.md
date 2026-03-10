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
- **Postman / Thunder Client** – pengujian endpoint API
