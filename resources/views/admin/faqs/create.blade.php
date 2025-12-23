<x-admin-layout>
    <x-slot name="header">Tambah FAQ</x-slot>

    <!-- Page Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-white">Tambah FAQ Baru</h2>
            <p class="text-gray-400 mt-1">Buat pertanyaan dan jawaban yang sering diajukan</p>
        </div>
        <a href="{{ route('admin.faqs.index') }}" 
           class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-medium transition-colors">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.faqs.store') }}" method="POST">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Question -->
                <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-question text-blue-500 mr-2"></i>
                        Pertanyaan
                    </h3>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Pertanyaan <span class="text-red-500">*</span></label>
                        <input type="text" name="question" value="{{ old('question') }}" required
                               class="w-full px-4 py-3 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('question') border-red-500 @enderror"
                               placeholder="Contoh: Bagaimana cara melakukan pemesanan?">
                        @error('question')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Answer -->
                <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-comment-dots text-green-500 mr-2"></i>
                        Jawaban
                    </h3>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Jawaban <span class="text-red-500">*</span></label>
                        <textarea name="answer" rows="8" required
                                  class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('answer') border-red-500 @enderror"
                                  placeholder="Tulis jawaban yang jelas dan informatif...">{{ old('answer') }}</textarea>
                        @error('answer')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                        <p class="mt-2 text-xs text-gray-500">Tips: Berikan jawaban yang detail dan mudah dipahami oleh pengguna.</p>
                    </div>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Category -->
                <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-folder text-yellow-500 mr-2"></i>
                        Kategori
                    </h3>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Pilih Kategori <span class="text-red-500">*</span></label>
                        <select name="category" required
                                class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 @error('category') border-red-500 @enderror">
                            <option value="">Pilih Kategori</option>
                            @foreach(\App\Models\Faq::CATEGORIES as $key => $label)
                                <option value="{{ $key }}" {{ old('category') == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <!-- Settings -->
                <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-cog text-purple-500 mr-2"></i>
                        Pengaturan
                    </h3>
                    
                    <div class="space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-400 mb-2">Urutan</label>
                            <input type="number" name="order" value="{{ old('order', 0) }}" min="0"
                                   class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                                   placeholder="0">
                            <p class="mt-1 text-xs text-gray-500">Semakin kecil, semakin atas posisinya</p>
                        </div>

                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                                   class="w-4 h-4 rounded border-gray-600 bg-gray-700 text-blue-600 focus:ring-blue-500 focus:ring-offset-gray-800">
                            <span class="ml-2 text-gray-300">Aktifkan FAQ</span>
                        </label>
                    </div>
                </div>

                <!-- Preview -->
                <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-eye text-blue-500 mr-2"></i>
                        Preview
                    </h3>
                    
                    <div x-data="{ open: false }" class="border border-gray-700 rounded-lg overflow-hidden">
                        <button type="button" @click="open = !open" 
                                class="w-full flex items-center justify-between p-4 text-left bg-gray-700/50 hover:bg-gray-700 transition-colors">
                            <span class="text-white font-medium text-sm" x-text="$refs.questionInput?.value || 'Pertanyaan akan muncul di sini'"></span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform" :class="{ 'rotate-180': open }"></i>
                        </button>
                        <div x-show="open" x-collapse class="p-4 bg-gray-900/50">
                            <p class="text-gray-300 text-sm" x-text="$refs.answerInput?.value || 'Jawaban akan muncul di sini'"></p>
                        </div>
                    </div>
                </div>

                <!-- Submit -->
                <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                    <button type="submit" 
                            class="w-full px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-lg font-medium transition-all shadow-lg hover:shadow-blue-500/25">
                        <i class="fas fa-save mr-2"></i> Simpan FAQ
                    </button>
                </div>
            </div>
        </div>
    </form>
</x-admin-layout>
