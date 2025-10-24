# 🎨 DOKUMENTASI KOMPONEN BLADE

Komponen-komponen yang sudah dibuat untuk memudahkan development.

---

## 📦 Komponen yang Tersedia

### 1. Navbar Component
**File**: `resources/views/components/navbar.blade.php`

**Penggunaan:**
```blade
@include('components.navbar')
```

**Fitur:**
- Responsive menu (desktop & mobile)
- Support authentication status
- Dropdown user menu (jika sudah login)
- Active link highlighting

---

### 2. Footer Component
**File**: `resources/views/components/footer.blade.php`

**Penggunaan:**
```blade
@include('components.footer')
```

**Fitur:**
- Link navigation
- Social media icons
- Newsletter form
- Scroll to top button
- Contact information

---

### 3. Alert Component
**File**: `resources/views/components/alert.blade.php`

**Penggunaan:**

**Cara 1 - Dengan Props:**
```blade
<x-alert type="success" message="Data berhasil disimpan!" />
<x-alert type="error" message="Terjadi kesalahan!" />
<x-alert type="warning" message="Harap perhatikan!" />
<x-alert type="info" message="Informasi penting" />
```

**Cara 2 - Dengan Slot:**
```blade
<x-alert type="success">
    Data berhasil disimpan!
</x-alert>
```

**Cara 3 - Dengan Title:**
```blade
<x-alert type="success" title="Berhasil!" message="Data berhasil disimpan!" />
```

**Props:**
- `type`: success, error, warning, info (default: info)
- `message`: Pesan yang akan ditampilkan
- `title`: Judul alert (optional)
- `dismissible`: true/false (default: true)

**Dengan Session Flash:**
```php
// Di Controller
return redirect()->back()->with('success', 'Data berhasil disimpan!');
```

```blade
// Di View
@if(session('success'))
    <x-alert type="success" :message="session('success')" />
@endif

@if(session('error'))
    <x-alert type="error" :message="session('error')" />
@endif
```

---

## 🎯 Cara Membuat Komponen Baru

### 1. Membuat File Komponen

```bash
# Buat file di resources/views/components/
# Contoh: card.blade.php
```

### 2. Struktur Komponen

```blade
{{-- Card Component --}}
@props(['title' => '', 'image' => null])

<div class="bg-white rounded-lg shadow-md overflow-hidden">
    @if($image)
        <img src="{{ $image }}" alt="{{ $title }}" class="w-full h-48 object-cover">
    @endif
    
    <div class="p-4">
        @if($title)
            <h3 class="text-xl font-bold mb-2">{{ $title }}</h3>
        @endif
        
        <div class="text-gray-600">
            {{ $slot }}
        </div>
    </div>
</div>
```

### 3. Menggunakan Komponen

```blade
<x-card title="Judul Card" image="/images/sample.jpg">
    Ini adalah isi dari card
</x-card>
```

---

## 🎨 Styling Guidelines

### Colors
```
Primary: purple-600 (#7C3AED)
Secondary: gray-800
Success: green-500
Error: red-500
Warning: yellow-500
Info: blue-500
```

### Spacing
```
Small: p-2, m-2
Medium: p-4, m-4
Large: p-8, m-8
```

### Shadows
```
Small: shadow-sm
Medium: shadow-md
Large: shadow-lg
Extra Large: shadow-xl
```

### Rounded Corners
```
Small: rounded-sm
Medium: rounded-md
Large: rounded-lg
Full: rounded-full
```

---

## 📋 Contoh Komponen Lainnya

### Button Component
```blade
{{-- resources/views/components/button.blade.php --}}
@props(['type' => 'button', 'variant' => 'primary', 'size' => 'md'])

@php
    $variants = [
        'primary' => 'bg-purple-600 hover:bg-purple-700 text-white',
        'secondary' => 'bg-gray-600 hover:bg-gray-700 text-white',
        'danger' => 'bg-red-600 hover:bg-red-700 text-white',
        'success' => 'bg-green-600 hover:bg-green-700 text-white',
    ];
    
    $sizes = [
        'sm' => 'px-3 py-1 text-sm',
        'md' => 'px-4 py-2',
        'lg' => 'px-6 py-3 text-lg',
    ];
@endphp

<button 
    type="{{ $type }}"
    class="rounded transition {{ $variants[$variant] }} {{ $sizes[$size] }} {{ $attributes->get('class') }}"
    {{ $attributes }}
>
    {{ $slot }}
</button>
```

