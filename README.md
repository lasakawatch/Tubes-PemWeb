# 🐺 Tugas Besar Pemrograman Web - Kelompok Serigala Putih

![Laravel](https://img.shields.io/badge/Laravel-12.x-red?style=for-the-badge&logo=laravel)
![PHP](https://img.shields.io/badge/PHP-8.4-blue?style=for-the-badge&logo=php)
![TailwindCSS](https://img.shields.io/badge/Tailwind-3.x-38B2AC?style=for-the-badge&logo=tailwind-css)

---

## 📖 Tentang Proyek

Ini adalah proyek Tugas Besar Pemrograman Web yang dikerjakan oleh **Kelompok Serigala Putih**. Proyek ini menggunakan Laravel Framework dengan berbagai fitur modern untuk membangun aplikasi web yang lengkap.

---

## ✨ Fitur Utama

- 🔐 **Authentication & User Management** - Sistem login, register, dan manajemen user
- 🛒 **E-Commerce System** - Katalog produk, shopping cart, dan checkout
- 📊 **Dashboard & Analytics** - Visualisasi data dan laporan
- 📝 **Content Management System** - Manajemen artikel dan konten
- ⚙️ **Admin Panel** - Panel administrasi lengkap
- 📱 **Responsive Design** - Tampilan yang optimal di semua perangkat

---

## 🛠️ Teknologi yang Digunakan

- **Backend**: Laravel 12.x
- **Frontend**: Blade Templates, Tailwind CSS
- **Database**: MySQL/PostgreSQL (sesuai konfigurasi)
- **Icons**: Font Awesome
- **Version Control**: Git

---

## 📋 Prasyarat

Sebelum memulai, pastikan Anda telah menginstall:

- PHP >= 8.4
- Composer
- MySQL atau PostgreSQL
- Node.js & NPM (optional, untuk asset compilation)
- Git

---

## 🚀 Instalasi & Setup

### 1. Clone Repository

```bash
cd /home/fara/Documents
git clone [URL_REPOSITORY]
cd "Tugas Besar Pemrograman Web Kelompokk Serigala Putih"
```

### 2. Install Dependencies

```bash
composer install
```

### 3. Setup Environment

```bash
cp .env.example .env
php artisan key:generate
```

### 4. Konfigurasi Database

Edit file `.env` dan sesuaikan dengan konfigurasi database Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=username
DB_PASSWORD=password
```

### 5. Migrasi Database

```bash
php artisan migrate
```

### 6. (Optional) Seeding Data

```bash
php artisan db:seed
```

### 7. Jalankan Server

```bash
php artisan serve
```

Akses aplikasi di: **http://localhost:8000**

---

## 📁 Struktur Proyek

```
├── app/
│   ├── Http/
│   │   └── Controllers/     # Controllers
│   └── Models/              # Models
├── database/
│   ├── migrations/          # Database migrations
│   └── seeders/             # Database seeders
├── public/                  # Public assets
├── resources/
│   └── views/               # Blade templates
│       ├── layouts/         # Layout files
│       └── home.blade.php   # Homepage
├── routes/
│   └── web.php              # Web routes
├── PEMBAGIAN_TUGAS.md       # Dokumentasi pembagian tugas
└── README.md                # Dokumentasi ini
```

---

## 👥 Tim Pengembang

### Kelompok Serigala Putih

1. **Anggota 1** - Authentication & User Management
2. **Anggota 2** - E-Commerce & Product Management
3. **Anggota 3** - Dashboard & Analytics
4. **Anggota 4** - Content Management System
5. **Anggota 5** - Admin Panel & Settings

> 📝 Lihat detail pembagian tugas di [PEMBAGIAN_TUGAS.md](PEMBAGIAN_TUGAS.md)

---

## 🔄 Workflow Git

### Membuat Feature Branch

```bash
git checkout -b feature/nama-fitur
```

### Commit Changes

```bash
git add .
git commit -m "feat: deskripsi perubahan"
```

### Push ke Remote

```bash
git push origin feature/nama-fitur
```

### Merge ke Main
1. Buat Pull Request
2. Request review dari tim
3. Merge setelah approved

---

## 📝 Perintah Artisan yang Berguna

```bash
# Membuat Controller
php artisan make:controller NamaController

# Membuat Model dengan Migration
php artisan make:model NamaModel -m

# Menjalankan Migration
php artisan migrate

# Rollback Migration
php artisan migrate:rollback

# Clear Cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Membuat Seeder
php artisan make:seeder NamaSeeder

# Menjalankan Seeder
php artisan db:seed
```

---

## 🐛 Troubleshooting

### Error: "Class not found"
```bash
composer dump-autoload
```

### Error: Migration
```bash
php artisan migrate:fresh
```

### Error: Permission Denied (Storage)
```bash
chmod -R 775 storage bootstrap/cache
```

---

## 📚 Resources

- [Laravel Documentation](https://laravel.com/docs)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [PHP Documentation](https://www.php.net/docs.php)
- [Git Documentation](https://git-scm.com/doc)

---

## 📄 License

This project is created for educational purposes as part of Web Programming course assignment.

---

## 📞 Contact

Untuk pertanyaan atau bantuan, hubungi:
- **Repository**: [Link Repository]
- **Group Chat**: [Link Group Chat]

---

<p align="center">
  <strong>Made with ❤️ by Kelompok Serigala Putih 🐺</strong>
</p>


Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
