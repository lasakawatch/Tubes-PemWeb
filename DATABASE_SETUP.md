# 🗄️ DATABASE SETUP GUIDE

## 📋 Status Saat Ini

✅ **Homepage berjalan tanpa database**
- Session: File-based (tidak perlu database)
- Cache: File-based (tidak perlu database)
- Queue: Sync (tidak perlu database)

⚠️ **Database belum dikonfigurasi** - Ini normal untuk tahap awal!

---

## 🚀 Kapan Perlu Setup Database?

Database **HANYA** diperlukan ketika anggota tim mulai mengembangkan fitur yang membutuhkan database:

- 🔵 **Anggota 1**: Authentication (users table)
- 🟢 **Anggota 2**: Products, Orders (products, orders table)
- 🟡 **Anggota 3**: Dashboard (analytics table)
- 🔴 **Anggota 4**: Articles, Categories (articles table)
- 🟣 **Anggota 5**: Settings, Logs (settings table)

---

## 📝 Pilihan Database

### Opsi 1: MySQL/MariaDB (Recommended untuk Production)

#### Install MySQL (Kali Linux):
```bash
sudo apt update
sudo apt install mariadb-server mariadb-client
sudo systemctl start mariadb
sudo systemctl enable mariadb
```

#### Setup Database:
```bash
# Login ke MySQL
sudo mysql -u root

# Buat database
CREATE DATABASE laravel;

# Buat user (optional)
CREATE USER 'laravel_user'@'localhost' IDENTIFIED BY 'password';
GRANT ALL PRIVILEGES ON laravel.* TO 'laravel_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;
```

#### Update .env:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=database  # Bisa pakai database
CACHE_STORE=database     # Atau tetap file
```

#### Run Migration:
```bash
php artisan migrate
```

---

### Opsi 2: SQLite (Simple untuk Development)

#### Install SQLite Extension:
```bash
sudo apt install php8.4-sqlite3
```

#### Create Database File:
```bash
touch database/database.sqlite
```

#### Update .env:
```env
DB_CONNECTION=sqlite
# DB_HOST=127.0.0.1
# DB_PORT=3306
# DB_DATABASE=laravel
# DB_USERNAME=root
# DB_PASSWORD=

SESSION_DRIVER=database  # Bisa pakai database
```

#### Run Migration:
```bash
php artisan migrate
```

---

### Opsi 3: PostgreSQL (Advanced)

#### Install PostgreSQL:
```bash
sudo apt install postgresql postgresql-contrib php8.4-pgsql
sudo systemctl start postgresql
sudo systemctl enable postgresql
```

#### Setup Database:
```bash
sudo -u postgres psql

CREATE DATABASE laravel;
CREATE USER laravel_user WITH PASSWORD 'password';
GRANT ALL PRIVILEGES ON DATABASE laravel TO laravel_user;
\q
```

#### Update .env:
```env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=laravel
DB_USERNAME=laravel_user
DB_PASSWORD=password

SESSION_DRIVER=database
```

#### Run Migration:
```bash
php artisan migrate
```

---

## 🎯 Recommended Approach

### Untuk Development Awal (Sekarang):
✅ **Gunakan konfigurasi saat ini** (file-based session)
- Homepage sudah berjalan
- Tidak perlu database setup dulu
- Fokus ke UI/UX dulu

### Ketika Mulai Development Fitur:
📌 **Setup Database** (pilih salah satu opsi di atas)
- Pilih MySQL untuk production-like environment
- Atau SQLite untuk simplicity
- Run migrations
- Seed data jika perlu

---

## 🔧 Commands Penting

### Check Database Connection:
```bash
php artisan tinker
>>> DB::connection()->getPdo();
```

### Create Migration:
```bash
php artisan make:migration create_products_table
```

### Run Migration:
```bash
# Run all pending migrations
php artisan migrate

# Fresh migrate (drop all tables & recreate)
php artisan migrate:fresh

