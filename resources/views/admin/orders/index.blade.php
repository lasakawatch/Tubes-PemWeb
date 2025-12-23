<x-admin-layout>
    <x-slot name="header">Kelola Pesanan</x-slot>

    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-white">Daftar Pesanan</h2>
            <p class="text-gray-400 mt-1">Kelola semua pesanan pelanggan</p>
        </div>
        <a href="{{ route('admin.orders.export') }}" 
           class="mt-4 md:mt-0 inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-colors">
            <i class="fas fa-file-export mr-2"></i> Export CSV
        </a>
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
                    <i class="fas fa-shopping-bag text-blue-500"></i>
                </div>
            </div>
        </div>
        <div class="bg-gray-800 rounded-xl p-4 border border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-xs">Pending</p>
                    <p class="text-xl font-bold text-yellow-400">{{ $stats['pending'] ?? 0 }}</p>
                </div>
                <div class="w-10 h-10 bg-yellow-500/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-clock text-yellow-500"></i>
                </div>
            </div>
        </div>
        <div class="bg-gray-800 rounded-xl p-4 border border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-xs">Processing</p>
                    <p class="text-xl font-bold text-blue-400">{{ $stats['processing'] ?? 0 }}</p>
                </div>
                <div class="w-10 h-10 bg-blue-500/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-cog text-blue-500"></i>
                </div>
            </div>
        </div>
        <div class="bg-gray-800 rounded-xl p-4 border border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-xs">Shipped</p>
                    <p class="text-xl font-bold text-purple-400">{{ $stats['shipped'] ?? 0 }}</p>
                </div>
                <div class="w-10 h-10 bg-purple-500/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-truck text-purple-500"></i>
                </div>
            </div>
        </div>
        <div class="bg-gray-800 rounded-xl p-4 border border-gray-700">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-gray-400 text-xs">Completed</p>
                    <p class="text-xl font-bold text-green-400">{{ $stats['delivered'] ?? 0 }}</p>
                </div>
                <div class="w-10 h-10 bg-green-500/20 rounded-lg flex items-center justify-center">
                    <i class="fas fa-check-circle text-green-500"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-gray-800 rounded-xl p-6 border border-gray-700 mb-6">
        <form action="{{ route('admin.orders.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-5 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Cari</label>
                <div class="relative">
                    <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500"></i>
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Order #, nama..." 
                           class="w-full pl-10 pr-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                </div>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Status</label>
                <select name="status" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    <option value="">Semua Status</option>
                    @foreach(\App\Models\Order::STATUSES as $key => $label)
                        <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-400 mb-2">Pembayaran</label>
                <select name="payment_status" class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    <option value="">Semua</option>
                    <option value="pending" {{ request('payment_status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ request('payment_status') == 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="failed" {{ request('payment_status') == 'failed' ? 'selected' : '' }}>Failed</option>
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
                <a href="{{ route('admin.orders.index') }}" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition-colors">
                    <i class="fas fa-times"></i>
                </a>
            </div>
        </form>
    </div>

    <!-- Orders Table -->
    <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-900/50">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Order</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Pelanggan</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Total</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Pembayaran</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-400 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-4 text-right text-xs font-semibold text-gray-400 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-700">
                    @forelse($orders as $order)
                        <tr class="hover:bg-gray-700/50 transition-colors">
                            <td class="px-6 py-4">
                                <div>
                                    <p class="text-sm font-medium text-white">{{ $order->order_number }}</p>
                                    <p class="text-xs text-gray-400">{{ $order->items->count() }} item(s)</p>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center flex-shrink-0">
                                        <span class="text-xs font-medium text-white">{{ substr($order->user->name ?? 'G', 0, 1) }}</span>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-white">{{ $order->user->name ?? $order->shipping_name }}</p>
                                        <p class="text-xs text-gray-400">{{ $order->user->email ?? $order->shipping_phone }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm font-medium text-white">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</p>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                    {{ $order->payment_status == 'paid' ? 'bg-green-500/20 text-green-400' : 
                                       ($order->payment_status == 'pending' ? 'bg-yellow-500/20 text-yellow-400' : 'bg-red-500/20 text-red-400') }}">
                                    <i class="fas {{ $order->payment_status == 'paid' ? 'fa-check' : ($order->payment_status == 'pending' ? 'fa-clock' : 'fa-times') }} mr-1"></i>
                                    {{ ucfirst($order->payment_status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium" 
                                      style="background-color: {{ $order->status_color }}20; color: {{ $order->status_color }}">
                                    {{ $order->status_label }}
                                </span>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-sm text-gray-400">{{ $order->created_at->format('d M Y') }}</p>
                                <p class="text-xs text-gray-500">{{ $order->created_at->format('H:i') }}</p>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex items-center justify-end space-x-2">
                                    <a href="{{ route('admin.orders.show', $order) }}" 
                                       class="p-2 text-gray-400 hover:text-blue-400 hover:bg-gray-700 rounded-lg transition-colors" title="Detail">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.orders.invoice', $order) }}" 
                                       class="p-2 text-gray-400 hover:text-green-400 hover:bg-gray-700 rounded-lg transition-colors" title="Invoice">
                                        <i class="fas fa-file-invoice"></i>
                                    </a>
                                    <div x-data="{ open: false }" class="relative">
                                        <button @click="open = !open" class="p-2 text-gray-400 hover:text-white hover:bg-gray-700 rounded-lg transition-colors">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <div x-show="open" @click.away="open = false" x-cloak
                                             class="absolute right-0 mt-2 w-48 bg-gray-800 rounded-lg shadow-lg border border-gray-700 z-50">
                                            <form action="{{ route('admin.orders.update-status', $order) }}" method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <div class="py-2">
                                                    <p class="px-4 py-2 text-xs font-semibold text-gray-400 uppercase">Update Status</p>
                                                    @foreach(\App\Models\Order::STATUSES as $key => $label)
                                                        <button type="submit" name="status" value="{{ $key }}"
                                                                class="w-full text-left px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 {{ $order->status == $key ? 'bg-gray-700' : '' }}">
                                                            {{ $label }}
                                                        </button>
                                                    @endforeach
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="px-6 py-12 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-16 h-16 bg-gray-700 rounded-full flex items-center justify-center mb-4">
                                        <i class="fas fa-shopping-cart text-gray-500 text-2xl"></i>
                                    </div>
                                    <p class="text-gray-400">Belum ada pesanan</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($orders->hasPages())
            <div class="px-6 py-4 border-t border-gray-700">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
