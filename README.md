# Perpus App - Aplikasi Perpustakaan

Aplikasi perpustakaan sederhana dibangun dengan Laravel 12 dan MySQL 8.

## Fitur

### Customer
- Login dan registrasi
- Melihat daftar buku (judul, penulis, status)
- Meminjam buku (jika tersedia)
- Mengembalikan buku yang dipinjam
- Melihat daftar buku yang sedang dipinjam

### Admin
- Login
- CRUD buku (Create, Read, Update, Delete)
- Melihat status semua buku
- Melihat siapa yang sedang meminjam buku
- Melihat riwayat peminjaman

## Instalasi

1. Clone repository atau extract project
2. Install dependencies:
```bash
composer install
```

3. Copy file `.env.example` menjadi `.env`:
```bash
cp .env.example .env
```

4. Generate application key:
```bash
php artisan key:generate
```

5. Konfigurasi database di file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=perpus_app
DB_USERNAME=root
DB_PASSWORD=
```

6. Jalankan migrasi dan seeder:
```bash
php artisan migrate --seed
```

7. Jalankan server development:
```bash
php artisan serve
```

8. Buka browser dan akses: `http://localhost:8000`

## Data Awal

Setelah menjalankan seeder, Anda dapat login dengan:

### Admin
- Email: `admin@perpus.app`
- Password: `password`

### Customer
- Email: `customer@perpus.app`
- Password: `password`

## Struktur Database

### Tabel `users`
- id
- name
- email
- password
- role (admin/customer)
- timestamps

### Tabel `books`
- id
- title
- author
- status (tersedia/dipinjam)
- timestamps

### Tabel `loans`
- id
- user_id
- book_id
- tanggal_pinjam
- tanggal_kembali (nullable)
- status (dipinjam/dikembalikan)
- timestamps

## Teknologi

- Laravel 12
- MySQL 8
- Bootstrap 5
- Blade Templates

## Route

### Public
- `GET /` - Redirect ke login
- `GET /login` - Halaman login
- `POST /login` - Proses login
- `GET /register` - Halaman registrasi
- `POST /register` - Proses registrasi

### Authenticated
- `POST /logout` - Logout
- `GET /dashboard` - Dashboard (redirect berdasarkan role)

### Admin Routes
- `GET /admin/dashboard` - Dashboard admin
- `GET /admin/books` - Daftar buku
- `GET /admin/books/create` - Form tambah buku
- `POST /admin/books` - Simpan buku baru
- `GET /admin/books/{book}` - Detail buku
- `GET /admin/books/{book}/edit` - Form edit buku
- `PUT /admin/books/{book}` - Update buku
- `DELETE /admin/books/{book}` - Hapus buku
- `GET /admin/books/status` - Status semua buku

### Customer Routes
- `GET /customer/dashboard` - Dashboard customer
- `POST /customer/books/{book}/borrow` - Pinjam buku
- `POST /customer/loans/{loan}/return` - Kembalikan buku
