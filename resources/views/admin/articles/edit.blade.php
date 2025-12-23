<x-admin-layout>
    <x-slot name="header">Edit Artikel</x-slot>

    <!-- Page Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-white">Edit Artikel</h2>
            <p class="text-gray-400 mt-1">{{ Str::limit($article->title, 50) }}</p>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.articles.show', $article) }}" 
               class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                <i class="fas fa-eye mr-2"></i> Preview
            </a>
            <a href="{{ route('admin.articles.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-medium transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>

    <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
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
                            <input type="text" name="title" value="{{ old('title', $article->title) }}" required
                                   class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-lg @error('title') border-red-500 @enderror"
                                   placeholder="Masukkan judul artikel yang menarik...">
                            @error('title')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Slug</label>
                            <input type="text" name="slug" value="{{ old('slug', $article->slug) }}"
                                   class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 font-mono text-sm"
                                   placeholder="custom-url-slug">
                            <p class="mt-1 text-xs text-gray-500">Kosongkan untuk generate otomatis dari judul</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Ringkasan/Excerpt</label>
                            <textarea name="excerpt" rows="3"
                                      class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                                      placeholder="Ringkasan singkat artikel (akan ditampilkan di preview)...">{{ old('excerpt', $article->excerpt) }}</textarea>
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
                        <textarea name="content" rows="20" required
                                  class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 font-mono text-sm @error('content') border-red-500 @enderror"
                                  placeholder="Tulis konten artikel di sini...">{{ old('content', $article->content) }}</textarea>
                        @error('content')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
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
                            <input type="text" name="meta_title" value="{{ old('meta_title', $article->meta_title) }}"
                                   class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                                   placeholder="Judul untuk SEO">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Meta Description</label>
                            <textarea name="meta_description" rows="2"
                                      class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                                      placeholder="Deskripsi untuk SEO">{{ old('meta_description', $article->meta_description) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Stats -->
                <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-chart-bar text-blue-500 mr-2"></i>
                        Statistik
                    </h3>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div class="text-center p-3 bg-gray-700/50 rounded-lg">
                            <p class="text-2xl font-bold text-white">{{ number_format($article->views) }}</p>
                            <p class="text-xs text-gray-400">Views</p>
                        </div>
                        <div class="text-center p-3 bg-gray-700/50 rounded-lg">
                            <p class="text-2xl font-bold text-white">{{ $article->reading_time }}</p>
                            <p class="text-xs text-gray-400">Min Read</p>
                        </div>
                    </div>
                </div>

                <!-- Publish Options -->
                <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-paper-plane text-blue-500 mr-2"></i>
                        Publikasi
                    </h3>
                    
                    <div class="space-y-4">
                        <div class="flex items-center justify-between p-3 bg-gray-700/50 rounded-lg">
                            <span class="text-gray-400">Status</span>
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $article->is_published ? 'bg-green-500/20 text-green-400' : 'bg-yellow-500/20 text-yellow-400' }}">
                                {{ $article->is_published ? 'Published' : 'Draft' }}
                            </span>
                        </div>

                        <label class="flex items-center">
                            <input type="checkbox" name="is_published" value="1" {{ old('is_published', $article->is_published) ? 'checked' : '' }}
                                   class="w-4 h-4 rounded border-gray-600 bg-gray-700 text-blue-600 focus:ring-blue-500 focus:ring-offset-gray-800">
                            <span class="ml-2 text-gray-300">Published</span>
                        </label>

                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Tanggal Publish</label>
                            <input type="datetime-local" name="published_at" 
                                   value="{{ old('published_at', $article->published_at?->format('Y-m-d\TH:i')) }}"
                                   class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
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
                                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                                <option value="">Pilih Kategori</option>
                                @foreach(\App\Models\Article::CATEGORIES as $key => $label)
                                    <option value="{{ $key }}" {{ old('category', $article->category) == $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Tags</label>
                            <input type="text" name="tags" value="{{ old('tags', is_array($article->tags) ? implode(', ', $article->tags) : $article->tags) }}"
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
                    
                    <div x-data="{ preview: '{{ $article->featured_image ? Storage::url($article->featured_image) : '' }}' }">
                        <div class="relative">
                            <div class="w-full aspect-video bg-gray-700 rounded-lg border-2 border-dashed border-gray-600 flex items-center justify-center overflow-hidden"
                                 :class="{ 'border-blue-500': preview }">
                                <template x-if="!preview">
                                    <div class="text-center p-4">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-500 mb-2"></i>
                                        <p class="text-sm text-gray-400">Klik atau drag untuk upload</p>
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
                        @if($article->featured_image)
                            <p class="mt-2 text-xs text-gray-500">Gambar akan diganti jika upload baru</p>
                        @endif
                    </div>
                </div>

                <!-- Actions -->
                <div class="bg-gray-800 rounded-xl p-6 border border-gray-700 space-y-3">
                    <button type="submit" 
                            class="w-full px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-lg font-medium transition-all shadow-lg hover:shadow-blue-500/25">
                        <i class="fas fa-save mr-2"></i> Simpan Perubahan
                    </button>
                </div>

                <!-- Danger Zone -->
                <div class="bg-gray-800 rounded-xl p-6 border border-red-500/30">
                    <h3 class="text-lg font-semibold text-red-400 mb-4 flex items-center">
                        <i class="fas fa-exclamation-triangle mr-2"></i>
                        Zona Berbahaya
                    </h3>
                    
                    <form action="{{ route('admin.articles.destroy', $article) }}" method="POST"
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-colors">
                            <i class="fas fa-trash mr-2"></i> Hapus Artikel
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </form>
</x-admin-layout>
