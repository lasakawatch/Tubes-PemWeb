<x-admin-layout>
    <x-slot name="header">Tambah Produk</x-slot>

    <!-- Page Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-white">Tambah Produk Baru</h2>
            <p class="text-gray-400 mt-1">Isi informasi produk dengan lengkap</p>
        </div>
        <a href="{{ route('admin.products.index') }}" 
           class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-medium transition-colors">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Basic Info -->
                <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                        Informasi Dasar
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-400 mb-2">Nama Produk <span class="text-red-500">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}" required
                                   class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('name') border-red-500 @enderror"
                                   placeholder="Contoh: Paracetamol 500mg">
                            @error('name')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">SKU <span class="text-red-500">*</span></label>
                            <input type="text" name="sku" value="{{ old('sku') }}" required
                                   class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('sku') border-red-500 @enderror"
                                   placeholder="Contoh: MED-001">
                            @error('sku')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Kategori <span class="text-red-500">*</span></label>
                            <select name="category" required
                                    class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('category') border-red-500 @enderror">
                                <option value="">Pilih Kategori</option>
                                @foreach(\App\Models\Product::CATEGORIES as $key => $label)
                                    <option value="{{ $key }}" {{ old('category') == $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('category')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-400 mb-2">Deskripsi <span class="text-red-500">*</span></label>
                            <textarea name="description" rows="4" required
                                      class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('description') border-red-500 @enderror"
                                      placeholder="Deskripsi lengkap produk...">{{ old('description') }}</textarea>
                            @error('description')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-400 mb-2">Deskripsi Singkat</label>
                            <input type="text" name="short_description" value="{{ old('short_description') }}"
                                   class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                                   placeholder="Deskripsi singkat untuk preview">
                        </div>
                    </div>
                </div>

                <!-- Pricing -->
                <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-tags text-green-500 mr-2"></i>
                        Harga & Diskon
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Harga (Rp) <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">Rp</span>
                                <input type="number" name="price" value="{{ old('price') }}" required min="0"
                                       class="w-full pl-12 pr-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('price') border-red-500 @enderror"
                                       placeholder="0">
                            </div>
                            @error('price')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Harga Diskon (Rp)</label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">Rp</span>
                                <input type="number" name="discount_price" value="{{ old('discount_price') }}" min="0"
                                       class="w-full pl-12 pr-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                                       placeholder="0">
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Kosongkan jika tidak ada diskon</p>
                        </div>
                    </div>
                </div>

                <!-- Inventory -->
                <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-warehouse text-yellow-500 mr-2"></i>
                        Inventaris
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Stok <span class="text-red-500">*</span></label>
                            <input type="number" name="stock" value="{{ old('stock', 0) }}" required min="0"
                                   class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('stock') border-red-500 @enderror"
                                   placeholder="0">
                            @error('stock')
                                <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Stok Minimum</label>
                            <input type="number" name="min_stock" value="{{ old('min_stock', 10) }}" min="0"
                                   class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                                   placeholder="10">
                            <p class="mt-1 text-xs text-gray-500">Alert ketika stok mencapai level ini</p>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Satuan</label>
                            <input type="text" name="unit" value="{{ old('unit', 'pcs') }}"
                                   class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                                   placeholder="pcs, box, botol">
                        </div>
                    </div>
                </div>

                <!-- Additional Info -->
                <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-clipboard-list text-purple-500 mr-2"></i>
                        Informasi Tambahan
                    </h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Merek/Manufacturer</label>
                            <input type="text" name="manufacturer" value="{{ old('manufacturer') }}"
                                   class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                                   placeholder="Contoh: Kimia Farma">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Tanggal Kadaluarsa</label>
                            <input type="date" name="expiry_date" value="{{ old('expiry_date') }}"
                                   class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                        </div>

                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-400 mb-2">Berat (gram)</label>
                            <input type="number" name="weight" value="{{ old('weight') }}" min="0" step="0.01"
                                   class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                                   placeholder="Berat untuk kalkulasi ongkir">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Status -->
                <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-toggle-on text-blue-500 mr-2"></i>
                        Status Produk
                    </h3>
                    
                    <div class="space-y-4">
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                   class="w-4 h-4 rounded border-gray-600 bg-gray-700 text-blue-600 focus:ring-blue-500 focus:ring-offset-gray-800">
                            <span class="ml-2 text-gray-300">Produk Aktif</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                                   class="w-4 h-4 rounded border-gray-600 bg-gray-700 text-blue-600 focus:ring-blue-500 focus:ring-offset-gray-800">
                            <span class="ml-2 text-gray-300">Produk Unggulan</span>
                        </label>
                        <label class="flex items-center">
                            <input type="checkbox" name="requires_prescription" value="1" {{ old('requires_prescription') ? 'checked' : '' }}
                                   class="w-4 h-4 rounded border-gray-600 bg-gray-700 text-blue-600 focus:ring-blue-500 focus:ring-offset-gray-800">
                            <span class="ml-2 text-gray-300">Butuh Resep Dokter</span>
                        </label>
                    </div>
                </div>

                <!-- Image Upload -->
                <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-image text-pink-500 mr-2"></i>
                        Gambar Produk
                    </h3>
                    
                    <div x-data="{ preview: null }">
                        <div class="relative">
                            <div class="w-full aspect-square bg-gray-700 rounded-lg border-2 border-dashed border-gray-600 flex items-center justify-center overflow-hidden"
                                 :class="{ 'border-blue-500': preview }">
                                <template x-if="!preview">
                                    <div class="text-center p-4">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-500 mb-2"></i>
                                        <p class="text-sm text-gray-400">Klik atau drag untuk upload</p>
                                        <p class="text-xs text-gray-500 mt-1">PNG, JPG max 2MB</p>
                                    </div>
                                </template>
                                <template x-if="preview">
                                    <img :src="preview" class="w-full h-full object-cover">
                                </template>
                            </div>
                            <input type="file" name="image" accept="image/*" 
                                   @change="preview = URL.createObjectURL($event.target.files[0])"
                                   class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                        </div>
                        @error('image')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Submit -->
                <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                    <button type="submit" 
                            class="w-full px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-lg font-medium transition-all shadow-lg hover:shadow-blue-500/25">
                        <i class="fas fa-save mr-2"></i> Simpan Produk
                    </button>
                </div>
            </div>
        </div>
    </form>
</x-admin-layout>
