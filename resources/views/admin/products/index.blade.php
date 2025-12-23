<x-admin-layout>
    <x-slot name="header">Kelola Produk</x-slot>

    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-white">Daftar Produk</h2>
            <p class="text-gray-400 mt-1">Kelola semua produk kesehatan Anda</p>
        </div>
        <a href="{{ route('admin.products.create') }}" 
           class="mt-4 md:mt-0 inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-lg font-medium transition-all shadow-lg hover:shadow-blue-500/25">
            <i class="fas fa-plus mr-2"></i> Tambah Produk
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Total Produk</p>
                    <p class="text-2xl font-bold text-white mt-1">{{ $products->total() }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-500/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-boxes text-blue-500 text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Produk Aktif</p>
                    <p class="text-2xl font-bold text-green-400 mt-1">{{ \App\Models\Product::where('is_active', true)->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-green-500/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-500 text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Stok Menipis</p>
                    <p class="text-2xl font-bold text-yellow-400 mt-1">{{ \App\Models\Product::whereRaw('stock <= min_stock')->where('stock', '>', 0)->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-yellow-500/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-exclamation-triangle text-yellow-500 text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Stok Habis</p>
                    <p class="text-2xl font-bold text-red-400 mt-1">{{ \App\Models\Product::where('stock', 0)->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-red-500/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-times-circle text-red-500 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-gray-800 rounded-xl p-6 border border-gray-700 mb-6">
        <form action="{{ route('admin.products.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Cari Produk</label>
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Nama, SKU, deskripsi..." 
                           class="w-full pl-10 pr-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Kategori</label>
                <select name="category" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    <option value="">Semua Kategori</option>
                    @foreach(\App\Models\Product::CATEGORIES as $key => $label)
                        <option value="{{ $key }}" {{ request('category') == $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Status</label>
                <select name="status" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    <option value="">Semua Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                    <option value="low_stock" {{ request('status') == 'low_stock' ? 'selected' : '' }}>Stok Menipis</option>
                    <option value="out_of_stock" {{ request('status') == 'out_of_stock' ? 'selected' : '' }}>Stok Habis</option>
                </select>
            </div>
            <div class="flex items-end space-x-2">
                <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                    <i class="fas fa-filter mr-2"></i> Filter
                </button>
                <a href="{{ route('admin.products.index') }}" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition-colors">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </form>
    </div>

    <!-- Products Table -->
    <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-900/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Produk</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Stok</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @forelse($products as $product)
                        <tr class="hover:bg-gray-700/50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 bg-gray-700 rounded-lg flex items-center justify-center overflow-hidden flex-shrink-0">
                                        @if($product->image)
                                            <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                                        @else
                                            <i class="fas fa-pills text-gray-500"></i>
                                        @endif
                                    </div>
                                    <div class="ml-4">
                                        <p class="text-sm font-medium text-white">{{ $product->name }}</p>
                                        <p class="text-xs text-gray-400">SKU: {{ $product->sku }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-700 text-gray-300">
                                    {{ $product->category_name }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="text-sm font-medium text-white">{{ $product->formatted_price }}</p>
                                    @if($product->discount_price)
                                        <p class="text-xs text-gray-400 line-through">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    @if($product->stock == 0)
                                        <span class="text-sm font-medium text-red-400">Habis</span>
                                    @elseif($product->stock <= $product->min_stock)
                                        <span class="text-sm font-medium text-yellow-400">{{ $product->stock }} unit</span>
                                        <i class="fas fa-exclamation-triangle text-yellow-400 ml-2 text-xs"></i>
                                    @else
                                        <span class="text-sm font-medium text-green-400">{{ $product->stock }} unit</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <form action="{{ route('admin.products.toggle-status', $product) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium transition-colors {{ $product->is_active ? 'bg-green-500/20 text-green-400 hover:bg-green-500/30' : 'bg-red-500/20 text-red-400 hover:bg-red-500/30' }}">
                                        <i class="fas {{ $product->is_active ? 'fa-check-circle' : 'fa-times-circle' }} mr-1"></i>
                                        {{ $product->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('admin.products.show', $product) }}" 
                                       class="p-2 text-gray-400 hover:text-blue-400 hover:bg-gray-700 rounded-lg transition-colors" title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.products.edit', $product) }}" 
                                       class="p-2 text-gray-400 hover:text-yellow-400 hover:bg-gray-700 rounded-lg transition-colors" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-gray-400 hover:text-red-400 hover:bg-gray-700 rounded-lg transition-colors" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-box-open text-gray-500 text-2xl"></i>
                                    </div>
                                    <p class="text-gray-400 mb-2">Belum ada produk</p>
                                    <a href="{{ route('admin.products.create') }}" class="text-blue-500 hover:text-blue-400">
                                        <i class="fas fa-plus mr-1"></i> Tambah Produk Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($products->hasPages())
            <div class="px-6 py-4 border-t border-gray-700">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