# Fresh migrate with seeder
php artisan migrate:fresh --seed
```

### Rollback Migration:
```bash
# Rollback last batch
php artisan migrate:rollback

# Rollback all migrations
php artisan migrate:reset
```

### Create Seeder:
```bash
php artisan make:seeder ProductSeeder
```

### Run Seeder:
```bash
# Run all seeders
php artisan db:seed

# Run specific seeder
php artisan db:seed --class=ProductSeeder
```

---

## 📊 Database Schema Planning

### Users Table (Anggota 1):
```php
Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('email')->unique();
    $table->timestamp('email_verified_at')->nullable();
    $table->string('password');
    $table->enum('role', ['admin', 'user'])->default('user');
    $table->rememberToken();
    $table->timestamps();
});
```

### Products Table (Anggota 2):
```php
Schema::create('products', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->text('description');
    $table->decimal('price', 10, 2);
    $table->integer('stock')->default(0);
    $table->string('image')->nullable();
    $table->foreignId('category_id')->constrained()->onDelete('cascade');
    $table->timestamps();
});
```

### Articles Table (Anggota 4):
```php
Schema::create('articles', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('slug')->unique();
    $table->text('content');
    $table->string('image')->nullable();
    $table->foreignId('category_id')->constrained()->onDelete('cascade');
    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->boolean('published')->default(false);
    $table->timestamps();
});
```

---

## ⚠️ Common Issues

### Issue 1: "could not find driver"
**Solution:** Install PHP database extension
```bash
# For MySQL
sudo apt install php8.4-mysql

# For SQLite
sudo apt install php8.4-sqlite3

# For PostgreSQL
sudo apt install php8.4-pgsql

# Restart server after install
```

### Issue 2: "Access denied for user"
**Solution:** Check MySQL credentials
```bash
# Test connection
mysql -u root -p

# Reset root password if needed
sudo mysql
ALTER USER 'root'@'localhost' IDENTIFIED BY 'newpassword';
FLUSH PRIVILEGES;
```

### Issue 3: "Connection refused"
**Solution:** Make sure database server is running
```bash
# For MySQL/MariaDB
sudo systemctl status mariadb
sudo systemctl start mariadb

# For PostgreSQL
sudo systemctl status postgresql
sudo systemctl start postgresql
```

### Issue 4: "Database does not exist"
**Solution:** Create database first
```bash
sudo mysql -u root
CREATE DATABASE laravel;
EXIT;
```

---

## 📝 Current Configuration (.env)

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

SESSION_DRIVER=file      # File-based, tidak perlu database
CACHE_STORE=file         # File-based, tidak perlu database
QUEUE_CONNECTION=sync    # Sync, tidak perlu database
```

**Status:** ✅ Homepage berjalan tanpa masalah

---

## 🎯 Next Steps

1. **Untuk sekarang**: Lanjutkan development UI/Frontend
2. **Ketika butuh database**: Pilih opsi database (MySQL/SQLite/PostgreSQL)
3. **Setup database**: Ikuti guide di atas sesuai pilihan
4. **Run migrations**: `php artisan migrate`
5. **Seed data**: `php artisan db:seed` (optional)
6. **Update .env**: Sesuaikan SESSION_DRIVER jika perlu

---

## 💡 Tips

1. **Development**: SQLite paling mudah, tidak perlu install server
2. **Production**: MySQL/PostgreSQL lebih reliable
3. **Team**: Pastikan semua anggota pakai database yang sama
4. **Backup**: Selalu backup database sebelum migration
5. **Seeder**: Buat seeder untuk dummy data saat testing

---

## 📞 Need Help?

Jika mengalami masalah database:
1. Check error message di terminal
2. Pastikan database server running
3. Verify credentials di .env
4. Test connection dengan `php artisan tinker`
5. Tanya di group chat jika masih error

---

**Status: ✅ HOMEPAGE BERJALAN NORMAL**  
**Database: ⏳ SETUP NANTI SAAT BUTUH**

---

**Updated:** 2025-10-17  
**Laravel Version:** 12.x
