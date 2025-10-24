# ✅ PRE-PUSH CHECKLIST - Authentication Module

## 🎯 Complete This Checklist Before Pushing to GitHub

---

## Phase 1: Testing (CRITICAL - Do This First!)

### Step 1: Start MySQL Service
```bash
sudo systemctl start mysql
```
- [ ] MySQL service started successfully
- [ ] No connection errors

### Step 2: Run Database Migrations
```bash
php artisan migrate
```
- [ ] Migrations ran successfully
- [ ] `users` table created with all new fields
- [ ] No migration errors

### Step 3: Create Storage Link
```bash
php artisan storage:link
```
- [ ] Storage link created
- [ ] `public/storage` symlink exists

### Step 4: Seed Database
```bash
php artisan db:seed
```
- [ ] Seeding completed successfully
- [ ] Admin account created
- [ ] Dokter account created
- [ ] Pasien account created
- [ ] 10 additional patients created

### Step 5: Start Development Server
```bash
php artisan serve
```
- [ ] Server started at http://127.0.0.1:8000
- [ ] No startup errors

---

## Phase 2: Manual Testing

### Test 1: Registration
- [ ] Visit `/register` page
- [ ] Form displays correctly with all fields:
  - [ ] Name
  - [ ] Email
  - [ ] Phone
  - [ ] Password
  - [ ] Confirm Password
  - [ ] Role dropdown (Pasien/Dokter)
- [ ] Register a new test account
- [ ] Registration succeeds
- [ ] Redirects to dashboard/home
- [ ] User is logged in

### Test 2: Login with Admin Account
- [ ] Visit `/login` page
- [ ] Login with: `admin@healthcare.com` / `password`
- [ ] Login succeeds
- [ ] Redirects to dashboard/home
- [ ] User is logged in as admin

### Test 3: Login with Dokter Account
- [ ] Logout current user
- [ ] Login with: `dokter@healthcare.com` / `password`
- [ ] Login succeeds
- [ ] User role is 'dokter'

### Test 4: Login with Pasien Account
- [ ] Logout current user
- [ ] Login with: `pasien@healthcare.com` / `password`
- [ ] Login succeeds
- [ ] User role is 'pasien'

### Test 5: Profile Information Update
- [ ] Visit `/profile` page
- [ ] Profile page displays correctly
- [ ] All fields visible:
  - [ ] Name
  - [ ] Email
  - [ ] Phone
  - [ ] Date of Birth
  - [ ] Gender dropdown
  - [ ] Address
  - [ ] Role (read-only)
- [ ] Update phone number
- [ ] Update address
- [ ] Save changes
- [ ] Success message appears
- [ ] Changes persist after page reload

### Test 6: Profile Photo Upload
- [ ] Visit `/profile` page
- [ ] Photo upload section visible
- [ ] Upload a test image
- [ ] Image uploads successfully
- [ ] Photo displays correctly
- [ ] Photo path stored in database
- [ ] Photo accessible at `storage/profile-photos/`

### Test 7: Password Change
- [ ] Visit `/profile` page
- [ ] Password section visible
- [ ] Enter current password
- [ ] Enter new password
- [ ] Confirm new password
- [ ] Save password
- [ ] Success message appears
- [ ] Logout
- [ ] Login with NEW password
- [ ] Login succeeds

### Test 8: Role Middleware (Optional - requires test route)
Create a test route in `routes/web.php`:
```php
Route::get('/test-admin', function() {
    return 'Admin access granted';
})->middleware(['auth', 'role:admin']);
```
- [ ] Visit `/test-admin` as admin - Access granted
- [ ] Visit `/test-admin` as dokter - Access denied
- [ ] Visit `/test-admin` as pasien - Access denied
- [ ] Remove test route after testing

---

## Phase 3: Code Review

### Files to Verify
- [ ] `app/Models/User.php` - Has fillable fields and role methods
- [ ] `database/migrations/0001_01_01_000000_create_users_table.php` - Has 7 new fields
- [ ] `app/Http/Controllers/Auth/RegisteredUserController.php` - Has phone & role validation
- [ ] `app/Http/Controllers/ProfileController.php` - Has updatePhoto() and updatePassword() methods
- [ ] `app/Http/Middleware/RoleMiddleware.php` - Exists and has handle() method
- [ ] `app/Http/Requests/ProfileUpdateRequest.php` - Has extended validation rules
- [ ] `resources/views/auth/register.blade.php` - Has phone and role fields
- [ ] `resources/views/profile/edit.blade.php` - Includes photo section
- [ ] `resources/views/profile/partials/update-profile-information-form.blade.php` - Has all new fields
- [ ] `resources/views/profile/partials/update-profile-photo-form.blade.php` - Exists
- [ ] `routes/web.php` - Has profile.photo.update and profile.password.update routes
- [ ] `bootstrap/app.php` - Has 'role' middleware alias registered
- [ ] `database/seeders/UserSeeder.php` - Has 3 test accounts
- [ ] `database/seeders/DatabaseSeeder.php` - Calls UserSeeder

### No Sensitive Data
- [ ] No real passwords in code (except seeder)
- [ ] No API keys exposed
- [ ] `.env` file not in git (should be in .gitignore)
- [ ] No personal information in code

