# 📚 Perpus App - Aplikasi Perpustakaan Digital

Aplikasi perpustakaan modern berbasis web yang dibangun dengan Laravel 12 dan MySQL 8. Aplikasi ini memungkinkan admin untuk mengelola koleksi buku dan customer untuk meminjam serta mengembalikan buku secara digital.

## ✨ Fitur Utama

### 👤 Customer (Peminjam)
- ✅ **Autentikasi**: Login dan registrasi akun
- 📖 **Daftar Buku**: Melihat semua buku dengan informasi lengkap (judul, penulis, status)
- 🔖 **Peminjaman**: Meminjam buku yang tersedia dengan satu klik
- ↩️ **Pengembalian**: Mengembalikan buku yang sedang dipinjam
- 📋 **Riwayat**: Melihat daftar buku yang sedang dipinjam
- 📊 **Dashboard**: Statistik buku dan peminjaman personal

### 🛡️ Admin
- ✅ **Autentikasi**: Login dengan akses khusus admin
- 📚 **CRUD Buku**: 
  - Tambah buku baru
  - Edit informasi buku
  - Hapus buku
  - Lihat detail buku
- 📊 **Dashboard**: Statistik lengkap (total buku, tersedia, dipinjam)
- 📈 **Status Buku**: Melihat status semua buku dan siapa yang meminjam
- 📝 **Riwayat Peminjaman**: Melihat riwayat lengkap peminjaman semua buku
- 🚫 **Proteksi**: Admin tidak dapat meminjam buku

## 🚀 Instalasi

### Prasyarat
- PHP >= 8.2
- Composer
- MySQL 8.0 atau lebih tinggi
- Node.js & NPM (opsional, untuk asset compilation)

### Langkah Instalasi

1. **Clone atau download project**
```bash
git clone <repository-url>
cd perpus
```

2. **Install dependencies**
```bash
composer install
```

3. **Setup environment**
```bash
cp .env.example .env
php artisan key:generate
```

4. **Konfigurasi database**

