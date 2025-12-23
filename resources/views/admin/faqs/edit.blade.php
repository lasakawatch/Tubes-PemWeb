<x-admin-layout>
    <x-slot name="header">Edit FAQ</x-slot>

    <!-- Page Header -->
    <div class="flex items-center justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-white">Edit FAQ</h2>
            <p class="text-gray-400 mt-1">{{ Str::limit($faq->question, 50) }}</p>
        </div>
        <a href="{{ route('admin.faqs.index') }}" 
           class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-medium transition-colors">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.faqs.update', $faq) }}" method="POST">
        @csrf
        @method('PUT')
        
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
                        <input type="text" name="question" value="{{ old('question', $faq->question) }}" required
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
                                  placeholder="Tulis jawaban yang jelas dan informatif...">{{ old('answer', $faq->answer) }}</textarea>
                        @error('answer')
                            <p class="mt-1 text-sm text-red-400">{{ $message }}</p>
                        @enderror
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
                        <div class="text-center p-3 bg-green-500/10 border border-green-500/30 rounded-lg">
                            <div class="flex items-center justify-center mb-1">
                                <i class="fas fa-thumbs-up text-green-400 mr-2"></i>
                                <p class="text-2xl font-bold text-green-400">{{ $faq->helpful_yes }}</p>
                            </div>
                            <p class="text-xs text-gray-400">Helpful</p>
                        </div>
                        <div class="text-center p-3 bg-red-500/10 border border-red-500/30 rounded-lg">
                            <div class="flex items-center justify-center mb-1">
                                <i class="fas fa-thumbs-down text-red-400 mr-2"></i>
                                <p class="text-2xl font-bold text-red-400">{{ $faq->helpful_no }}</p>
                            </div>
                            <p class="text-xs text-gray-400">Not Helpful</p>
                        </div>
                    </div>
                </div>

                <!-- Category -->
                <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-folder text-yellow-500 mr-2"></i>
                        Kategori
                    </h3>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-400 mb-2">Pilih Kategori <span class="text-red-500">*</span></label>
                        <select name="category" required
                                class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                            @foreach(\App\Models\Faq::CATEGORIES as $key => $label)
                                <option value="{{ $key }}" {{ old('category', $faq->category) == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
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
                            <input type="number" name="order" value="{{ old('order', $faq->order) }}" min="0"
                                   class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                                   placeholder="0">
                        </div>

                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1" {{ old('is_active', $faq->is_active) ? 'checked' : '' }}
                                   class="w-4 h-4 rounded border-gray-600 bg-gray-700 text-blue-600 focus:ring-blue-500 focus:ring-offset-gray-800">
                            <span class="ml-2 text-gray-300">Aktifkan FAQ</span>
                        </label>
                    </div>
                </div>

                <!-- Timestamps -->
                <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-clock text-gray-500 mr-2"></i>
                        Riwayat
                    </h3>
                    
                    <dl class="space-y-3 text-sm">
                        <div>
                            <dt class="text-gray-400">Dibuat</dt>
                            <dd class="text-white">{{ $faq->created_at->format('d M Y, H:i') }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-400">Terakhir diupdate</dt>
                            <dd class="text-white">{{ $faq->updated_at->format('d M Y, H:i') }}</dd>
                        </div>
                    </dl>
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
                    
                    <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST"
                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus FAQ ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-colors">
                            <i class="fas fa-trash mr-2"></i> Hapus FAQ
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </form>
</x-admin-layout>
