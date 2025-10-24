# 📋 DOKUMENTASI PEMBAGIAN TUGAS
## Tugas Besar Pemrograman Web - Kelompok Serigala Putih

---

## 📌 Struktur Proyek

Proyek ini menggunakan **Laravel Framework** dengan struktur yang sudah disiapkan untuk memudahkan kolaborasi tim.

### Direktori Penting:
- `app/Http/Controllers/` - Controller untuk logika bisnis
- `app/Models/` - Model untuk database
- `resources/views/` - File Blade untuk tampilan
- `routes/web.php` - Routing aplikasi
- `database/migrations/` - File migrasi database
- `public/` - Asset publik (CSS, JS, images)

---

## 👥 PEMBAGIAN TUGAS ANGGOTA

### 🔵 Anggota 1: Authentication & User Management
**Tanggung Jawab:**
- [ ] Sistem Login & Register
- [ ] Logout functionality
- [ ] Password Reset/Forgot Password
- [ ] User Profile Management
- [ ] Role-based Access Control (Admin, User, dll)

**File yang Perlu Dibuat:**
```
app/Http/Controllers/AuthController.php
app/Http/Controllers/ProfileController.php
resources/views/auth/login.blade.php
resources/views/auth/register.blade.php
resources/views/auth/forgot-password.blade.php
resources/views/profile/index.blade.php
database/migrations/xxxx_create_users_table.php (sudah ada, tinggal modifikasi)
```

**Routes:**
```php
Route::prefix('auth')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
});
```

---

### 🟢 Anggota 2: E-Commerce / Product Management
**Tanggung Jawab:**
- [ ] Katalog Produk (List & Detail)
- [ ] Shopping Cart
- [ ] Checkout Process
- [ ] Order Management
- [ ] Payment Integration (simulasi atau real)

**File yang Perlu Dibuat:**
```
app/Http/Controllers/ProductController.php
app/Http/Controllers/CartController.php
app/Http/Controllers/OrderController.php
app/Models/Product.php
app/Models/Cart.php
app/Models/Order.php
resources/views/products/index.blade.php
resources/views/products/show.blade.php
resources/views/cart/index.blade.php
resources/views/checkout/index.blade.php
database/migrations/xxxx_create_products_table.php
database/migrations/xxxx_create_carts_table.php
database/migrations/xxxx_create_orders_table.php
```

**Routes:**
```php
Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('products.index');
    Route::get('/{id}', [ProductController::class, 'show'])->name('products.show');
});

Route::middleware('auth')->group(function () {
    Route::prefix('cart')->group(function () {
        Route::get('/', [CartController::class, 'index'])->name('cart.index');
        Route::post('/add', [CartController::class, 'add'])->name('cart.add');
        Route::delete('/{id}', [CartController::class, 'remove'])->name('cart.remove');
    });
});
```

---

### 🟡 Anggota 3: Dashboard & Analytics
**Tanggung Jawab:**
- [ ] Admin Dashboard
- [ ] Sales Statistics
- [ ] User Statistics
- [ ] Charts & Graphs (gunakan Chart.js atau library lain)
- [ ] Report Generation

**File yang Perlu Dibuat:**
```
app/Http/Controllers/DashboardController.php
app/Http/Controllers/ReportController.php
resources/views/dashboard/index.blade.php
resources/views/reports/sales.blade.php
resources/views/reports/users.blade.php
```

**Routes:**
```php
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::prefix('reports')->group(function () {
        Route::get('/sales', [ReportController::class, 'sales'])->name('reports.sales');
        Route::get('/users', [ReportController::class, 'users'])->name('reports.users');
    });
});
```

---

### 🔴 Anggota 4: Content Management System (CMS)
**Tanggung Jawab:**
- [ ] Blog/Article Management (CRUD)
- [ ] Category Management
- [ ] Media/Image Upload
- [ ] Rich Text Editor Integration
- [ ] Comments System (optional)

**File yang Perlu Dibuat:**
```
app/Http/Controllers/ArticleController.php
app/Http/Controllers/CategoryController.php
app/Models/Article.php
app/Models/Category.php
resources/views/articles/index.blade.php
resources/views/articles/show.blade.php
resources/views/articles/create.blade.php
resources/views/articles/edit.blade.php
database/migrations/xxxx_create_articles_table.php
database/migrations/xxxx_create_categories_table.php
```

**Routes:**
```php
Route::prefix('blog')->group(function () {
    Route::get('/', [ArticleController::class, 'index'])->name('blog.index');
    Route::get('/{slug}', [ArticleController::class, 'show'])->name('blog.show');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('articles', ArticleController::class);
    Route::resource('categories', CategoryController::class);
});
```

---

### 🟣 Anggota 5: Admin Panel & Settings
**Tanggung Jawab:**
- [ ] Site Settings Management
- [ ] User Management (Admin side)
- [ ] Role & Permission Management
- [ ] Activity Logs
- [ ] Email Templates Management