Edit file `.env` dan sesuaikan konfigurasi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=perpus_app
DB_USERNAME=root
DB_PASSWORD=your_password
```

5. **Jalankan migrasi dan seeder**
```bash
php artisan migrate --seed
```

6. **Jalankan server development**
```bash
php artisan serve
```

7. **Akses aplikasi**
```
http://localhost:8000
```

## 🔐 Data Awal (Default Credentials)

Setelah menjalankan seeder, gunakan kredensial berikut:

### Admin
- **Email**: `admin@perpus.app`
- **Password**: `password`

### Customer
- **Email**: `customer@perpus.app`
- **Password**: `password`

> ⚠️ **Penting**: Ganti password default setelah instalasi pertama!

## 📊 Struktur Database

### Tabel `users`
| Kolom | Tipe | Deskripsi |
|-------|------|-----------|
| id | bigint | Primary key |
| name | string | Nama lengkap user |
| email | string | Email (unique) |
| password | string | Password (hashed) |
| role | enum | Role: `admin` atau `customer` |
| email_verified_at | timestamp | Waktu verifikasi email (nullable) |
| remember_token | string | Token remember me |
| timestamps | timestamps | created_at, updated_at |

### Tabel `books`
| Kolom | Tipe | Deskripsi |
|-------|------|-----------|
| id | bigint | Primary key |
| title | string | Judul buku |
| author | string | Nama penulis |
| status | enum | Status: `tersedia` atau `dipinjam` |
| timestamps | timestamps | created_at, updated_at |

### Tabel `loans`
| Kolom | Tipe | Deskripsi |
|-------|------|-----------|
| id | bigint | Primary key |
| user_id | bigint | Foreign key ke users |
| book_id | bigint | Foreign key ke books |
| tanggal_pinjam | datetime | Tanggal dan waktu pinjam |
| tanggal_kembali | datetime | Tanggal dan waktu kembali (nullable) |
| status | enum | Status: `dipinjam` atau `dikembalikan` |
| timestamps | timestamps | created_at, updated_at |

## 🔗 Relasi Eloquent

### User Model
```php
hasMany(Loan::class)  // User memiliki banyak peminjaman
```

### Book Model
```php
hasMany(Loan::class)  // Book memiliki banyak peminjaman
```

### Loan Model
```php
belongsTo(User::class)  // Loan milik User
belongsTo(Book::class)  // Loan milik Book
```

## 🛣️ Routes

### Public Routes
| Method | URI | Name | Description |
|--------|-----|------|-------------|
| GET | `/` | - | Redirect ke login |
| GET | `/login` | login | Halaman login |
| POST | `/login` | - | Proses login |
| GET | `/register` | register | Halaman registrasi |
| POST | `/register` | - | Proses registrasi |

### Authenticated Routes
| Method | URI | Name | Description |
|--------|-----|------|-------------|
| POST | `/logout` | logout | Logout user |
| GET | `/dashboard` | dashboard | Dashboard (redirect berdasarkan role) |

### Admin Routes
| Method | URI | Name | Description |
|--------|-----|------|-------------|
| GET | `/admin/dashboard` | admin.dashboard | Dashboard admin |
| GET | `/admin/books` | admin.books.index | Daftar semua buku |
| GET | `/admin/books/create` | admin.books.create | Form tambah buku |
| POST | `/admin/books` | admin.books.store | Simpan buku baru |
| GET | `/admin/books/{book}` | admin.books.show | Detail buku |
| GET | `/admin/books/{book}/edit` | admin.books.edit | Form edit buku |
| PUT | `/admin/books/{book}` | admin.books.update | Update buku |
| DELETE | `/admin/books/{book}` | admin.books.destroy | Hapus buku |
| GET | `/admin/books/status` | admin.books.status | Status semua buku |

### Customer Routes
| Method | URI | Name | Description |
|--------|-----|------|-------------|
| GET | `/customer/dashboard` | customer.dashboard | Dashboard customer |
| POST | `/customer/books/{book}/borrow` | customer.books.borrow | Pinjam buku |
| POST | `/customer/loans/{loan}/return` | customer.loans.return | Kembalikan buku |

## 🎨 Teknologi & Framework

- **Backend**: Laravel 12
- **Database**: MySQL 8
- **Frontend**: 
  - Bootstrap 5.3
  - Bootstrap Icons
  - Blade Templates
- **PHP**: >= 8.2
- **Authentication**: Custom (tanpa Breeze/Fortify)

## 📁 Struktur Project

```
perpus/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/
│   │   │   │   ├── LoginController.php
│   │   │   │   └── RegisterController.php
│   │   │   ├── BookController.php
│   │   │   ├── DashboardController.php
│   │   │   └── LoanController.php
│   │   └── Middleware/
│   │       ├── EnsureUserIsAdmin.php
│   │       └── EnsureUserIsCustomer.php
│   └── Models/
│       ├── Book.php
│       ├── Loan.php
│       └── User.php
├── database/
│   ├── migrations/
│   │   ├── 0001_01_01_000000_create_users_table.php
│   │   ├── 2025_12_01_032244_create_books_table.php
│   │   └── 2025_12_01_032251_create_loans_table.php
│   └── seeders/
│       ├── BookSeeder.php
│       ├── DatabaseSeeder.php
│       └── UserSeeder.php
├── resources/
│   └── views/
│       ├── layouts/
│       │   ├── app.blade.php
│       │   └── auth.blade.php
│       ├── admin/
│       │   ├── dashboard.blade.php
│       │   └── books/
│       │       ├── index.blade.php
│       │       ├── create.blade.php
│       │       ├── edit.blade.php
│       │       ├── show.blade.php
│       │       └── status.blade.php
│       ├── auth/
│       │   ├── login.blade.php
│       │   └── register.blade.php
│       └── customer/
│           └── dashboard.blade.php
└── routes/
    └── web.php
```

## 🎨 Fitur Desain

- ✨ **Modern UI**: Desain modern dengan gradient dan shadow effects
- 📱 **Responsive**: Fully responsive untuk semua device
- 🎯 **User Experience**: Navigasi yang intuitif dan mudah digunakan
- 🎨 **Color Scheme**: 
  - Primary: Purple gradient (#667eea - #764ba2)
  - Success: Green gradient
  - Warning: Orange gradient
- 🔤 **Icons**: Bootstrap Icons terintegrasi
- ⚡ **Animations**: Smooth hover effects dan transitions

## 🔒 Middleware & Security

### Middleware yang Digunakan
- `auth`: Memastikan user sudah login
- `admin`: Memastikan user adalah admin
- `customer`: Memastikan user adalah customer
- `guest`: Memastikan user belum login (untuk login/register)

### Proteksi
- Admin tidak dapat meminjam buku
- Customer hanya dapat melihat dan meminjam buku
- Setiap user hanya dapat mengembalikan buku yang mereka pinjam sendiri

## 📝 Seeder Data

Seeder akan membuat:
- **1 Admin**: admin@perpus.app
- **1 Customer**: customer@perpus.app
- **5 Buku Contoh**: 
  - Laravel: The Complete Guide
  - Clean Code
  - Design Patterns
  - The Pragmatic Programmer
  - Refactoring

## 🧪 Testing

```bash
php artisan test
```

## 📄 License

MIT License

## 👨‍💻 Development

### Menjalankan Development Server
```bash
php artisan serve
```

### Clear Cache
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
php artisan view:clear
```

### Menjalankan Migrasi Ulang
```bash
php artisan migrate:fresh --seed
```

## 🤝 Kontribusi

Kontribusi sangat diterima! Silakan buat issue atau pull request.

## 📞 Support

Jika ada pertanyaan atau masalah, silakan buat issue di repository ini.

---

**Dibuat dengan ❤️ menggunakan Laravel 12**
