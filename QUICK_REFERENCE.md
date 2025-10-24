# ⚡ QUICK REFERENCE - Laravel Commands

Daftar command yang sering digunakan dalam pengerjaan proyek.

---

## 🚀 Server & Environment

```bash
# Menjalankan development server
php artisan serve

# Menjalankan server di port tertentu
php artisan serve --port=8080

# Menjalankan server di host tertentu
php artisan serve --host=192.168.1.100

# Generate application key
php artisan key:generate

# Check Laravel version
php artisan --version
```

---

## 🎨 Make Commands (Membuat File)

```bash
# Controller
php artisan make:controller ProductController
php artisan make:controller ProductController --resource
php artisan make:controller ProductController --api

# Model
php artisan make:model Product
php artisan make:model Product -m          # dengan migration
php artisan make:model Product -mf         # dengan migration & factory
php artisan make:model Product -mfs        # dengan migration, factory & seeder
php artisan make:model Product --all       # dengan semua file terkait

# Migration
php artisan make:migration create_products_table
php artisan make:migration add_status_to_products_table

# Seeder
php artisan make:seeder ProductSeeder

# Factory
php artisan make:factory ProductFactory

# Request (Form Validation)
php artisan make:request StoreProductRequest

# Middleware
php artisan make:middleware CheckAge

# Policy
php artisan make:policy ProductPolicy

# Event
php artisan make:event ProductCreated

# Listener
php artisan make:listener SendProductNotification

# Mail
php artisan make:mail OrderShipped

# Notification
php artisan make:notification InvoicePaid

# Command
php artisan make:command SendEmails
```

---

## 🗃️ Database Commands

```bash
# Menjalankan migration
php artisan migrate

# Rollback migration terakhir
php artisan migrate:rollback

# Rollback semua migration
php artisan migrate:reset

# Rollback dan re-run semua migration
php artisan migrate:refresh

# Drop semua tables dan re-run migration
php artisan migrate:fresh

# Drop semua tables, re-run migration dan seeding
php artisan migrate:fresh --seed

# Menjalankan seeder
php artisan db:seed
php artisan db:seed --class=ProductSeeder

# Menjalankan seeder tertentu
php artisan migrate --seed

# Check migration status
php artisan migrate:status

# Generate model dari database (Laravel 10+)
php artisan model:show Product
```

---

## 🔄 Cache Commands

```bash
# Clear application cache
php artisan cache:clear

# Clear config cache
php artisan config:clear

# Clear route cache
php artisan route:clear

# Clear view cache
php artisan view:clear

# Clear all cache
php artisan optimize:clear

# Cache config (untuk production)
php artisan config:cache

# Cache routes (untuk production)
php artisan route:cache

# Cache views (untuk production)
php artisan view:cache

# Optimize untuk production
php artisan optimize
```

---

## 📋 Info & Debugging Commands

```bash
# List semua routes
php artisan route:list

# List routes dengan filter
php artisan route:list --path=api
php artisan route:list --method=GET

# Tinker (REPL untuk testing)
php artisan tinker

# Show application info
php artisan about

# List semua commands
php artisan list

# Storage link (untuk public storage)
php artisan storage:link

# Maintenance mode ON
php artisan down

# Maintenance mode OFF
php artisan up
```

---

## 🧪 Testing Commands

```bash
# Menjalankan semua test
php artisan test

# Menjalankan test tertentu
php artisan test --filter=ProductTest

# Membuat test
php artisan make:test ProductTest
php artisan make:test ProductTest --unit
```

---

## 📦 Composer Commands

```bash
# Install dependencies
composer install

# Update dependencies
composer update

# Add package
composer require laravel/sanctum

# Add dev package
composer require --dev laravel/telescope

# Remove package
composer remove laravel/sanctum

# Dump autoload
composer dump-autoload

# Show outdated packages
composer outdated

# Check for security vulnerabilities
composer audit
```

---

## 📦 NPM Commands (Frontend)

```bash
# Install dependencies
npm install

# Run development server
npm run dev

# Build for production
npm run build

# Watch for changes
npm run watch

# Add package
npm install axios

# Remove package
npm uninstall axios
```

---

## 🔐 Authentication Commands

