# 🚀 SETUP GUIDE - QUICK START

Panduan cepat untuk anggota baru yang ingin setup development environment.

---

## ⚡ 5 MENIT QUICK START

### 1️⃣ Clone Repository
```bash
cd ~/Documents
git clone [REPOSITORY_URL]
cd "Tugas Besar Pemrograman Web Kelompokk Serigala Putih"
```

### 2️⃣ Install Dependencies
```bash
composer install
```

### 3️⃣ Setup Environment
```bash
cp .env.example .env
php artisan key:generate
```

### 4️⃣ Database Setup
```bash
# Pastikan MySQL/MariaDB running
sudo systemctl start mariadb

# Jalankan migration
php artisan migrate
```

### 5️⃣ Run Server
```bash
php artisan serve --host=127.0.0.1 --port=8001
```

✅ **Done!** Buka http://127.0.0.1:8001 di browser

---

## 📋 DETAILED SETUP

### Prerequisites (Install jika belum ada)

**Linux/Kali:**
```bash
# Update package manager
sudo apt update && sudo apt upgrade -y

# Install PHP 8.4 (jika belum)
sudo apt install php8.4-cli php8.4-mysql php8.4-mbstring php8.4-xml php8.4-curl

# Install Composer
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer

# Install MariaDB (MySQL)
sudo apt install mariadb-server mariadb-client

# Start MariaDB
sudo systemctl start mariadb
sudo systemctl enable mariadb
```

**macOS:**
```bash
# Install Homebrew (jika belum)
/bin/bash -c "$(curl -fsSL https://raw.githubusercontent.com/Homebrew/install/HEAD/install.sh)"

# Install dependencies
brew install php composer mysql

# Start MySQL
brew services start mysql
```

**Windows:**
```
1. Install XAMPP atau LARAVEL HERD
2. Follow installer steps
3. Start MySQL/Apache dari control panel
```

---

### Step-by-Step Setup

#### Step 1: Clone Repository
```bash
git clone [REPOSITORY_URL]
cd "Tugas Besar Pemrograman Web Kelompokk Serigala Putih"
```

#### Step 2: Install Composer Dependencies
```bash
# Install semua dependencies dari composer.json
composer install

# Tunggu sampai selesai (bisa 2-5 menit tergantung internet)
```

#### Step 3: Copy Environment File
```bash
# Copy template .env
cp .env.example .env

# Generate application key
php artisan key:generate
```

#### Step 4: Database Setup

**Create Database:**
```bash
# Login ke MySQL
sudo mysql -u root

# Buat database
mysql> CREATE DATABASE laravel;
mysql> EXIT;

# Atau satu baris:
sudo mysql -e "CREATE DATABASE laravel;"
```

**Run Migrations:**
```bash
php artisan migrate
```

**Verify Database:**
```bash
sudo mysql laravel -e "SHOW TABLES;"
```

Expected output:
```
+-----------------------+
| Tables_in_laravel     |
+-----------------------+
| cache                 |
| cache_locks           |
| failed_jobs           |
| job_batches           |
| jobs                  |
| migrations            |
| password_reset_tokens |
| sessions              |
| users                 |
+-----------------------+
```

#### Step 5: Run Development Server
```bash
php artisan serve --host=127.0.0.1 --port=8001

# Output akan terlihat seperti:
# INFO  Server running on [http://127.0.0.1:8001].
# Press Ctrl+C to stop the server
```

#### Step 6: Test Homepage
Buka browser dan akses: **http://127.0.0.1:8001**

✅ Homepage harus tampil dengan sempurna!

---

## 🔧 CONFIGURATION

### .env File Explanation

```env
# App Configuration
APP_NAME=Laravel                 # Nama aplikasi
APP_ENV=local                   # Environment (local, production)
APP_DEBUG=true                  # Debug mode (false di production)
APP_URL=http://localhost        # URL aplikasi

# Database Configuration
DB_CONNECTION=mysql             # Database type (mysql, sqlite, pgsql)
DB_HOST=127.0.0.1              # Database host
DB_PORT=3306                    # Database port
DB_DATABASE=laravel             # Database name
DB_USERNAME=root                # Database user
DB_PASSWORD=                    # Database password (kosong = no password)

# Session & Cache
SESSION_DRIVER=file             # Session storage (file, database)
CACHE_STORE=file               # Cache storage (file, database, redis)
```

### Port Configuration

Default port: **8001**

Jika port sudah dipakai:
```bash
# Use port 8002
php artisan serve --port=8002

# Use port 3000
php artisan serve --port=3000
```

