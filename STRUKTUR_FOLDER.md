# 📝 TEMPLATE STRUKTUR FOLDER UNTUK SETIAP ANGGOTA

Ini adalah template struktur folder yang disarankan untuk setiap fitur yang dikerjakan oleh masing-masing anggota.

---

## 🔵 ANGGOTA 1: Authentication & User Management

```
app/
├── Http/
│   ├── Controllers/
│   │   ├── AuthController.php
│   │   ├── ProfileController.php
│   │   └── Auth/
│   │       ├── LoginController.php
│   │       ├── RegisterController.php
│   │       └── ForgotPasswordController.php
│   └── Middleware/
│       └── RoleMiddleware.php
├── Models/
│   └── User.php (sudah ada, modifikasi jika perlu)
│
resources/
└── views/
    ├── auth/
    │   ├── login.blade.php
    │   ├── register.blade.php
    │   ├── forgot-password.blade.php
    │   └── reset-password.blade.php
    └── profile/
        ├── index.blade.php
        └── edit.blade.php
│
database/
├── migrations/
│   └── xxxx_add_role_to_users_table.php
└── seeders/
    └── UserSeeder.php
```

---

## 🟢 ANGGOTA 2: E-Commerce / Product Management

```
app/
├── Http/
│   └── Controllers/
│       ├── ProductController.php
│       ├── CartController.php
│       ├── OrderController.php
│       └── CheckoutController.php
├── Models/
│   ├── Product.php
│   ├── Cart.php
│   ├── CartItem.php
│   ├── Order.php
│   └── OrderItem.php
│
resources/
└── views/
    ├── products/
    │   ├── index.blade.php
    │   ├── show.blade.php
    │   ├── search.blade.php
    │   └── category.blade.php
    ├── cart/
    │   └── index.blade.php
    └── checkout/
        ├── index.blade.php
        ├── payment.blade.php
        └── success.blade.php
│
database/
├── migrations/
│   ├── xxxx_create_products_table.php
│   ├── xxxx_create_carts_table.php
│   ├── xxxx_create_cart_items_table.php
│   ├── xxxx_create_orders_table.php
│   └── xxxx_create_order_items_table.php
└── seeders/
    └── ProductSeeder.php
```

---

## 🟡 ANGGOTA 3: Dashboard & Analytics

```
app/
├── Http/
│   └── Controllers/
│       ├── DashboardController.php
│       ├── ReportController.php
│       └── Admin/
│           ├── SalesReportController.php
│           └── UserReportController.php
├── Models/
│   ├── Report.php
│   └── Analytics.php
│
resources/
└── views/
    ├── dashboard/
    │   ├── index.blade.php
    │   ├── sales.blade.php
    │   └── users.blade.php
    └── reports/
        ├── sales.blade.php
        ├── users.blade.php
        ├── products.blade.php
        └── export.blade.php
│
database/
├── migrations/
│   └── xxxx_create_analytics_table.php
└── seeders/
    └── AnalyticsSeeder.php
```

---

## 🔴 ANGGOTA 4: Content Management System

```
app/
├── Http/
│   └── Controllers/
│       ├── ArticleController.php
│       ├── CategoryController.php
│       ├── BlogController.php
│       └── MediaController.php
├── Models/
│   ├── Article.php
│   ├── Category.php
│   ├── Media.php
│   └── Comment.php
│
resources/
└── views/
    ├── blog/
    │   ├── index.blade.php
    │   ├── show.blade.php
    │   └── category.blade.php
    └── articles/
        ├── index.blade.php
        ├── show.blade.php
        ├── create.blade.php
        └── edit.blade.php
│
database/
├── migrations/
│   ├── xxxx_create_articles_table.php
│   ├── xxxx_create_categories_table.php
│   ├── xxxx_create_media_table.php
│   └── xxxx_create_comments_table.php
└── seeders/
    ├── ArticleSeeder.php
    └── CategorySeeder.php
```

