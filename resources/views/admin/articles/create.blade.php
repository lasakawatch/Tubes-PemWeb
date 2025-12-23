<x-admin-layout>
    <x-slot name="header">Tambah Artikel</x-slot>

    <!-- Page Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-white">Tambah Artikel Baru</h2>
            <p class="text-gray-400 mt-1">Buat artikel kesehatan yang informatif</p>
        </div>
        <a href="{{ route('admin.articles.index') }}" 
           class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-medium transition-colors">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Title -->
                <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-heading text-blue-500 mr-2"></i>
                        Judul & Ringkasan
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Judul Artikel <span class="text-red-500">*</span></label>
                            <input type="text" name="title" value="{{ old('title') }}" required
                                   class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-lg @error('title') border-red-500 @enderror"
                                   placeholder="Masukkan judul artikel yang menarik...">
                            @error('title')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Ringkasan/Excerpt</label>
                            <textarea name="excerpt" rows="3"
                                      class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                                      placeholder="Ringkasan singkat artikel (akan ditampilkan di preview)...">{{ old('excerpt') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Content -->
                <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-align-left text-green-500 mr-2"></i>
                        Konten Artikel
                    </h3>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Isi Artikel <span class="text-red-500">*</span></label>
                        <textarea name="content" rows="15" required
                                  class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 font-mono text-sm @error('content') border-red-500 @enderror"
                                  placeholder="Tulis konten artikel di sini... Anda bisa menggunakan HTML untuk formatting.">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-xs text-gray-500">Tips: Gunakan tag HTML seperti &lt;h2&gt;, &lt;p&gt;, &lt;ul&gt;, &lt;strong&gt; untuk formatting.</p>
                    </div>
                </div>

                <!-- SEO -->
                <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-search text-purple-500 mr-2"></i>
                        SEO & Meta
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Meta Title</label>
                            <input type="text" name="meta_title" value="{{ old('meta_title') }}"
                                   class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                                   placeholder="Judul untuk SEO (kosongkan untuk menggunakan judul artikel)">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Meta Description</label>
                            <textarea name="meta_description" rows="2"
                                      class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                                      placeholder="Deskripsi untuk SEO (150-160 karakter optimal)">{{ old('meta_description') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Publish Options -->
                <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-paper-plane text-blue-500 mr-2"></i>
                        Publikasi
                    </h3>
                    
                    <div class="space-y-4">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_published" value="1" {{ old('is_published') ? 'checked' : '' }}
                                   class="w-4 h-4 rounded border-gray-600 bg-gray-700 text-blue-600 focus:ring-blue-500 focus:ring-offset-gray-800">
                            <span class="ml-2 text-gray-300">Publish langsung</span>
                        </label>

                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Tanggal Publish</label>
                            <input type="datetime-local" name="published_at" value="{{ old('published_at') }}"
                                   class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                            <p class="mt-1 text-xs text-gray-500">Kosongkan untuk publish sekarang</p>
                        </div>
                    </div>
                </div>

                <!-- Category & Tags -->
                <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-folder text-yellow-500 mr-2"></i>
                        Kategori & Tags
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Kategori <span class="text-red-500">*</span></label>
                            <select name="category" required
                                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('category') border-red-500 @enderror">
                                <option value="">Pilih Kategori</option>
                                @foreach(\App\Models\Article::CATEGORIES as $key => $label)
                                    <option value="{{ $key }}" {{ old('category') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Tags</label>
                            <input type="text" name="tags" value="{{ old('tags') }}"
                                   class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                                   placeholder="kesehatan, tips, nutrisi">
                            <p class="mt-1 text-xs text-gray-500">Pisahkan dengan koma</p>
                        </div>
                    </div>
                </div>

                <!-- Featured Image -->
                <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-image text-pink-500 mr-2"></i>
                        Gambar Utama
                    </h3>
                    
                    <div x-data="{ preview: null }">
                        <div class="relative">
                            <div class="w-full aspect-video bg-gray-700 rounded-lg border-2 border-dashed border-gray-600 flex items-center justify-center overflow-hidden"
                                 :class="{ 'border-blue-500': preview }">
                                <template x-if="!preview">
                                    <div class="text-center p-4">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-500 mb-2"></i>
                                        <p class="text-sm text-gray-400">Klik atau drag untuk upload</p>
                                        <p class="text-xs text-gray-500 mt-1">16:9 ratio, max 2MB</p>
                                    </div>
                                </template>
                                <template x-if="preview">
                                    <img :src="preview" class="w-full h-full object-cover">
                                </template>
                            </div>
                            <input type="file" name="featured_image" accept="image/*" 
                                   @change="preview = URL.createObjectURL($event.target.files[0])"
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        </div>
                        @error('featured_image')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit -->
                <div class="bg-gray-800 rounded-xl p-6 border border-gray-700 space-y-3">
                    <button type="submit" name="action" value="publish"
                            class="w-full px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 hover:from-green-700 hover:to-green-800 text-white rounded-lg font-medium transition-all shadow-lg hover:shadow-green-500/25">
                        <i class="fas fa-paper-plane mr-2"></i> Publish Artikel
                    </button>
                    <button type="submit" name="action" value="draft"
                            class="w-full px-6 py-3 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-medium transition-colors">
                        <i class="fas fa-save mr-2"></i> Simpan Draft
                    </button>
                </div>
            </div>
        </div>
    </form>
</x-admin-layout>
