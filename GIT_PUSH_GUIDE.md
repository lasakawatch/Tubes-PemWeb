# 🚀 Git Push Guide - Authentication Module

## Before Pushing to GitHub

### 1. Test the System (IMPORTANT!)
```bash
# Start MySQL service
sudo systemctl start mysql

# Run migrations
php artisan migrate

# Create storage link
php artisan storage:link

# Seed database
php artisan db:seed

# Start server
php artisan serve
```

### 2. Test Login with Sample Accounts
- Admin: `admin@healthcare.com` / `password`
- Dokter: `dokter@healthcare.com` / `password`
- Pasien: `pasien@healthcare.com` / `password`

---

## Git Commands to Push

### Step 1: Check Status
```bash
git status
```

### Step 2: Add All Files
```bash
git add .
```

### Step 3: Commit Changes
```bash
git commit -m "✨ Implement Authentication & User Management Module

Features:
- Extended user model with healthcare fields (role, phone, address, DOB, gender, profile_photo)
- Registration with role selection (Pasien/Dokter)
- Profile management (info update, photo upload, password change)
- Role-based access control middleware
- User seeder with test accounts
- Complete documentation

Ready for team collaboration!"
```

### Step 4: Push to GitHub
```bash
# If main branch
git push origin main

# If master branch
git push origin master

# If specific branch
git push origin <branch-name>
```

---

## Alternative: Push to New Branch

### Create Feature Branch
```bash
git checkout -b feature/authentication-module
git add .
git commit -m "✨ Complete Authentication & User Management Module"
git push origin feature/authentication-module
```

Then create a Pull Request on GitHub for team review.

---

## Files to Verify Before Push

### Check these files were modified:
- [ ] `app/Models/User.php`
- [ ] `database/migrations/0001_01_01_000000_create_users_table.php`
- [ ] `app/Http/Controllers/Auth/RegisteredUserController.php`
- [ ] `app/Http/Controllers/ProfileController.php`
- [ ] `app/Http/Middleware/RoleMiddleware.php`
- [ ] `resources/views/auth/register.blade.php`
- [ ] `resources/views/profile/edit.blade.php`
- [ ] `resources/views/profile/partials/update-profile-information-form.blade.php`
- [ ] `resources/views/profile/partials/update-profile-photo-form.blade.php`
- [ ] `routes/web.php`
- [ ] `bootstrap/app.php`
- [ ] `database/seeders/UserSeeder.php`
- [ ] `database/seeders/DatabaseSeeder.php`
- [ ] `AUTH_MODULE_COMPLETE.md`

---

## Share with Team Members

After pushing, share this information with your team:

**Repository Link:** `<your-github-repo-url>`

**Message Template:**
```
🎉 Authentication Module Complete!

I've finished implementing the Authentication & User Management module. 

✅ What's ready:
- User registration with role selection
- Profile management with photo upload
- Role-based access control
- Test accounts ready to use

📚 Setup Guide: See AUTH_MODULE_COMPLETE.md

🧪 Test Accounts:
- Admin: admin@healthcare.com / password
- Dokter: dokter@healthcare.com / password
- Pasien: pasien@healthcare.com / password

Please pull the latest changes and follow the setup instructions!
```

---

## What to Tell Team Members

### For Member 2 (Appointment System):
"You can now use auth()->user() and role middleware for appointments. See AUTH_MODULE_COMPLETE.md for examples."

### For Member 3 (CMS):
"Role-based access is ready. Use `middleware(['auth', 'role:admin,dokter'])` for content management routes."

### For Member 4 (Dashboard):
"User roles and profile data are available. Check AUTH_MODULE_COMPLETE.md for blade examples."

### For Member 5 (Admin Panel):
"RoleMiddleware is ready. Use `role:admin` to protect admin routes. See usage examples in docs."

---

## Quick Commands Reference

```bash
# Clone repo (for team members)
git clone <repo-url>
cd <project-folder>

# Install dependencies
composer install

# Setup environment
cp .env.example .env
php artisan key:generate

# Configure .env for database
# Then run:
php artisan migrate
php artisan db:seed
php artisan storage:link
php artisan serve
```

---

## ✅ Checklist Before Push

- [ ] Code tested locally
- [ ] Database migrations work
- [ ] Sample accounts login successfully
- [ ] Profile update works
- [ ] Photo upload works
- [ ] Password change works
- [ ] Role middleware tested
- [ ] Documentation complete
- [ ] .env.example updated (if needed)
- [ ] No sensitive data in commits

---

**Ready to push? Run the commands above! 🚀**