### Code Quality
- [ ] No syntax errors
- [ ] No debug statements (dd(), dump(), var_dump())
- [ ] No commented-out code blocks
- [ ] Proper indentation
- [ ] Consistent naming conventions

---

## Phase 4: Documentation

### Documentation Files Created
- [ ] `AUTH_MODULE_COMPLETE.md` exists
- [ ] `GIT_PUSH_GUIDE.md` exists
- [ ] `FINAL_SUMMARY.md` exists
- [ ] `CHECKLIST.md` (this file) exists

### Documentation Content
- [ ] Setup instructions are clear
- [ ] Test account credentials documented
- [ ] Code examples provided for team
- [ ] Next steps defined for other members

---

## Phase 5: Git Preparation

### Initialize Git (if not already done)
```bash
cd "/home/fara/Documents/Tugas Besar Pemrograman Web Kelompokk Serigala Putih"
git init
```
- [ ] Git initialized

### Create .gitignore (if not exists)
```bash
echo "vendor/
node_modules/
.env
storage/*.key
.phpunit.result.cache
public/storage
public/hot
storage/logs/*
!storage/logs/.gitignore" > .gitignore
```
- [ ] .gitignore created
- [ ] Sensitive files excluded

### Check Git Status
```bash
git status
```
- [ ] Review files to be committed
- [ ] No unwanted files (vendor/, .env, etc.)

---

## Phase 6: Git Commit & Push

### Add Files to Git
```bash
git add .
```
- [ ] All files staged

### Commit Changes
```bash
git commit -m "✨ Complete Authentication & User Management Module

Features:
- Extended user model with healthcare fields
- Registration with role selection
- Profile management (info, photo, password)
- Role-based access control middleware
- User seeder with test accounts
- Complete documentation

Ready for team collaboration!"
```
- [ ] Changes committed

### Add Remote (first time only)
```bash
git remote add origin <your-github-repo-url>
```
- [ ] Remote added

### Push to GitHub
```bash
git push -u origin main
# or
git push -u origin master
```
- [ ] Code pushed successfully
- [ ] Verify on GitHub website

---

## Phase 7: Team Communication

### Notify Team Members
- [ ] Send message to team group/channel
- [ ] Share repository link
- [ ] Share test account credentials
- [ ] Point them to `AUTH_MODULE_COMPLETE.md`

### Message Template:
```
🎉 Authentication Module Complete!

The first module is ready and pushed to GitHub!

📦 Repository: [your-repo-url]

✅ What's included:
- User registration with role selection
- Profile management with photo upload
- Role-based access control
- Test accounts ready

📖 Setup Guide: See AUTH_MODULE_COMPLETE.md in the repo

🧪 Test Accounts:
- Admin: admin@healthcare.com / password
- Dokter: dokter@healthcare.com / password  
- Pasien: pasien@healthcare.com / password

🚀 Get started:
1. git clone [repo-url]
2. composer install
3. cp .env.example .env
4. php artisan migrate
5. php artisan db:seed
6. php artisan storage:link

Let's build the remaining modules! 💪
```
- [ ] Message sent

---

## Phase 8: Final Verification

### On GitHub
- [ ] Repository accessible
- [ ] All files visible
- [ ] README.md displays correctly
- [ ] Documentation files viewable

### Locally
- [ ] Server still running
- [ ] Tests still passing
- [ ] No errors in logs

---

## 🎉 COMPLETION CRITERIA

### All Must Be Checked:
- [x] MySQL started ← **DO THIS FIRST**
- [x] Migrations ran successfully ← **DO THIS SECOND**
- [x] Storage link created ← **DO THIS THIRD**
- [x] Database seeded ← **DO THIS FOURTH**
- [ ] Registration tested and works
- [ ] Login tested with all 3 roles
- [ ] Profile update tested
- [ ] Photo upload tested
- [ ] Password change tested
- [ ] Code reviewed
- [ ] Documentation complete
- [ ] Git committed and pushed
- [ ] Team notified

---

## 🚨 IMPORTANT REMINDERS

1. **NEVER push .env file** - Contains sensitive data
2. **ALWAYS test before pushing** - Ensure everything works
3. **Document test credentials** - Team needs them
4. **Clear commit messages** - Helps team understand changes
5. **Notify team immediately** - They're waiting to start their modules

---

## 📞 If Something Goes Wrong

### Database Issues
```bash
# Reset migrations
php artisan migrate:fresh

# Reseed database
php artisan db:seed
```

### Git Issues
```bash
# Undo last commit (keep changes)
git reset --soft HEAD~1

# Discard uncommitted changes
git checkout -- .
```

### Storage Issues
```bash
# Recreate storage link
php artisan storage:link

# Fix permissions
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

---

## ✅ READY TO PUSH?

**If all checkboxes above are marked, you're ready to push!** 🚀

**Command sequence:**
```bash
git add .
git commit -m "✨ Complete Authentication & User Management Module"
git push origin main
```

**Then notify your team and celebrate! 🎉**

---

*Keep this checklist for future reference when pushing updates!*
