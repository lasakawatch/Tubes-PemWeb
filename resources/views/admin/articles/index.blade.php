<x-admin-layout>
    <x-slot name="header">Kelola Artikel</x-slot>

    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-white">Daftar Artikel</h2>
            <p class="text-gray-400 mt-1">Kelola semua artikel kesehatan</p>
        </div>
        <a href="{{ route('admin.articles.create') }}" 
           class="mt-4 md:mt-0 inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-lg font-medium transition-all shadow-lg hover:shadow-blue-500/25">
            <i class="fas fa-plus mr-2"></i> Tambah Artikel
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Total Artikel</p>
                    <p class="text-2xl font-bold text-white mt-1">{{ \App\Models\Article::count() }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-500/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-newspaper text-blue-500 text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Published</p>
                    <p class="text-2xl font-bold text-green-400 mt-1">{{ \App\Models\Article::published()->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-green-500/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-500 text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Draft</p>
                    <p class="text-2xl font-bold text-yellow-400 mt-1">{{ \App\Models\Article::draft()->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-500/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-file-alt text-yellow-500 text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Total Views</p>
                    <p class="text-2xl font-bold text-purple-400 mt-1">{{ number_format(\App\Models\Article::sum('views')) }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-500/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-eye text-purple-500 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-gray-800 rounded-xl p-6 border border-gray-700 mb-6">
        <form action="{{ route('admin.articles.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Cari Artikel</label>
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Judul, konten..." 
                           class="w-full pl-10 pr-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Kategori</label>
                <select name="category" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    <option value="">Semua Kategori</option>
                    @foreach(\App\Models\Article::CATEGORIES as $key => $label)
                        <option value="{{ $key }}" {{ request('category') == $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Status</label>
                <select name="status" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    <option value="">Semua Status</option>
                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
            </div>
            <div class="flex items-end space-x-2">
                <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                    <i class="fas fa-filter mr-2"></i> Filter
                </button>
                <a href="{{ route('admin.articles.index') }}" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition-colors">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </form>
    </div>

    <!-- Articles Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($articles as $article)
            <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden hover:border-gray-600 transition-colors">
                <!-- Image -->
                <div class="aspect-video bg-gray-900 relative">
                    @if($article->featured_image)
                        <img src="{{ Storage::url($article->featured_image) }}" alt="{{ $article->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center">
                            <i class="fas fa-image text-4xl text-gray-700"></i>
                        </div>
                    @endif
                    
                    <!-- Status Badge -->
                    <div class="absolute top-3 left-3">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $article->is_published ? 'bg-green-500/90 text-white' : 'bg-yellow-500/90 text-white' }}">
                            <i class="fas {{ $article->is_published ? 'fa-check-circle' : 'fa-file-alt' }} mr-1"></i>
                            {{ $article->is_published ? 'Published' : 'Draft' }}
                        </span>
                    </div>

                    <!-- Category Badge -->
                    <div class="absolute top-3 right-3">
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-500/90 text-white">
                            {{ $article->category_name }}
                        </span>
                    </div>
                </div>

                <!-- Content -->
                <div class="p-4">
                    <h3 class="text-lg font-semibold text-white mb-2 line-clamp-2">{{ $article->title }}</h3>
                    <p class="text-gray-400 text-sm mb-4 line-clamp-2">{{ $article->excerpt }}</p>
                    
                    <!-- Meta -->
                    <div class="flex items-center justify-between text-xs text-gray-500 mb-4">
                        <div class="flex items-center space-x-4">
                            <span><i class="fas fa-eye mr-1"></i> {{ number_format($article->views) }}</span>
                            <span><i class="fas fa-clock mr-1"></i> {{ $article->reading_time }} min</span>
                        </div>
                        <span>{{ $article->published_at?->format('d M Y') ?? $article->created_at->format('d M Y') }}</span>
                    </div>

                    <!-- Author -->
                    <div class="flex items-center justify-between pt-4 border-t border-gray-700">
                        <div class="flex items-center">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                                <span class="text-xs font-medium text-white">{{ substr($article->author->name ?? 'A', 0, 1) }}</span>
                            </div>
                            <span class="ml-2 text-sm text-gray-400">{{ $article->author->name ?? 'Admin' }}</span>
                        </div>
                        
                        <!-- Actions -->
                        <div class="flex items-center space-x-1">
                            <a href="{{ route('admin.articles.show', $article) }}" 
                               class="p-2 text-gray-400 hover:text-blue-400 hover:bg-gray-700 rounded-lg transition-colors" title="Lihat">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.articles.edit', $article) }}" 
                               class="p-2 text-gray-400 hover:text-yellow-400 hover:bg-gray-700 rounded-lg transition-colors" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.articles.toggle-publish', $article) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <button type="submit" 
                                        class="p-2 text-gray-400 hover:text-{{ $article->is_published ? 'yellow' : 'green' }}-400 hover:bg-gray-700 rounded-lg transition-colors" 
                                        title="{{ $article->is_published ? 'Unpublish' : 'Publish' }}">
                                    <i class="fas {{ $article->is_published ? 'fa-eye-slash' : 'fa-paper-plane' }}"></i>
                                </button>
                            </form>
                            <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="inline"
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-gray-400 hover:text-red-400 hover:bg-gray-700 rounded-lg transition-colors" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full">
                <div class="bg-gray-800 rounded-xl p-12 text-center border border-gray-700">
                    <div class="w-16 h-16 bg-gray-700 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-newspaper text-gray-500 text-2xl"></i>
                    </div>
                    <p class="text-gray-400 mb-4">Belum ada artikel</p>
                    <a href="{{ route('admin.articles.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                        <i class="fas fa-plus mr-2"></i> Buat Artikel Pertama
                    </a>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    @if($articles->hasPages())
        <div class="mt-6">
            {{ $articles->links() }}
        </div>
    @endif
</x-admin-layout>
