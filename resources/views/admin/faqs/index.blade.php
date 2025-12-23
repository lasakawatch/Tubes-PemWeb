<x-admin-layout>
    <x-slot name="header">Kelola FAQ</x-slot>

    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-white">Daftar FAQ</h2>
            <p class="text-gray-400 mt-1">Kelola pertanyaan yang sering diajukan</p>
        </div>
        <a href="{{ route('admin.faqs.create') }}" 
           class="mt-4 md:mt-0 inline-flex items-center px-4 py-2 bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 text-white rounded-lg font-medium transition-all shadow-lg hover:shadow-blue-500/25">
            <i class="fas fa-plus mr-2"></i> Tambah FAQ
        </a>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
        <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Total FAQ</p>
                    <p class="text-2xl font-bold text-white mt-1">{{ $faqs->total() }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-500/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-question-circle text-blue-500 text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Aktif</p>
                    <p class="text-2xl font-bold text-green-400 mt-1">{{ \App\Models\Faq::where('is_active', true)->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-green-500/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-500 text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Nonaktif</p>
                    <p class="text-2xl font-bold text-red-400 mt-1">{{ \App\Models\Faq::where('is_active', false)->count() }}</p>
                </div>
                <div class="w-12 h-12 bg-red-500/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-times-circle text-red-500 text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-sm">Kategori</p>
                    <p class="text-2xl font-bold text-purple-400 mt-1">{{ count(\App\Models\Faq::CATEGORIES) }}</p>
                </div>
                <div class="w-12 h-12 bg-purple-500/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-folder text-purple-500 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-gray-800 rounded-xl p-6 border border-gray-700 mb-6">
        <form action="{{ route('admin.faqs.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Cari FAQ</label>
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Pertanyaan, jawaban..." 
                           class="w-full pl-10 pr-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Kategori</label>
                <select name="category" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    <option value="">Semua Kategori</option>
                    @foreach(\App\Models\Faq::CATEGORIES as $key => $label)
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
                </select>
            </div>
            <div class="flex items-end space-x-2">
                <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                    <i class="fas fa-filter mr-2"></i> Filter
                </button>
                <a href="{{ route('admin.faqs.index') }}" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition-colors">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </form>
    </div>

    <!-- FAQ List -->
    <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-900/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider w-16">Order</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Pertanyaan</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Kategori</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Helpful</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700" id="faq-sortable">
                    @forelse($faqs as $faq)
                        <tr class="hover:bg-gray-700/50 transition-colors" data-id="{{ $faq->id }}">
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-2">
                                    <span class="cursor-move text-gray-500 hover:text-gray-300">
                                        <i class="fas fa-grip-vertical"></i>
                                    </span>
                                    <span class="text-white font-mono">{{ $faq->order }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div x-data="{ expanded: false }">
                                    <p class="text-sm font-medium text-white mb-1">{{ $faq->question }}</p>
                                    <p class="text-xs text-gray-400" x-show="!expanded">{{ Str::limit(strip_tags($faq->answer), 100) }}</p>
                                    <p class="text-xs text-gray-400" x-show="expanded">{{ strip_tags($faq->answer) }}</p>
                                    @if(strlen(strip_tags($faq->answer)) > 100)
                                        <button @click="expanded = !expanded" class="text-xs text-blue-400 hover:text-blue-300 mt-1">
                                            <span x-text="expanded ? 'Sembunyikan' : 'Selengkapnya'"></span>
                                        </button>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-700 text-gray-300">
                                    {{ $faq->category_name }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-1 text-sm">
                                    <i class="fas fa-thumbs-up text-green-400"></i>
                                    <span class="text-green-400">{{ $faq->helpful_yes }}</span>
                                    <span class="text-gray-500">/</span>
                                    <i class="fas fa-thumbs-down text-red-400"></i>
                                    <span class="text-red-400">{{ $faq->helpful_no }}</span>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <form action="{{ route('admin.faqs.toggle-status', $faq) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium transition-colors {{ $faq->is_active ? 'bg-green-500/20 text-green-400 hover:bg-green-500/30' : 'bg-red-500/20 text-red-400 hover:bg-red-500/30' }}">
                                        <i class="fas {{ $faq->is_active ? 'fa-check-circle' : 'fa-times-circle' }} mr-1"></i>
                                        {{ $faq->is_active ? 'Aktif' : 'Nonaktif' }}
                                    </button>
                                </form>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('admin.faqs.edit', $faq) }}" 
                                       class="p-2 text-gray-400 hover:text-yellow-400 hover:bg-gray-700 rounded-lg transition-colors" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" class="inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus FAQ ini?')">
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
                                        <i class="fas fa-question-circle text-gray-500 text-2xl"></i>
                                    </div>
                                    <p class="text-gray-400 mb-4">Belum ada FAQ</p>
                                    <a href="{{ route('admin.faqs.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                                        <i class="fas fa-plus mr-2"></i> Buat FAQ Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($faqs->hasPages())
            <div class="px-6 py-4 border-t border-gray-700">
                {{ $faqs->links() }}
            </div>
        @endif
    </div>

    <!-- Category Quick View -->
    <div class="mt-6 grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach(\App\Models\Faq::CATEGORIES as $key => $label)
            @php $count = \App\Models\Faq::where('category', $key)->where('is_active', true)->count(); @endphp
            <a href="{{ route('admin.faqs.index', ['category' => $key]) }}" 
               class="bg-gray-800 rounded-xl p-4 border border-gray-700 hover:border-blue-500 transition-colors">
                <div class="flex items-center justify-between">
                    <span class="text-gray-300">{{ $label }}</span>
                    <span class="text-white font-bold">{{ $count }}</span>
                </div>
            </a>
        @endforeach
    </div>
</x-admin-layout>
