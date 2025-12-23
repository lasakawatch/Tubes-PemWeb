<x-admin-layout>
    <x-slot name="header">Detail Pesanan</x-slot>

    <!-- Page Header -->
    <div class="flex flex-col md:flex-row md:items-center md:justify-between mb-6">
        <div>
            <h2 class="text-2xl font-bold text-white">{{ $order->order_number }}</h2>
            <p class="text-gray-400 mt-1">{{ $order->created_at->format('d F Y, H:i') }}</p>
        </div>
        <div class="mt-4 md:mt-0 flex items-center space-x-3">
            <a href="{{ route('admin.orders.invoice', $order) }}" 
               class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg font-medium transition-colors">
                <i class="fas fa-file-invoice mr-2"></i> Invoice
            </a>
            <a href="{{ route('admin.orders.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg font-medium transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Status Timeline -->
    <div class="bg-gray-800 rounded-xl p-6 border border-gray-700 mb-6">
        <h3 class="text-lg font-semibold text-white mb-6">Status Pesanan</h3>
        
        <div class="relative">
            <div class="absolute left-0 md:left-1/2 transform md:-translate-x-1/2 h-full w-0.5 bg-gray-700"></div>
            
            <div class="flex flex-wrap justify-between relative">
                @php
                    $statuses = ['pending', 'confirmed', 'processing', 'shipped', 'delivered'];
                    $currentIndex = array_search($order->status, $statuses);
                @endphp
                
                @foreach($statuses as $index => $status)
                    <div class="flex flex-col items-center w-1/5 relative">
                        <div class="w-10 h-10 rounded-full flex items-center justify-center z-10
                            {{ $index <= $currentIndex ? 'bg-green-500 text-white' : 'bg-gray-700 text-gray-400' }}">
                            @if($status == 'pending')
                                <i class="fas fa-clock"></i>
                            @elseif($status == 'confirmed')
                                <i class="fas fa-check"></i>
                            @elseif($status == 'processing')
                                <i class="fas fa-cog"></i>
                            @elseif($status == 'shipped')
                                <i class="fas fa-truck"></i>
                            @else
                                <i class="fas fa-check-double"></i>
                            @endif
                        </div>
                        <p class="mt-2 text-xs font-medium {{ $index <= $currentIndex ? 'text-green-400' : 'text-gray-500' }}">
                            {{ \App\Models\Order::STATUSES[$status] }}
                        </p>
                        @if($order->status == $status)
                            <p class="text-xs text-gray-400">{{ $order->updated_at->format('d M, H:i') }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Update Status -->
        <div class="mt-8 pt-6 border-t border-gray-700">
            <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="flex items-center space-x-4">
                @csrf
                @method('PATCH')
                <label class="text-sm font-medium text-gray-400">Update Status:</label>
                <select name="status" class="px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    @foreach(\App\Models\Order::STATUSES as $key => $label)
                        <option value="{{ $key }}" {{ $order->status == $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg font-medium transition-colors">
                    <i class="fas fa-save mr-2"></i> Update
                </button>
            </form>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Order Items -->
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-gray-800 rounded-xl border border-gray-700 overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-700">
                    <h3 class="text-lg font-semibold text-white flex items-center">
                        <i class="fas fa-shopping-cart text-blue-500 mr-2"></i>
                        Item Pesanan ({{ $order->items->count() }})
                    </h3>
                </div>
                
                <div class="divide-y divide-gray-700">
                    @foreach($order->items as $item)
                        <div class="p-6 flex items-center space-x-4">
                            <div class="w-16 h-16 bg-gray-700 rounded-lg flex items-center justify-center overflow-hidden flex-shrink-0">
                                @if($item->product && $item->product->image)
                                    <img src="{{ Storage::url($item->product->image) }}" alt="{{ $item->product_name }}" class="w-full h-full object-cover">
                                @else
                                    <i class="fas fa-pills text-gray-500"></i>
                                @endif
                            </div>
                            <div class="flex-1">
                                <h4 class="text-sm font-medium text-white">{{ $item->product_name }}</h4>
                                <p class="text-xs text-gray-400">SKU: {{ $item->product_sku }}</p>
                                <div class="mt-1 flex items-center space-x-4 text-sm">
                                    <span class="text-gray-400">Qty: <span class="text-white">{{ $item->quantity }}</span></span>
                                    <span class="text-gray-400">@ Rp {{ number_format($item->price, 0, ',', '.') }}</span>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="text-sm font-medium text-white">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <!-- Order Summary -->
                <div class="px-6 py-4 bg-gray-900/50 border-t border-gray-700">
                    <div class="space-y-2">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Subtotal</span>
                            <span class="text-white">Rp {{ number_format($order->subtotal, 0, ',', '.') }}</span>
                        </div>
                        @if($order->discount_amount > 0)
                            <div class="flex justify-between text-sm">
                                <span class="text-gray-400">Diskon</span>
                                <span class="text-green-400">-Rp {{ number_format($order->discount_amount, 0, ',', '.') }}</span>
                            </div>
                        @endif
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-400">Ongkos Kirim</span>
                            <span class="text-white">Rp {{ number_format($order->shipping_cost, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-lg font-bold pt-2 border-t border-gray-700">
                            <span class="text-white">Total</span>
                            <span class="text-green-400">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notes -->
            @if($order->notes)
                <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                    <h3 class="text-lg font-semibold text-white mb-3 flex items-center">
                        <i class="fas fa-sticky-note text-yellow-500 mr-2"></i>
                        Catatan
                    </h3>
                    <p class="text-gray-300">{{ $order->notes }}</p>
                </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Customer Info -->
            <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                    <i class="fas fa-user text-blue-500 mr-2"></i>
                    Pelanggan
                </h3>
                
                <div class="flex items-center mb-4">
                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                        <span class="text-lg font-medium text-white">{{ substr($order->user->name ?? 'G', 0, 1) }}</span>
                    </div>
                    <div class="ml-3">
                        <p class="text-white font-medium">{{ $order->user->name ?? 'Guest' }}</p>
                        <p class="text-sm text-gray-400">{{ $order->user->email ?? '-' }}</p>
                    </div>
                </div>
                
                @if($order->user)
                    <div class="pt-4 border-t border-gray-700">
                        <p class="text-xs text-gray-400 mb-1">Member sejak</p>
                        <p class="text-sm text-white">{{ $order->user->created_at->format('d M Y') }}</p>
                    </div>
                @endif
            </div>

            <!-- Shipping Info -->
            <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                    <i class="fas fa-truck text-green-500 mr-2"></i>
                    Pengiriman
                </h3>
                
                <dl class="space-y-3 text-sm">
                    <div>
                        <dt class="text-gray-400">Penerima</dt>
                        <dd class="text-white font-medium">{{ $order->shipping_name }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-400">Telepon</dt>
                        <dd class="text-white">{{ $order->shipping_phone }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-400">Alamat</dt>
                        <dd class="text-white">{{ $order->shipping_address }}</dd>
                        <dd class="text-gray-400">{{ $order->shipping_city }}, {{ $order->shipping_postal_code }}</dd>
                    </div>
                    @if($order->shipping_method)
                        <div>
                            <dt class="text-gray-400">Metode</dt>
                            <dd class="text-white">{{ $order->shipping_method }}</dd>
                        </div>
                    @endif
                    @if($order->tracking_number)
                        <div class="pt-3 border-t border-gray-700">
                            <dt class="text-gray-400 mb-1">No. Resi</dt>
                            <dd class="flex items-center">
                                <code class="text-green-400 bg-gray-900 px-2 py-1 rounded">{{ $order->tracking_number }}</code>
                            </dd>
                        </div>
                    @endif
                </dl>

                <!-- Update Tracking -->
                <form action="{{ route('admin.orders.update-status', $order) }}" method="POST" class="mt-4 pt-4 border-t border-gray-700">
                    @csrf
                    @method('PATCH')
                    <label class="block text-sm font-medium text-gray-400 mb-2">Update No. Resi</label>
                    <div class="flex space-x-2">
                        <input type="text" name="tracking_number" value="{{ $order->tracking_number }}"
                               placeholder="Masukkan no. resi"
                               class="flex-1 px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-sm">
                        <input type="hidden" name="status" value="{{ $order->status }}">
                        <button type="submit" class="px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                            <i class="fas fa-save"></i>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Payment Info -->
            <div class="bg-gray-800 rounded-xl p-6 border border-gray-700">
                <h3 class="text-lg font-semibold text-white mb-4 flex items-center">
                    <i class="fas fa-credit-card text-purple-500 mr-2"></i>
                    Pembayaran
                </h3>
                
                <dl class="space-y-3 text-sm">
                    <div class="flex justify-between">
                        <dt class="text-gray-400">Metode</dt>
                        <dd class="text-white">{{ \App\Models\Order::PAYMENT_METHODS[$order->payment_method] ?? $order->payment_method }}</dd>
                    </div>
                    <div class="flex justify-between">
                        <dt class="text-gray-400">Status</dt>
                        <dd>
                            <span class="inline-flex items-center px-2 py-0.5 rounded-full text-xs font-medium
                                {{ $order->payment_status == 'paid' ? 'bg-green-500/20 text-green-400' : 
                                   ($order->payment_status == 'pending' ? 'bg-yellow-500/20 text-yellow-400' : 'bg-red-500/20 text-red-400') }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </dd>
                    </div>
                    @if($order->paid_at)
                        <div class="flex justify-between">
                            <dt class="text-gray-400">Tanggal Bayar</dt>
                            <dd class="text-white">{{ $order->paid_at->format('d M Y, H:i') }}</dd>
                        </div>
                    @endif
                </dl>

                <!-- Update Payment Status -->
                <form action="{{ route('admin.orders.update-payment', $order) }}" method="POST" class="mt-4 pt-4 border-t border-gray-700">
                    @csrf
                    @method('PATCH')
                    <label class="block text-sm font-medium text-gray-400 mb-2">Update Status Pembayaran</label>
                    <div class="flex space-x-2">
                        <select name="payment_status" class="flex-1 px-3 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white focus:border-blue-500 focus:ring-1 focus:ring-blue-500 text-sm">
                            <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
                            <option value="refunded" {{ $order->payment_status == 'refunded' ? 'selected' : '' }}>Refunded</option>
                        </select>
                        <button type="submit" class="px-3 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                            <i class="fas fa-save"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-admin-layout>