---

## ✅ VERIFICATION CHECKLIST

Setelah setup, verify bahwa semuanya OK:

- [ ] `composer install` berjalan tanpa error
- [ ] `php artisan key:generate` berjalan
- [ ] Database `laravel` sudah dibuat
- [ ] `php artisan migrate` berjalan tanpa error
- [ ] `php artisan serve` berjalan
- [ ] Homepage accessible di http://127.0.0.1:8001
- [ ] Tidak ada error di browser console

---

## 🐛 TROUBLESHOOTING

### Issue 1: "Composer command not found"
```bash
# Install composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer
```

### Issue 2: "Database connection refused"
```bash
# Check if MySQL is running
sudo systemctl status mariadb

# Start MySQL if not running
sudo systemctl start mariadb
```

### Issue 3: "Access denied for user 'root'@'localhost'"
```bash
# Reset MySQL root password
sudo mysql -e "ALTER USER 'root'@'localhost' IDENTIFIED BY '';"
```

### Issue 4: "SQLSTATE[HY000] [2002] No such file or directory"
```bash
# Check MySQL socket
sudo mysql -u root

# Verify in .env that DB_HOST is correct (127.0.0.1 or localhost)
```

### Issue 5: "Port 8001 already in use"
```bash
# Use different port
php artisan serve --port=8002

# Or kill process using port 8001
sudo lsof -ti:8001 | xargs kill -9
```

### Issue 6: "No such file or directory" (after composer install)
```bash
# Clear autoloader
composer dump-autoload
composer install
```

### Issue 7: "File not found" after git clone
```bash
# Make sure you're in the right directory
pwd  # Should show the project directory

# List files
ls -la  # Should show app/, routes/, etc.
```

---

## 📝 NEXT STEPS

### Setelah Setup Berhasil:

1. **Baca Dokumentasi**
   ```bash
   # Mulai dari INDEX.md
   cat INDEX.md
   ```

2. **Cek Tugasmu**
   ```bash
   # Baca PEMBAGIAN_TUGAS.md
   cat PEMBAGIAN_TUGAS.md
   ```

3. **Setup Git Branch**
   ```bash
   git checkout -b feature/your-feature-name
   ```

4. **Mulai Coding! 💪**

---

## 📚 USEFUL COMMANDS

### Development
```bash
# Start server
php artisan serve --host=127.0.0.1 --port=8001

# Clear cache
php artisan optimize:clear

# Check database connection
php artisan tinker
>>> DB::connection()->getPdo()

# Run migrations
php artisan migrate

# Rollback migrations
php artisan migrate:rollback
```

### Git
```bash
# Check status
git status

# Create new branch
git checkout -b feature/name

# Push to remote
git push origin feature/name

# Pull latest
git pull origin main
```

### Composer
```bash
# Install dependencies
composer install

# Update dependencies
composer update

# Dump autoloader
composer dump-autoload
```

---

## 🆘 NEED HELP?

**File to check:**
1. `QUICK_REFERENCE.md` - Command reference
2. `DATABASE_SETUP.md` - Database issues
3. `GIT_WORKFLOW.md` - Git issues
4. `README.md` - General documentation

**Contact:**
- Group Chat: [Link]
- Ketua Kelompok: [Name]
- Create Issue: [Repository]

---

## 🎯 DEVELOPMENT WORKFLOW

### Daily Workflow:

```bash
# 1. Mulai hari
git checkout main
git pull origin main

# 2. Buat/switch ke feature branch
git checkout -b feature/my-feature

# 3. Code, test, commit
git add .
git commit -m "feat: my awesome feature"

# 4. Push
git push origin feature/my-feature

# 5. Create Pull Request (di GitHub/GitLab)
# 6. Get review & merge
```

---

## 📊 CURRENT PROJECT STATUS

```
✅ Framework: Laravel 12.34.0
✅ Database: MySQL/MariaDB
✅ PHP: 8.4+
✅ Server: Running
✅ Homepage: Working
✅ Database: Migrated

STATUS: 🟢 READY FOR DEVELOPMENT
```

---

## 🎉 YOU'RE ALL SET!

Sekarang Anda siap untuk:
- ✅ Develop fitur Anda
- ✅ Collaborate dengan tim
- ✅ Contribute ke project

**Happy Coding! 🐺🚀**

---

**Need faster setup?** Ikuti "5 MENIT QUICK START" di atas!

---

**Updated:** 2025-10-17  
**For:** Anggota Baru / New Contributors
