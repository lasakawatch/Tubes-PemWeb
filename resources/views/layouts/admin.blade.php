<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="{ darkMode: localStorage.getItem('darkMode') === 'true' }" :class="{ 'dark': darkMode }">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'HealthFirst') }} - Admin</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        
        <!-- Chart.js -->
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        
        <style>
            [x-cloak] { display: none !important; }
        </style>
    </head>
    <body class="font-sans antialiased">
        @php
            // Safely get counts - handle case when tables don't exist
            try {
                $pendingOrders = \App\Models\Order::where('status', 'pending')->count();
            } catch (\Exception $e) {
                $pendingOrders = 0;
            }
            try {
                $unreadMessages = \App\Models\ContactMessage::where('status', 'unread')->count();
            } catch (\Exception $e) {
                $unreadMessages = 0;
            }
        @endphp
        <div class="min-h-screen bg-gray-900">
            <!-- Sidebar -->
            <aside x-data="{ open: true }" 
                   :class="open ? 'w-64' : 'w-20'" 
                   class="fixed inset-y-0 left-0 z-50 bg-gray-800 border-r border-gray-700 transition-all duration-300 ease-in-out">
                
                <!-- Logo -->
                <div class="flex items-center justify-between h-16 px-4 border-b border-gray-700">
                    <a href="{{ route('dashboard') }}" class="flex items-center space-x-3" x-show="open">
                        <span class="text-2xl">🏥</span>
                        <span class="text-lg font-bold text-white">HealthFirst</span>
                        <span class="text-xs text-emerald-400 font-medium">Medical</span>
                    </a>
                    <button @click="open = !open" class="p-2 rounded-lg bg-gray-700 hover:bg-gray-600 text-white">
                        <i class="fas" :class="open ? 'fa-chevron-left' : 'fa-chevron-right'"></i>
                    </button>
                </div>

                <!-- Navigation -->
                <nav class="mt-6 px-3">
                    <div class="space-y-1">
                        <!-- Dashboard -->
                        <a href="{{ route('dashboard') }}" 
                           class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('dashboard') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                            <i class="fas fa-home w-5"></i>
                            <span class="ml-3" x-show="open">Dashboard</span>
                        </a>

                        <!-- Reports Section -->
                        <div x-data="{ expanded: {{ request()->routeIs('reports.*') || request()->routeIs('admin.reports.*') ? 'true' : 'false' }} }">
                            <button @click="expanded = !expanded" 
                                    class="flex items-center justify-between w-full px-4 py-3 text-sm font-medium text-gray-300 rounded-lg hover:bg-gray-700 transition-colors">
                                <div class="flex items-center">
                                    <i class="fas fa-chart-bar w-5"></i>
                                    <span class="ml-3" x-show="open">Laporan</span>
                                </div>
                                <i class="fas fa-chevron-down text-xs transition-transform" :class="{ 'rotate-180': expanded }" x-show="open"></i>
                            </button>
                            <div x-show="expanded" x-collapse class="mt-1 space-y-1 pl-11">
                                <a href="{{ route('reports.users') }}" class="block px-4 py-2 text-sm text-gray-400 rounded-lg hover:bg-gray-700 hover:text-white {{ request()->routeIs('reports.users') ? 'bg-gray-700 text-white' : '' }}">
                                    User Report
                                </a>
                                <a href="{{ route('reports.sales') }}" class="block px-4 py-2 text-sm text-gray-400 rounded-lg hover:bg-gray-700 hover:text-white {{ request()->routeIs('reports.sales') ? 'bg-gray-700 text-white' : '' }}">
                                    Sales Report
                                </a>
                            </div>
                        </div>

                        <!-- Kelola Pesanan -->
                        <a href="{{ route('admin.orders.index') }}" 
                           class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.orders.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                            <i class="fas fa-shopping-cart w-5"></i>
                            <span class="ml-3" x-show="open">Kelola Pesanan</span>
                            @if($pendingOrders > 0)
                                <span class="ml-auto bg-red-500 text-white text-xs px-2 py-0.5 rounded-full" x-show="open">{{ $pendingOrders }}</span>
                            @endif
                        </a>

                        <!-- Kelola Produk -->
                        <a href="{{ route('admin.products.index') }}" 
                           class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.products.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                            <i class="fas fa-boxes w-5"></i>
                            <span class="ml-3" x-show="open">Kelola Produk</span>
                        </a>

                        <!-- Kelola Artikel -->
                        <a href="{{ route('admin.articles.index') }}" 
                           class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.articles.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                            <i class="fas fa-newspaper w-5"></i>
                            <span class="ml-3" x-show="open">Kelola Artikel</span>
                        </a>

                        <!-- FAQ Management -->
                        <a href="{{ route('admin.faqs.index') }}" 
                           class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.faqs.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                            <i class="fas fa-question-circle w-5"></i>
                            <span class="ml-3" x-show="open">Kelola FAQ</span>
                        </a>

                        <!-- Contact Messages -->
                        <a href="{{ route('admin.messages.index') }}" 
                           class="flex items-center px-4 py-3 text-sm font-medium rounded-lg transition-colors {{ request()->routeIs('admin.messages.*') ? 'bg-blue-600 text-white' : 'text-gray-300 hover:bg-gray-700' }}">
                            <i class="fas fa-envelope w-5"></i>
                            <span class="ml-3" x-show="open">Pesan Masuk</span>
                            @if($unreadMessages > 0)
                                <span class="ml-auto bg-red-500 text-white text-xs px-2 py-0.5 rounded-full" x-show="open">{{ $unreadMessages }}</span>
                            @endif
                        </a>
                    </div>

                    <!-- User Section -->
                    <div class="mt-10 pt-6 border-t border-gray-700">
                        <a href="{{ route('profile.edit') }}" 
                           class="flex items-center px-4 py-3 text-sm font-medium text-gray-300 rounded-lg hover:bg-gray-700 transition-colors">
                            <i class="fas fa-user-cog w-5"></i>
                            <span class="ml-3" x-show="open">Profil</span>
                        </a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center w-full px-4 py-3 text-sm font-medium text-gray-300 rounded-lg hover:bg-red-600 hover:text-white transition-colors">
                                <i class="fas fa-sign-out-alt w-5"></i>
                                <span class="ml-3" x-show="open">Logout</span>
                            </button>
                        </form>
                    </div>
                </nav>
            </aside>

            <!-- Main Content -->
            <div class="transition-all duration-300 ease-in-out" x-data="{ sidebarOpen: true }" :class="sidebarOpen ? 'ml-64' : 'ml-20'">
                <!-- Top Navigation Bar -->
                <header class="sticky top-0 z-40 bg-gray-800 border-b border-gray-700">
                    <div class="flex items-center justify-between h-16 px-6">
                        <div class="flex items-center space-x-4">
                            <h1 class="text-xl font-semibold text-white">
                                @isset($header)
                                    {{ $header }}
                                @else
                                    Admin Dashboard
                                @endisset
                            </h1>
                        </div>

                        <div class="flex items-center space-x-4">
                            <!-- Dark Mode Toggle -->
                            <button @click="darkMode = !darkMode; localStorage.setItem('darkMode', darkMode)" 
                                    class="p-2 text-gray-400 hover:text-white rounded-lg hover:bg-gray-700 transition-colors">
                                <i class="fas" :class="darkMode ? 'fa-sun' : 'fa-moon'"></i>
                            </button>

                            <!-- Notifications -->
                            <div x-data="{ open: false }" class="relative">
                                <button @click="open = !open" class="p-2 text-gray-400 hover:text-white rounded-lg hover:bg-gray-700 transition-colors relative">
                                    <i class="fas fa-bell"></i>
                                    @if($unreadMessages > 0 || $pendingOrders > 0)
                                        <span class="absolute top-1 right-1 w-2 h-2 bg-red-500 rounded-full"></span>
                                    @endif
                                </button>
                                <div x-show="open" @click.away="open = false" x-cloak
                                     class="absolute right-0 mt-2 w-80 bg-gray-800 rounded-lg shadow-lg border border-gray-700 overflow-hidden">
                                    <div class="p-4 border-b border-gray-700">
                                        <h3 class="text-sm font-semibold text-white">Notifikasi</h3>
                                    </div>
                                    <div class="max-h-64 overflow-y-auto">
                                        @if($pendingOrders > 0)
                                            <a href="{{ route('admin.orders.index') }}" class="flex items-center p-4 hover:bg-gray-700 transition-colors">
                                                <div class="w-10 h-10 rounded-full bg-yellow-500/20 flex items-center justify-center">
                                                    <i class="fas fa-shopping-cart text-yellow-500"></i>
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-sm font-medium text-white">{{ $pendingOrders }} pesanan menunggu</p>
                                                    <p class="text-xs text-gray-400">Perlu dikonfirmasi</p>
                                                </div>
                                            </a>
                                        @endif
                                        @if($unreadMessages > 0)
                                            <a href="{{ route('admin.messages.index') }}" class="flex items-center p-4 hover:bg-gray-700 transition-colors">
                                                <div class="w-10 h-10 rounded-full bg-blue-500/20 flex items-center justify-center">
                                                    <i class="fas fa-envelope text-blue-500"></i>
                                                </div>
                                                <div class="ml-3">
                                                    <p class="text-sm font-medium text-white">{{ $unreadMessages }} pesan baru</p>
                                                    <p class="text-xs text-gray-400">Belum dibaca</p>
                                                </div>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <!-- User Menu -->
                            <div x-data="{ open: false }" class="relative">
                                <button @click="open = !open" class="flex items-center space-x-3 px-3 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                                    <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                                        <span class="text-sm font-medium text-white">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                    </div>
                                    <span class="text-sm font-medium text-white">{{ Auth::user()->name }}</span>
                                    <i class="fas fa-chevron-down text-xs text-gray-400"></i>
                                </button>
                                <div x-show="open" @click.away="open = false" x-cloak
                                     class="absolute right-0 mt-2 w-48 bg-gray-800 rounded-lg shadow-lg border border-gray-700 overflow-hidden">
                                    <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-3 text-sm text-gray-300 hover:bg-gray-700">
                                        <i class="fas fa-user mr-3"></i> Profil
                                    </a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="flex items-center w-full px-4 py-3 text-sm text-gray-300 hover:bg-red-600 hover:text-white">
                                            <i class="fas fa-sign-out-alt mr-3"></i> Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </header>

                <!-- Page Content -->
                <main class="p-6">
                    <!-- Flash Messages -->
                    @if(session('success'))
                        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                             class="mb-6 p-4 bg-green-500/20 border border-green-500 rounded-lg flex items-center justify-between">
                            <div class="flex items-center">
                                <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                <span class="text-green-400">{{ session('success') }}</span>
                            </div>
                            <button @click="show = false" class="text-green-400 hover:text-green-300">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)"
                             class="mb-6 p-4 bg-red-500/20 border border-red-500 rounded-lg flex items-center justify-between">
                            <div class="flex items-center">
                                <i class="fas fa-exclamation-circle text-red-500 mr-3"></i>
                                <span class="text-red-400">{{ session('error') }}</span>
                            </div>
                            <button @click="show = false" class="text-red-400 hover:text-red-300">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    @endif

                    {{ $slot }}
                </main>

                <!-- Footer -->
                <footer class="border-t border-gray-700 p-6">
                    <div class="flex items-center justify-between text-sm text-gray-400">
                        <p>&copy; {{ date('Y') }} HealthFirst Medical. All rights reserved.</p>
                        <div class="flex items-center space-x-4">
                            <span class="flex items-center">
                                <i class="fas fa-shield-alt text-green-500 mr-2"></i>
                                ISO 27001 Certified
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-lock text-blue-500 mr-2"></i>
                                256-bit SSL
                            </span>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        @stack('scripts')
    </body>
</html>
