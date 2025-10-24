# Git Workflow - Kelompok Serigala Putih

## 📌 Branch Strategy

### Main Branches
- `main` - Production ready code
- `develop` - Development branch (integration)

### Feature Branches
- `feature/authentication` - Anggota 1
- `feature/products` - Anggota 2
- `feature/dashboard` - Anggota 3
- `feature/cms` - Anggota 4
- `feature/admin-panel` - Anggota 5

---

## 🔄 Workflow Steps

### 1. Setup Awal (Sekali saja)

```bash
# Clone repository
git clone [URL_REPOSITORY]
cd "Tugas Besar Pemrograman Web Kelompokk Serigala Putih"

# Install dependencies
composer install

# Setup environment
cp .env.example .env
php artisan key:generate

# Setup database
php artisan migrate
```

---

### 2. Sebelum Mulai Coding (SELALU!)

```bash
# Pastikan di branch main
git checkout main

# Pull perubahan terbaru
git pull origin main

# Buat branch baru untuk fitur Anda
git checkout -b feature/nama-fitur-anda

# Contoh:
# git checkout -b feature/authentication
# git checkout -b feature/products
```

---

### 3. Selama Coding

```bash
# Cek status perubahan
git status

# Lihat perubahan detail
git diff

# Add file yang diubah
git add .
# atau add file specific
git add app/Http/Controllers/ProductController.php

# Commit dengan pesan yang jelas
git commit -m "feat: menambahkan fitur login"

# Push ke remote branch
git push origin feature/nama-fitur-anda
```

---

### 4. Commit Message Convention

Gunakan format berikut untuk commit message:

```
<type>: <deskripsi singkat>

[optional body]

[optional footer]
```

**Types:**
- `feat`: Fitur baru
- `fix`: Bug fix
- `docs`: Perubahan dokumentasi
- `style`: Format code (tidak mengubah logic)
- `refactor`: Refactoring code
- `test`: Menambah atau update test
- `chore`: Update dependencies, dll

**Contoh:**
```bash
git commit -m "feat: menambahkan halaman login"
git commit -m "fix: memperbaiki error pada form register"
git commit -m "docs: update README dengan instruksi instalasi"
git commit -m "style: format code ProductController"
git commit -m "refactor: memindahkan logic validasi ke FormRequest"
```

---

### 5. Membuat Pull Request

1. **Push branch Anda:**
   ```bash
   git push origin feature/nama-fitur-anda
   ```

2. **Buat Pull Request di GitHub/GitLab:**
   - Buka repository di browser
   - Klik "New Pull Request"
   - Pilih base: `main` ← compare: `feature/nama-fitur-anda`
   - Isi judul dan deskripsi PR dengan jelas
   - Request review dari anggota tim lain
   - Klik "Create Pull Request"

3. **Template Pull Request:**
   ```markdown
   ## 📝 Deskripsi
   Menambahkan fitur authentication (login & register)

   ## ✅ Checklist
   - [x] Code berjalan tanpa error
   - [x] Migration berhasil
   - [x] Views responsive
   - [x] Sudah di-test
   - [x] Code sudah di-comment

   ## 📸 Screenshot (optional)
   [Tambahkan screenshot jika perlu]

   ## 🔗 Related Issue
   Closes #1
   ```

---

### 6. Review & Merge

**Untuk Reviewer:**
```bash
# Checkout branch yang akan direview
git checkout feature/nama-fitur

# Test fitur tersebut
php artisan migrate
php artisan serve

# Jika OK, approve PR di GitHub/GitLab
```

**Setelah PR Approved:**
- Merge PR ke main
- Delete branch feature yang sudah dimerge (optional)

---

### 7. Sync dengan Main Branch

```bash
# Pindah ke main
git checkout main

# Pull perubahan terbaru
git pull origin main

# Buat branch baru untuk fitur berikutnya
git checkout -b feature/fitur-baru
```

---

## 🚨 Handling Conflicts

### Jika terjadi conflict saat merge:

```bash
# Pull main terbaru
git checkout main
git pull origin main

# Merge main ke feature branch Anda
git checkout feature/nama-fitur-anda
git merge main

# Resolve conflicts di file yang conflict
# Edit file secara manual, hapus markers seperti:
# <<<<<<< HEAD
# =======
# >>>>>>> main

# Setelah resolve, add dan commit
git add .
git commit -m "fix: resolve merge conflicts"

# Push
git push origin feature/nama-fitur-anda
```

---

## 📋 Useful Git Commands

```bash
# Lihat semua branch
git branch -a

# Hapus branch lokal
git branch -d feature/nama-branch

# Hapus branch remote
git push origin --delete feature/nama-branch

# Undo commit terakhir (keep changes)
git reset --soft HEAD~1

# Undo commit terakhir (discard changes) - HATI-HATI!
git reset --hard HEAD~1

# Lihat history commit
git log --oneline

# Lihat perubahan file tertentu
git diff app/Http/Controllers/ProductController.php

# Stash changes (simpan sementara)
git stash

# Apply stashed changes
git stash pop

# Lihat remote repository
git remote -v

# Update remote URL
git remote set-url origin [NEW_URL]
```

---

## 🎯 Best Practices

1. **Commit Often**: Commit kecil-kecil tapi sering
2. **Pull Before Push**: Selalu pull dulu sebelum push
3. **Clear Messages**: Gunakan commit message yang jelas
4. **Test Before Commit**: Test code sebelum commit
5. **Review Code**: Review code anggota lain
6. **Don't Push to Main**: Jangan push langsung ke main
7. **Delete Merged Branches**: Hapus branch yang sudah dimerge
8. **Use .gitignore**: Jangan commit file yang tidak perlu

---

## 🔒 .gitignore Important Files

Pastikan file berikut ada di `.gitignore`:

```
/node_modules
/public/hot
/public/storage
/storage/*.key
/vendor
.env
.env.backup
.phpunit.result.cache
Homestead.json
Homestead.yaml
npm-debug.log
yarn-error.log
/.idea
/.vscode
```

---

## 🆘 Emergency Commands

### Jika salah commit:
```bash
# Undo commit terakhir (keep changes)
git reset --soft HEAD~1
```

### Jika salah push:
```bash
# Revert commit (buat commit baru yang undo)
git revert HEAD
git push origin feature/nama-branch
```

### Jika mau buang semua perubahan lokal:
```bash
# HATI-HATI! Ini akan menghapus semua perubahan
git reset --hard HEAD
git clean -fd
```

---

## 📞 Need Help?

Jika mengalami masalah dengan Git:
1. Jangan panik!
2. Jangan force push ke main
3. Tanya di grup chat
4. Hubungi ketua kelompok

---

**Good Luck & Keep Committing! 🚀**
