<x-admin-layout>
    <x-slot name="header">Detail Pesan</x-slot>

    <!-- Page Header -->
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center space-x-4">
            @php
                $priorityColors = [
                    'low' => 'bg-gray-500/20 text-gray-400',
                    'medium' => 'bg-blue-500/20 text-blue-400',
                    'high' => 'bg-orange-500/20 text-orange-400',
                    'urgent' => 'bg-red-500/20 text-red-400',
                ];
            @endphp
            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $priorityColors[$message->priority] ?? $priorityColors['medium'] }}">
                @if($message->priority == 'urgent')
                    <i class="fas fa-exclamation-circle mr-1"></i>
                @endif
                {{ ucfirst($message->priority) }} Priority
            </span>
        </div>
        <a href="{{ route('admin.messages.index') }}" 
           class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-medium transition-colors">
            <i class="fas fa-arrow-left mr-2"></i> Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Message -->
            <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-700 flex items-center justify-between">
                    <h3 class="text-lg font-semibold text-white">{{ $message->subject }}</h3>
                    <span class="text-sm text-gray-400">{{ $message->created_at->format('d M Y, H:i') }}</span>
                </div>
                
                <div class="p-6">
                    <!-- Sender Info -->
                    <div class="flex items-center mb-6 pb-6 border-b border-gray-700">
                        <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                            <span class="text-lg font-medium text-white">{{ substr($message->name, 0, 1) }}</span>
                        </div>
                        <div class="ml-4">
                            <p class="text-white font-medium">{{ $message->name }}</p>
                            <p class="text-sm text-gray-400">{{ $message->email }}</p>
                            @if($message->phone)
                                <p class="text-sm text-gray-500">{{ $message->phone }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Message Content -->
                    <div class="prose prose-invert max-w-none">
                        <p class="text-gray-300 whitespace-pre-line">{{ $message->message }}</p>
                    </div>
                </div>
            </div>

            <!-- Reply Form -->
            @if($message->status != 'replied')
                <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                    <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                        <i class="fas fa-reply text-blue-500 mr-2"></i>
                        Balas Pesan
                    </h3>
                    
                    <form action="{{ route('admin.messages.reply', $message) }}" method="POST">
                        @csrf
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-2">Subjek</label>
                                <input type="text" name="reply_subject" 
                                       value="Re: {{ $message->subject }}" 
                                       class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-gray-400 mb-2">Balasan <span class="text-red-500">*</span></label>
                                <textarea name="reply_message" rows="6" required
                                          class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500"
                                          placeholder="Tulis balasan Anda di sini..."></textarea>
                            </div>

                            <div class="flex items-center justify-between">
                                <label class="flex items-center">
                                    <input type="checkbox" name="send_email" value="1" checked
                                           class="w-4 h-4 rounded border-gray-600 bg-gray-700 text-blue-600 focus:ring-blue-500 focus:ring-offset-gray-800">
                                    <span class="ml-2 text-sm text-gray-300">Kirim via Email</span>
                                </label>
                                
                                <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                                    <i class="fas fa-paper-plane mr-2"></i> Kirim Balasan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            @else
                <!-- Reply Sent -->
                <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-700 bg-green-500/10">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <h3 class="text-lg font-semibold text-green-400">Balasan Terkirim</h3>
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <div class="flex items-center mb-4">
                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-500 to-emerald-600 flex items-center justify-center">
                                <span class="text-sm font-medium text-white">{{ substr($message->repliedBy->name ?? 'A', 0, 1) }}</span>
                            </div>
                            <div class="ml-3">
                                <p class="text-white font-medium">{{ $message->repliedBy->name ?? 'Admin' }}</p>
                                <p class="text-xs text-gray-400">{{ $message->replied_at?->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                        
                        <div class="prose prose-invert max-w-none">
                            <p class="text-gray-300 whitespace-pre-line">{{ $message->reply_message }}</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Status -->
            <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                    <i class="fas fa-info-circle text-blue-500 mr-2"></i>
                    Status
                </h3>
                
                @php
                    $statusColors = [
                        'unread' => 'bg-red-500/20 text-red-400 border-red-500/30',
                        'read' => 'bg-yellow-500/20 text-yellow-400 border-yellow-500/30',
                        'replied' => 'bg-green-500/20 text-green-400 border-green-500/30',
                        'archived' => 'bg-gray-500/20 text-gray-400 border-gray-500/30',
                    ];
                    $statusLabels = [
                        'unread' => 'Belum Dibaca',
                        'read' => 'Sudah Dibaca',
                        'replied' => 'Sudah Dibalas',
                        'archived' => 'Diarsipkan',
                    ];
                @endphp
                
                <div class="p-4 rounded-lg border {{ $statusColors[$message->status] ?? $statusColors['unread'] }}">
                    <div class="flex items-center">
                        <i class="fas {{ $message->status == 'replied' ? 'fa-check-double' : ($message->status == 'read' ? 'fa-eye' : 'fa-envelope') }} text-2xl mr-3"></i>
                        <div>
                            <p class="font-medium">{{ $statusLabels[$message->status] ?? 'Unknown' }}</p>
                            <p class="text-xs opacity-70">{{ $message->updated_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>

                <!-- Update Status -->
                <form action="{{ route('admin.messages.update-status', $message) }}" method="POST" class="mt-4">
                    @csrf
                    @method('PATCH')
                    <label class="block text-sm font-medium text-gray-400 mb-2">Update Status</label>
                    <div class="flex space-x-2">
                        <select name="status" class="flex-1 px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                            <option value="unread" {{ $message->status == 'unread' ? 'selected' : '' }}>Belum Dibaca</option>
                            <option value="read" {{ $message->status == 'read' ? 'selected' : '' }}>Sudah Dibaca</option>
                            <option value="replied" {{ $message->status == 'replied' ? 'selected' : '' }}>Sudah Dibalas</option>
                            <option value="archived" {{ $message->status == 'archived' ? 'selected' : '' }}>Diarsipkan</option>
                        </select>
                        <button type="submit" class="px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                            <i class="fas fa-save"></i>
                        </button>
                    </div>
                </form>

                <!-- Update Priority -->
                <form action="{{ route('admin.messages.update-status', $message) }}" method="POST" class="mt-4">
                    @csrf
                    @method('PATCH')
                    <label class="block text-sm font-medium text-gray-400 mb-2">Update Prioritas</label>
                    <div class="flex space-x-2">
                        <select name="priority" class="flex-1 px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                            <option value="low" {{ $message->priority == 'low' ? 'selected' : '' }}>Rendah</option>
                            <option value="medium" {{ $message->priority == 'medium' ? 'selected' : '' }}>Sedang</option>
                            <option value="high" {{ $message->priority == 'high' ? 'selected' : '' }}>Tinggi</option>
                            <option value="urgent" {{ $message->priority == 'urgent' ? 'selected' : '' }}>Urgent</option>
                        </select>
                        <input type="hidden" name="status" value="{{ $message->status }}">
                        <button type="submit" class="px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                            <i class="fas fa-save"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Contact Info -->
            <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                    <i class="fas fa-user text-green-500 mr-2"></i>
                    Kontak
                </h3>
                
                <dl class="space-y-4">
                    <div>
                        <dt class="text-gray-400 text-sm">Nama</dt>
                        <dd class="text-white font-medium">{{ $message->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-400 text-sm">Email</dt>
                        <dd>
                            <a href="mailto:{{ $message->email }}" class="text-blue-400 hover:text-blue-300">
                                {{ $message->email }}
                            </a>
                        </dd>
                    </div>
                    @if($message->phone)
                        <div>
                            <dt class="text-gray-400 text-sm">Telepon</dt>
                            <dd>
                                <a href="tel:{{ $message->phone }}" class="text-blue-400 hover:text-blue-300">
                                    {{ $message->phone }}
                                </a>
                            </dd>
                        </div>
                    @endif
                </dl>

                <!-- Quick Actions -->
                <div class="mt-4 pt-4 border-t border-gray-700 space-y-2">
                    <a href="mailto:{{ $message->email }}" 
                       class="w-full inline-flex items-center justify-center px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition-colors">
                        <i class="fas fa-envelope mr-2"></i> Kirim Email
                    </a>
                    @if($message->phone)
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $message->phone) }}" target="_blank"
                           class="w-full inline-flex items-center justify-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition-colors">
                            <i class="fab fa-whatsapp mr-2"></i> WhatsApp
                        </a>
                    @endif
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
                        <dt class="text-gray-400">Diterima</dt>
                        <dd class="text-white">{{ $message->created_at->format('d M Y, H:i') }}</dd>
                    </div>
                    @if($message->read_at)
                        <div>
                            <dt class="text-gray-400">Dibaca</dt>
                            <dd class="text-white">{{ $message->read_at->format('d M Y, H:i') }}</dd>
                        </div>
                    @endif
                    @if($message->replied_at)
                        <div>
                            <dt class="text-gray-400">Dibalas</dt>
                            <dd class="text-white">{{ $message->replied_at->format('d M Y, H:i') }}</dd>
                        </div>
                    @endif
                </dl>
            </div>

            <!-- Danger Zone -->
            <div class="bg-gray-800 rounded-xl p-6 border border-red-500/30">
                <h3 class="text-lg font-semibold text-red-400 mb-4 flex items-center">
                    <i class="fas fa-exclamation-triangle mr-2"></i>
                    Zona Berbahaya
                </h3>
                
                <form action="{{ route('admin.messages.destroy', $message) }}" method="POST"
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesan ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="w-full px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-medium transition-colors">
                        <i class="fas fa-trash mr-2"></i> Hapus Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
