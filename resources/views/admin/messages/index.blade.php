<x-admin-layout>
    <x-slot name="header">Pesan Masuk</x-slot>

    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-white">Pesan dari Pelanggan</h2>
            <p class="text-gray-400 mt-1">Kelola semua pesan yang masuk dari form kontak</p>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="grid grid-cols-2 md:grid-cols-5 gap-4 mb-6">
        <div class="bg-gray-800 rounded-xl p-4 border border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-xs">Total</p>
                    <p class="text-xl font-bold text-white">{{ $stats['total'] ?? 0 }}</p>
                </div>
                <div class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-envelope text-blue-500"></i>
                </div>
            </div>
        </div>
        <div class="bg-gray-800 rounded-xl p-4 border border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-xs">Belum Dibaca</p>
                    <p class="text-xl font-bold text-red-400">{{ $stats['unread'] ?? 0 }}</p>
                </div>
                <div class="w-10 h-10 bg-red-500/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-envelope-open text-red-500"></i>
                </div>
            </div>
        </div>
        <div class="bg-gray-800 rounded-xl p-4 border border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-xs">Sudah Dibaca</p>
                    <p class="text-xl font-bold text-yellow-400">{{ $stats['read'] ?? 0 }}</p>
                </div>
                <div class="w-10 h-10 bg-yellow-500/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-eye text-yellow-500"></i>
                </div>
            </div>
        </div>
        <div class="bg-gray-800 rounded-xl p-4 border border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-xs">Dibalas</p>
                    <p class="text-xl font-bold text-green-400">{{ $stats['replied'] ?? 0 }}</p>
                </div>
                <div class="w-10 h-10 bg-green-500/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-reply text-green-500"></i>
                </div>
            </div>
        </div>
        <div class="bg-gray-800 rounded-xl p-4 border border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-xs">Urgent</p>
                    <p class="text-xl font-bold text-orange-400">{{ $stats['urgent'] ?? 0 }}</p>
                </div>
                <div class="w-10 h-10 bg-orange-500/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-exclamation-circle text-orange-500"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-gray-800 rounded-xl p-6 border border-gray-700 mb-6">
        <form action="{{ route('admin.messages.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Cari</label>
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Nama, email, subjek..." 
                           class="w-full pl-10 pr-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Status</label>
                <select name="status" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    <option value="">Semua Status</option>
                    <option value="unread" {{ request('status') == 'unread' ? 'selected' : '' }}>Belum Dibaca</option>
                    <option value="read" {{ request('status') == 'read' ? 'selected' : '' }}>Sudah Dibaca</option>
                    <option value="replied" {{ request('status') == 'replied' ? 'selected' : '' }}>Dibalas</option>
                    <option value="archived" {{ request('status') == 'archived' ? 'selected' : '' }}>Diarsipkan</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Prioritas</label>
                <select name="priority" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    <option value="">Semua Prioritas</option>
                    <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Rendah</option>
                    <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Sedang</option>
                    <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>Tinggi</option>
                    <option value="urgent" {{ request('priority') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Tanggal</label>
                <input type="date" name="date" value="{{ request('date') }}"
                       class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
            </div>
            <div class="flex items-end space-x-2">
                <button type="submit" class="flex-1 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                    <i class="fas fa-filter mr-2"></i> Filter
                </button>
                <a href="{{ route('admin.messages.index') }}" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition-colors">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </form>
    </div>

    <!-- Bulk Actions -->
    <div class="bg-gray-800 rounded-xl p-4 border border-gray-700 mb-6" x-data="{ selectedMessages: [] }">
        <form action="{{ route('admin.messages.bulk-action') }}" method="POST" class="flex items-center space-x-4">
            @csrf
            <div class="flex items-center space-x-4">
                <select name="action" class="px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    <option value="">Pilih Aksi</option>
                    <option value="mark_read">Tandai Dibaca</option>
                    <option value="mark_unread">Tandai Belum Dibaca</option>
                    <option value="archive">Arsipkan</option>
                    <option value="delete">Hapus</option>
                </select>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                    Terapkan
                </button>
            </div>
            <span class="text-sm text-gray-400">Pilih pesan dari tabel untuk melakukan aksi massal</span>
        </form>
    </div>

    <!-- Messages Table -->
    <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-900/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider w-12">
                            <input type="checkbox" class="w-4 h-4 rounded border-gray-600 bg-gray-700 text-blue-600">
                        </th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Pengirim</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Pesan</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Prioritas</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @forelse($messages as $message)
                        <tr class="hover:bg-gray-700/50 transition-colors {{ $message->status == 'unread' ? 'bg-blue-500/5' : '' }}">
                            <td class="px-6 py-4">
                                <input type="checkbox" name="message_ids[]" value="{{ $message->id }}" 
                                       class="w-4 h-4 rounded border-gray-600 bg-gray-700 text-blue-600">
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center flex-shrink-0">
                                        <span class="text-sm font-medium text-white">{{ substr($message->name, 0, 1) }}</span>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-white {{ $message->status == 'unread' ? 'font-bold' : '' }}">
                                            {{ $message->name }}
                                        </p>
                                        <p class="text-xs text-gray-400">{{ $message->email }}</p>
                                        @if($message->phone)
                                            <p class="text-xs text-gray-500">{{ $message->phone }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div>
                                    <p class="text-sm font-medium text-white {{ $message->status == 'unread' ? 'font-bold' : '' }}">
                                        {{ $message->subject }}
                                    </p>
                                    <p class="text-xs text-gray-400 line-clamp-2">{{ Str::limit($message->message, 80) }}</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $priorityColors = [
                                        'low' => 'bg-gray-500/20 text-gray-400',
                                        'medium' => 'bg-blue-500/20 text-blue-400',
                                        'high' => 'bg-orange-500/20 text-orange-400',
                                        'urgent' => 'bg-red-500/20 text-red-400',
                                    ];
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $priorityColors[$message->priority] ?? $priorityColors['medium'] }}">
                                    @if($message->priority == 'urgent')
                                        <i class="fas fa-exclamation-circle mr-1"></i>
                                    @endif
                                    {{ ucfirst($message->priority) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                @php
                                    $statusColors = [
                                        'unread' => 'bg-red-500/20 text-red-400',
                                        'read' => 'bg-yellow-500/20 text-yellow-400',
                                        'replied' => 'bg-green-500/20 text-green-400',
                                        'archived' => 'bg-gray-500/20 text-gray-400',
                                    ];
                                    $statusIcons = [
                                        'unread' => 'fa-envelope',
                                        'read' => 'fa-envelope-open',
                                        'replied' => 'fa-reply',
                                        'archived' => 'fa-archive',
                                    ];
                                @endphp
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$message->status] ?? $statusColors['unread'] }}">
                                    <i class="fas {{ $statusIcons[$message->status] ?? 'fa-envelope' }} mr-1"></i>
                                    {{ ucfirst($message->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-400">{{ $message->created_at->format('d M Y') }}</p>
                                <p class="text-xs text-gray-500">{{ $message->created_at->format('H:i') }}</p>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('admin.messages.show', $message) }}" 
                                       class="p-2 text-gray-400 hover:text-blue-400 hover:bg-gray-700 rounded-lg transition-colors" title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.messages.destroy', $message) }}" method="POST" class="inline"
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
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
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-inbox text-gray-500 text-2xl"></i>
                                    </div>
                                    <p class="text-gray-400">Belum ada pesan masuk</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($messages->hasPages())
            <div class="px-6 py-4 border-t border-gray-700">
                {{ $messages->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