---

## 🟣 ANGGOTA 5: Admin Panel & Settings

```
app/
├── Http/
│   └── Controllers/
│       └── Admin/
│           ├── SettingsController.php
│           ├── UserManagementController.php
│           ├── RoleController.php
│           └── ActivityLogController.php
├── Models/
│   ├── Setting.php
│   ├── Role.php
│   ├── Permission.php
│   └── ActivityLog.php
│
resources/
└── views/
    └── admin/
        ├── index.blade.php
        ├── settings/
        │   ├── index.blade.php
        │   ├── general.blade.php
        │   └── email.blade.php
        ├── users/
        │   ├── index.blade.php
        │   ├── create.blade.php
        │   └── edit.blade.php
        └── logs/
            └── index.blade.php
│
database/
├── migrations/
│   ├── xxxx_create_settings_table.php
│   ├── xxxx_create_roles_table.php
│   ├── xxxx_create_permissions_table.php
│   └── xxxx_create_activity_logs_table.php
└── seeders/
    ├── SettingSeeder.php
    └── RoleSeeder.php
```

---

## 📂 Struktur Folder Umum (Shared)

```
resources/
├── views/
│   ├── layouts/
│   │   ├── app.blade.php (sudah dibuat)
│   │   ├── admin.blade.php (untuk admin panel)
│   │   └── guest.blade.php (untuk halaman tanpa auth)
│   ├── components/
│   │   ├── navbar.blade.php
│   │   ├── footer.blade.php
│   │   ├── sidebar.blade.php
│   │   └── alert.blade.php
│   └── partials/
│       ├── header.blade.php
│       └── breadcrumb.blade.php
│
public/
├── css/
│   └── custom.css
├── js/
│   └── app.js
└── images/
    ├── logo.png
    └── uploads/
```

---

## 🎯 TIPS PENGERJAAN

### 1. Naming Convention
- **Controllers**: PascalCase (e.g., `ProductController.php`)
- **Models**: PascalCase Singular (e.g., `Product.php`)
- **Views**: kebab-case (e.g., `product-list.blade.php`)
- **Routes**: kebab-case (e.g., `/products/show-detail`)

### 2. Membuat File dengan Artisan
```bash
# Controller
php artisan make:controller ProductController --resource

# Model dengan Migration
php artisan make:model Product -m

# Model dengan Migration dan Factory
php artisan make:model Product -mf

# Migration saja
php artisan make:migration create_products_table

# Seeder
php artisan make:seeder ProductSeeder
```

### 3. Best Practices
- ✅ Gunakan Resource Controller untuk CRUD operations
- ✅ Pisahkan logic bisnis ke Service classes jika kompleks
- ✅ Gunakan Form Request untuk validasi
- ✅ Gunakan Eloquent Relationships
- ✅ Tambahkan comments pada code yang kompleks

### 4. Testing
- Test setiap fitur sebelum push
- Test di berbagai ukuran layar (responsive)
- Test dengan data dummy yang cukup
- Test error handling

---

## 📋 CHECKLIST SEBELUM COMMIT

- [ ] Code berjalan tanpa error
- [ ] Migration berhasil dijalankan
- [ ] Views responsive di mobile & desktop
- [ ] Tidak ada console error di browser
- [ ] Routes terdaftar dengan benar
- [ ] Code sudah di-comment
- [ ] Mengikuti naming convention
- [ ] Sudah di-test dengan data dummy

---

## 🚨 COMMON ISSUES & SOLUTIONS

### Issue 1: Class not found
```bash
composer dump-autoload
```

### Issue 2: Route not found
```bash
php artisan route:clear
php artisan cache:clear
```

### Issue 3: View not found
```bash
php artisan view:clear
```

### Issue 4: Migration error
```bash
php artisan migrate:fresh
# Hati-hati: ini akan menghapus semua data!
```

---

**Happy Coding! 🚀**