```bash
# Install Laravel Breeze (simple auth)
composer require laravel/breeze --dev
php artisan breeze:install
php artisan migrate
npm install && npm run dev

# Install Laravel UI (Bootstrap/Vue/React auth)
composer require laravel/ui
php artisan ui bootstrap --auth
php artisan ui vue --auth
php artisan ui react --auth
npm install && npm run dev
```

---

## 🛠️ Custom Artisan Commands

### Membuat Custom Command:
```bash
php artisan make:command GenerateReport
```

### File: `app/Console/Commands/GenerateReport.php`
```php
<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateReport extends Command
{
    protected $signature = 'report:generate {type}';
    protected $description = 'Generate reports';

    public function handle()
    {
        $type = $this->argument('type');
        $this->info("Generating {$type} report...");
        // Logic here
    }
}
```

### Menjalankan:
```bash
php artisan report:generate daily
```

---

## 🔍 Debugging Tips

```bash
# Log viewer (install terlebih dahulu)
composer require rap2hpoutre/laravel-log-viewer
# Access: /logs

# Telescope (install terlebih dahulu)
composer require laravel/telescope --dev
php artisan telescope:install
php artisan migrate
# Access: /telescope

# Debugbar (install terlebih dahulu)
composer require barryvdh/laravel-debugbar --dev
```

---

## 📝 Git Commands (Quick Reference)

```bash
# Status
git status

# Add files
git add .
git add app/Http/Controllers/ProductController.php

# Commit
git commit -m "feat: add product controller"

# Push
git push origin feature/products

# Pull
git pull origin main

# Create branch
git checkout -b feature/products

# Switch branch
git checkout main

# List branches
git branch -a

# Delete branch
git branch -d feature/products

# Merge
git merge feature/products

# Stash
git stash
git stash pop
```

---

## 🗂️ File Permissions (Linux/Mac)

```bash
# Storage & Bootstrap cache permissions
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Atau
sudo chown -R $USER:www-data storage
sudo chown -R $USER:www-data bootstrap/cache
chmod -R 775 storage bootstrap/cache
```

---

## 🔧 Common Issues & Solutions

### Issue: Class not found
```bash
composer dump-autoload
```

### Issue: Route not found
```bash
php artisan route:cache
php artisan route:clear
```

### Issue: View not found
```bash
php artisan view:clear
```

### Issue: Config cached
```bash
php artisan config:clear
```

### Issue: Permission denied
```bash
chmod -R 775 storage bootstrap/cache
```

### Issue: Migration already ran
```bash
php artisan migrate:fresh  # HATI-HATI: Hapus semua data!
```

---

## 📱 Useful Aliases (Optional)

Tambahkan ke `~/.bashrc` atau `~/.zshrc`:

```bash
# Artisan aliases
alias art="php artisan"
alias artisan="php artisan"
alias migrate="php artisan migrate"
alias mfs="php artisan migrate:fresh --seed"
alias serve="php artisan serve"
alias tinker="php artisan tinker"

# Composer aliases
alias ci="composer install"
alias cu="composer update"
alias cda="composer dump-autoload"

# Git aliases
alias gs="git status"
alias ga="git add ."
alias gc="git commit -m"
alias gp="git push"
alias gl="git pull"
```

Reload shell: `source ~/.bashrc` atau `source ~/.zshrc`

---

## 🎯 Development Workflow

```bash
# 1. Pull latest changes
git pull origin main

# 2. Create feature branch
git checkout -b feature/my-feature

# 3. Run migrations
php artisan migrate

# 4. Start server
php artisan serve

# 5. Make changes...

# 6. Test
php artisan test

# 7. Clear cache
php artisan optimize:clear

# 8. Commit & Push
git add .
git commit -m "feat: add new feature"
git push origin feature/my-feature

# 9. Create Pull Request on GitHub/GitLab
```

---

## 📚 Documentation Links

- [Laravel Docs](https://laravel.com/docs)
- [Laravel Artisan Console](https://laravel.com/docs/artisan)
- [Composer Commands](https://getcomposer.org/doc/03-cli.md)
- [Git Documentation](https://git-scm.com/doc)

---

**Keep this as a quick reference! 📖**
