<x-admin-layout>
    <x-slot name="header">Detail Produk</x-slot>

    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-white">{{ $product->name }}</h2>
            <p class="text-gray-400 mt-1">SKU: {{ $product->sku }}</p>
        </div>
        <div class="mt-4 md:mt-0 flex items-center space-x-3">
            <a href="{{ route('admin.products.edit', $product) }}" 
               class="inline-flex items-center px-4 py-2 bg-yellow-600 hover:bg-yellow-700 text-white rounded-lg font-medium transition-colors">
                <i class="fas fa-edit mr-2"></i> Edit
            </a>
            <a href="{{ route('admin.products.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-medium transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Product Image & Basic Info -->
            <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <!-- Image -->
                    <div class="aspect-square bg-gray-900 flex items-center justify-center">
                        @if($product->image)
                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                        @else
                            <div class="text-center">
                                <i class="fas fa-pills text-6xl text-gray-600"></i>
                                <p class="text-gray-500 mt-2">No Image</p>
                            </div>
                        @endif
                    </div>
                    
                    <!-- Info -->
                    <div class="p-6">
                        <div class="flex items-center space-x-2 mb-4">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $product->is_active ? 'bg-green-500/20 text-green-400' : 'bg-red-500/20 text-red-400' }}">
                                <i class="fas {{ $product->is_active ? 'fa-check-circle' : 'fa-times-circle' }} mr-1"></i>
                                {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                            @if($product->is_featured)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-500/20 text-yellow-400">
                                    <i class="fas fa-star mr-1"></i> Unggulan
                                </span>
                            @endif
                            @if($product->requires_prescription)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-500/20 text-purple-400">
                                    <i class="fas fa-prescription mr-1"></i> Resep
                                </span>
                            @endif
                        </div>

                        <h3 class="text-xl font-bold text-white mb-2">{{ $product->name }}</h3>
                        <p class="text-gray-400 text-sm mb-4">{{ $product->category_name }}</p>

                        <!-- Price -->
                        <div class="mb-6">
                            @if($product->discount_price)
                                <div class="flex items-baseline space-x-2">
                                    <span class="text-3xl font-bold text-green-400">Rp {{ number_format($product->discount_price, 0, ',', '.') }}</span>
                                    <span class="text-lg text-gray-500 line-through">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                </div>
                                <p class="text-sm text-green-400 mt-1">
                                    <i class="fas fa-tag mr-1"></i>
                                    Hemat {{ round((($product->price - $product->discount_price) / $product->price) * 100) }}%
                                </p>
                            @else
                                <span class="text-3xl font-bold text-white">{{ $product->formatted_price }}</span>
                            @endif
                            <span class="text-gray-400 text-sm ml-1">/ {{ $product->unit }}</span>
                        </div>

                        <!-- Stock Status -->
                        <div class="p-4 rounded-lg {{ $product->stock == 0 ? 'bg-red-500/10 border border-red-500/30' : ($product->stock <= $product->min_stock ? 'bg-yellow-500/10 border border-yellow-500/30' : 'bg-green-500/10 border border-green-500/30') }}">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    @if($product->stock == 0)
                                        <i class="fas fa-times-circle text-red-400 mr-2"></i>
                                        <span class="text-red-400 font-medium">Stok Habis</span>
                                    @elseif($product->stock <= $product->min_stock)
                                        <i class="fas fa-exclamation-triangle text-yellow-400 mr-2"></i>
                                        <span class="text-yellow-400 font-medium">Stok Menipis</span>
                                    @else
                                        <i class="fas fa-check-circle text-green-400 mr-2"></i>
                                        <span class="text-green-400 font-medium">Stok Tersedia</span>
                                    @endif
                                </div>
                                <span class="text-2xl font-bold {{ $product->stock == 0 ? 'text-red-400' : ($product->stock <= $product->min_stock ? 'text-yellow-400' : 'text-green-400') }}">
                                    {{ $product->stock }} {{ $product->unit }}
                                </span>
                            </div>
                            <p class="text-xs text-gray-400 mt-2">Min. stock: {{ $product->min_stock }} {{ $product->unit }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Description -->
            <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                    <i class="fas fa-align-left text-blue-500 mr-2"></i>
                    Deskripsi
                </h3>
                
                @if($product->short_description)
                    <div class="p-4 bg-gray-700/50 rounded-lg mb-4">
                        <p class="text-gray-300 italic">{{ $product->short_description }}</p>
                    </div>
                @endif

                <div class="prose prose-invert max-w-none">
                    <p class="text-gray-300 whitespace-pre-line">{{ $product->description }}</p>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Product Details -->
            <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                    <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                    Informasi Produk
                </h3>
                
                <dl class="space-y-4">
                    <div class="flex justify-between">
                        <dt class="text-gray-400">SKU</dt>
                        <dd class="text-white font-mono">{{ $product->sku }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-400">Kategori</dt>
                        <dd class="text-white">{{ $product->category_name }}</dd>
                    </div>
                    @if($product->manufacturer)
                        <div class="flex justify-between">
                            <dt class="text-gray-400">Manufacturer</dt>
                            <dd class="text-white">{{ $product->manufacturer }}</dd>
                        </div>
                    @endif
                    @if($product->weight)
                        <div class="flex justify-between">
                            <dt class="text-gray-400">Berat</dt>
                            <dd class="text-white">{{ $product->weight }} gram</dd>
                        </div>
                    @endif
                    @if($product->expiry_date)
                        <div class="flex justify-between">
                            <dt class="text-gray-400">Kadaluarsa</dt>
                            <dd class="{{ $product->expiry_date < now() ? 'text-red-400' : ($product->expiry_date < now()->addMonths(3) ? 'text-yellow-400' : 'text-white') }}">
                                {{ $product->expiry_date->format('d M Y') }}
                            </dd>
                        </div>
                    @endif
                </dl>
            </div>

            <!-- Stock Management -->
            <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                    <i class="fas fa-warehouse text-yellow-500 mr-2"></i>
                    Manajemen Stok
                </h3>
                
                <form action="{{ route('admin.products.update-stock', $product) }}" method="POST" class="space-y-4">
                    @csrf
                    @method('PATCH')
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Tambah/Kurangi Stok</label>
                        <div class="flex items-center space-x-2">
                            <select name="operation" class="px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                                <option value="add">+ Tambah</option>
                                <option value="subtract">- Kurangi</option>
                            </select>
                            <input type="number" name="quantity" min="1" value="1" 
                                   class="flex-1 px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        </div>
                    </div>
                    
                    <button type="submit" class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                        <i class="fas fa-sync-alt mr-2"></i> Update Stok
                    </button>
                </form>
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
                        <dd class="text-white">{{ $product->created_at->format('d M Y, H:i') }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-400">Terakhir diupdate</dt>
                        <dd class="text-white">{{ $product->updated_at->format('d M Y, H:i') }}</dd>
                    </div>
                </dl>
            </div>

            <!-- Danger Zone -->
            <div class="bg-gray-800 rounded-xl p-6 border border-red-500/30">
                <h3 class="text-lg font-semibold text-red-400 mb-4 flex items-center">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    Zona Berbahaya
                </h3>
                
                <form action="{{ route('admin.products.destroy', $product) }}" method="POST"
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini? Tindakan ini tidak dapat dibatalkan.')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-colors">
                        <i class="fas fa-trash mr-2"></i> Hapus Produk
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