**Penggunaan:**
```blade
<x-button variant="primary" size="md">Submit</x-button>
<x-button variant="danger" size="lg">Delete</x-button>
```

---

### Modal Component
```blade
{{-- resources/views/components/modal.blade.php --}}
@props(['id' => 'modal', 'title' => ''])

<div 
    id="{{ $id }}" 
    class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden overflow-y-auto h-full w-full z-50"
    onclick="closeModal('{{ $id }}')"
>
    <div 
        class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white"
        onclick="event.stopPropagation()"
    >
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-bold">{{ $title }}</h3>
            <button onclick="closeModal('{{ $id }}')" class="text-gray-400 hover:text-gray-600">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <div>
            {{ $slot }}
        </div>
    </div>
</div>

<script>
    function openModal(id) {
        document.getElementById(id).classList.remove('hidden');
    }
    
    function closeModal(id) {
        document.getElementById(id).classList.add('hidden');
    }
</script>
```

**Penggunaan:**
```blade
<button onclick="openModal('myModal')">Open Modal</button>

<x-modal id="myModal" title="Konfirmasi">
    <p>Apakah Anda yakin ingin menghapus data ini?</p>
    <div class="mt-4 flex justify-end space-x-2">
        <button onclick="closeModal('myModal')" class="px-4 py-2 bg-gray-300 rounded">Batal</button>
        <button class="px-4 py-2 bg-red-600 text-white rounded">Hapus</button>
    </div>
</x-modal>
```

---

### Loading Spinner Component
```blade
{{-- resources/views/components/loading.blade.php --}}
@props(['size' => 'md'])

@php
    $sizes = [
        'sm' => 'w-4 h-4',
        'md' => 'w-8 h-8',
        'lg' => 'w-12 h-12',
    ];
@endphp

<div class="flex justify-center items-center">
    <div class="{{ $sizes[$size] }} border-4 border-purple-200 border-t-purple-600 rounded-full animate-spin"></div>
</div>
```

**Penggunaan:**
```blade
<x-loading size="md" />
```

---

### Breadcrumb Component
```blade
{{-- resources/views/components/breadcrumb.blade.php --}}
@props(['items' => []])

<nav class="flex mb-4" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
        @foreach($items as $index => $item)
            <li class="inline-flex items-center">
                @if($index > 0)
                    <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                @endif
                
                @if(isset($item['url']) && $index < count($items) - 1)
                    <a href="{{ $item['url'] }}" class="text-gray-700 hover:text-purple-600">
                        {{ $item['label'] }}
                    </a>
                @else
                    <span class="text-gray-500">{{ $item['label'] }}</span>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
```

**Penggunaan:**
```blade
<x-breadcrumb :items="[
    ['label' => 'Home', 'url' => route('home')],
    ['label' => 'Products', 'url' => route('products.index')],
    ['label' => 'Product Detail']
]" />
```

---

## 🔧 Tips & Best Practices

1. **Reusable Components**: Buat komponen yang bisa digunakan di berbagai tempat
2. **Props dengan Default**: Selalu berikan default value untuk props
3. **Responsive**: Pastikan komponen responsive
4. **Accessible**: Tambahkan aria-label dan role
5. **Documentation**: Tambahkan komentar di setiap komponen
6. **Consistent Naming**: Gunakan naming yang konsisten
7. **Slot Usage**: Gunakan slot untuk konten dinamis

---

## 📚 Resources

- [Laravel Blade Components](https://laravel.com/docs/blade#components)
- [Tailwind CSS](https://tailwindcss.com/docs)
- [Font Awesome Icons](https://fontawesome.com/icons)
- [Alpine.js](https://alpinejs.dev/) (optional untuk interaksi)

---

**Happy Coding! 🚀**
