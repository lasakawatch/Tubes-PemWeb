<x-admin-layout>
    <x-slot name="header">Preview Artikel</x-slot>

    <!-- Page Header -->
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center space-x-4">
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $article->is_published ? 'bg-green-500/20 text-green-400' : 'bg-yellow-500/20 text-yellow-400' }}">
                <i class="fas {{ $article->is_published ? 'fa-check-circle' : 'fa-file-alt' }} mr-1"></i>
                {{ $article->is_published ? 'Published' : 'Draft' }}
            </span>
            <span class="text-gray-400">{{ $article->category_name }}</span>
        </div>
        <div class="flex items-center space-x-3">
            <a href="{{ route('admin.articles.edit', $article) }}" 
               class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg font-medium transition-colors">
                <i class="fas fa-edit mr-2"></i> Edit
            </a>
            <a href="{{ route('admin.articles.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-medium transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Featured Image -->
            @if($article->featured_image)
                <div class="bg-gray-800 rounded-xl overflow-hidden border border-gray-700">
                    <img src="{{ Storage::url($article->featured_image) }}" alt="{{ $article->title }}" class="w-full aspect-video object-cover">
                </div>
            @endif

            <!-- Article Content -->
            <div class="bg-gray-800 rounded-xl p-8 border border-gray-700">
                <h1 class="text-3xl font-bold text-white mb-4">{{ $article->title }}</h1>
                
                <!-- Meta -->
                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-400 mb-6 pb-6 border-b border-gray-700">
                    <div class="flex items-center">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center mr-2">
                            <span class="text-xs font-medium text-white">{{ substr($article->author->name ?? 'A', 0, 1) }}</span>
                        </div>
                        <span>{{ $article->author->name ?? 'Admin' }}</span>
                    </div>
                    <span>•</span>
                    <span><i class="fas fa-calendar mr-1"></i> {{ $article->published_at?->format('d M Y') ?? $article->created_at->format('d M Y') }}</span>
                    <span>•</span>
                    <span><i class="fas fa-clock mr-1"></i> {{ $article->reading_time }} min read</span>
                    <span>•</span>
                    <span><i class="fas fa-eye mr-1"></i> {{ number_format($article->views) }} views</span>
                </div>

                <!-- Excerpt -->
                @if($article->excerpt)
                    <div class="p-4 bg-gray-700/50 rounded-lg mb-6 border-l-4 border-blue-500">
                        <p class="text-gray-300 italic">{{ $article->excerpt }}</p>
                    </div>
                @endif

                <!-- Content -->
                <div class="prose prose-invert prose-lg max-w-none">
                    {!! $article->content !!}
                </div>

                <!-- Tags -->
                @if($article->tags && count($article->tags) > 0)
                    <div class="mt-8 pt-6 border-t border-gray-700">
                        <div class="flex flex-wrap gap-2">
                            @foreach($article->tags as $tag)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm bg-gray-700 text-gray-300">
                                    <i class="fas fa-tag mr-1 text-xs"></i> {{ $tag }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Article Info -->
            <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                    <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                    Informasi Artikel
                </h3>
                
                <dl class="space-y-4">
                    <div class="flex justify-between">
                        <dt class="text-gray-400">Status</dt>
                        <dd>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium {{ $article->is_published ? 'bg-green-500/20 text-green-400' : 'bg-yellow-500/20 text-yellow-400' }}">
                                {{ $article->is_published ? 'Published' : 'Draft' }}
                            </span>
                        </dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-400">Kategori</dt>
                        <dd class="text-white">{{ $article->category_name }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-400">Views</dt>
                        <dd class="text-white">{{ number_format($article->views) }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-400">Reading Time</dt>
                        <dd class="text-white">{{ $article->reading_time }} min</dd>
                    </div>
                </dl>
            </div>

            <!-- Timestamps -->
            <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                    <i class="fas fa-clock text-gray-500 mr-2"></i>
                    Riwayat
                </h3>
                
                <dl class="space-y-4 text-sm">
                    <div>
                        <dt class="text-gray-400">Dibuat</dt>
                        <dd class="text-white">{{ $article->created_at->format('d M Y, H:i') }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-400">Terakhir diupdate</dt>
                        <dd class="text-white">{{ $article->updated_at->format('d M Y, H:i') }}</dd>
                    </div>
                    @if($article->published_at)
                        <div>
                            <dt class="text-gray-400">Dipublish</dt>
                            <dd class="text-white">{{ $article->published_at->format('d M Y, H:i') }}</dd>
                        </div>
                    @endif
                </dl>
            </div>

            <!-- SEO Preview -->
            <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                    <i class="fas fa-search text-purple-500 mr-2"></i>
                    SEO Preview
                </h3>
                
                <div class="p-4 bg-white rounded-lg">
                    <p class="text-blue-700 text-lg hover:underline cursor-pointer">{{ $article->meta_title ?? $article->title }}</p>
                    <p class="text-green-700 text-sm">healthfirst.com/artikel/{{ $article->slug }}</p>
                    <p class="text-gray-600 text-sm mt-1">{{ Str::limit($article->meta_description ?? $article->excerpt ?? strip_tags($article->content), 160) }}</p>
                </div>
            </div>

            <!-- Actions -->
            <div class="bg-gray-800 rounded-xl p-6 border border-gray-700 space-y-3">
                <form action="{{ route('admin.articles.toggle-publish', $article) }}" method="POST">
                    @csrf
                    @method('PATCH')
                    <button type="submit" 
                            class="w-full px-4 py-2 {{ $article->is_published ? 'bg-yellow-600 hover:bg-yellow-700' : 'bg-green-600 hover:bg-green-700' }} text-white rounded-lg font-medium transition-colors">
                        <i class="fas {{ $article->is_published ? 'fa-eye-slash' : 'fa-paper-plane' }} mr-2"></i>
                        {{ $article->is_published ? 'Unpublish' : 'Publish' }}
                    </button>
                </form>
                
                <a href="{{ route('admin.articles.edit', $article) }}" 
                   class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                    <i class="fas fa-edit mr-2"></i> Edit Artikel
                </a>
            </div>
        </div>
    </div>
</x-admin-layout>