**File yang Perlu Dibuat:**
```
app/Http/Controllers/Admin/SettingsController.php
app/Http/Controllers/Admin/UserManagementController.php
app/Models/Setting.php
app/Models/ActivityLog.php
resources/views/admin/settings/index.blade.php
resources/views/admin/users/index.blade.php
resources/views/admin/users/edit.blade.php
database/migrations/xxxx_create_settings_table.php
database/migrations/xxxx_create_activity_logs_table.php
```

**Routes:**
```php
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/settings', [SettingsController::class, 'index'])->name('admin.settings');
    Route::put('/settings', [SettingsController::class, 'update'])->name('admin.settings.update');
    Route::resource('users', UserManagementController::class);
});
```

---

## 🛠️ TUGAS BERSAMA (Semua Anggota)

### Tanggung Jawab Bersama:
- [ ] **Responsive Design** - Pastikan semua halaman responsive
- [ ] **UI/UX Consistency** - Gunakan layout dan komponen yang konsisten
- [ ] **Code Documentation** - Tambahkan komentar pada code
- [ ] **Testing** - Test fitur masing-masing
- [ ] **Git Collaboration** - Commit dengan pesan yang jelas

---

## 📝 CARA KERJA

### 1. Setup Awal (Sudah Selesai ✅)
- [x] Laravel Installation
- [x] Homepage Layout
- [x] Basic Routing Structure

### 2. Langkah Kerja Individu:

#### A. Clone atau Pull Repository
```bash
cd "/home/fara/Documents/Tugas Besar Pemrograman Web Kelompokk Serigala Putih"
git pull origin main
```

#### B. Buat Branch Baru
```bash
git checkout -b feature/nama-fitur-anda
# Contoh: 
# git checkout -b feature/authentication
# git checkout -b feature/products
```

#### C. Kerjakan Fitur Anda
- Buat Controller: `php artisan make:controller NamaController`
- Buat Model: `php artisan make:model NamaModel -m` (dengan migration)
- Buat View di folder `resources/views/`
- Tambahkan Routes di `routes/web.php`

#### D. Testing Lokal
```bash
# Jalankan server lokal
php artisan serve

# Jalankan migration (jika ada perubahan database)
php artisan migrate

# Clear cache jika perlu
php artisan cache:clear
php artisan config:clear
php artisan view:clear
```

#### E. Commit & Push
```bash
git add .
git commit -m "feat: menambahkan fitur authentication"
git push origin feature/nama-fitur-anda
```

#### F. Create Pull Request
- Buat Pull Request di GitHub/GitLab
- Minta review dari anggota lain
- Merge setelah approved

---

## 🗃️ DATABASE SCHEMA (Referensi)

### Users Table (Sudah ada di Laravel)
```
- id
- name
- email
- password
- role (admin/user)
- created_at
- updated_at
```

### Products Table (Contoh)
```
- id
- name
- description
- price
- stock
- image
- category_id
- created_at
- updated_at
```

### Orders Table (Contoh)
```
- id
- user_id
- total_price
- status (pending/paid/shipped/completed)
- created_at
- updated_at
```

---

## 📚 RESOURCES & LEARNING

### Laravel Documentation
- Official Docs: https://laravel.com/docs
- Laravel Bootcamp: https://bootcamp.laravel.com

### Frontend Framework
- Tailwind CSS: https://tailwindcss.com/docs (sudah terinstall via CDN)
- Font Awesome Icons: https://fontawesome.com/icons

### Git Best Practices
- Commit Messages: https://www.conventionalcommits.org/
- Branch Naming: `feature/`, `bugfix/`, `hotfix/`

---

## ⚠️ CATATAN PENTING

1. **Jangan langsung push ke main branch**
2. **Selalu pull sebelum mulai coding**
3. **Komunikasi di grup jika ada perubahan besar**
4. **Gunakan layout yang sudah disediakan (`layouts/app.blade.php`)**
5. **Follow coding standards Laravel**
6. **Backup database sebelum migration baru**

---

## 🚀 QUICK START COMMANDS

```bash
# Membuat Controller
php artisan make:controller NamaController

# Membuat Model dengan Migration
php artisan make:model NamaModel -m

# Membuat Migration
php artisan make:migration create_nama_table

# Menjalankan Migration
php artisan migrate

# Rollback Migration
php artisan migrate:rollback

# Membuat Seeder
php artisan make:seeder NamaSeeder

# Menjalankan Seeder
php artisan db:seed

# Clear Cache
php artisan cache:clear
php artisan config:clear
php artisan view:clear

# Menjalankan Server
php artisan serve
```

---

## 📞 CONTACT

Jika ada pertanyaan atau kesulitan, hubungi:
- **Ketua Kelompok**: [Nama & Kontak]
- **Group Chat**: [Link Group]
- **Repository**: [Git Repository Link]

---

**Good Luck & Happy Coding! 🚀**

**Kelompok Serigala Putih** 🐺
