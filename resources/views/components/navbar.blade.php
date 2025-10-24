{{-- Navbar Component --}}
<nav class="bg-white shadow-md">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            {{-- Logo --}}
            <div class="flex items-center space-x-2">
                <a href="{{ route('home') }}" class="flex items-center space-x-2">
                    <i class="fas fa-wolf-pack-battalion text-purple-600 text-2xl"></i>
                    <span class="text-xl font-bold text-gray-800">Serigala Putih</span>
                </a>
            </div>
            
            {{-- Desktop Menu --}}
            <div class="hidden md:flex space-x-6">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-purple-600 transition {{ request()->routeIs('home') ? 'text-purple-600 font-semibold' : '' }}">
                    Home
                </a>
                <a href="#" class="text-gray-700 hover:text-purple-600 transition">
                    Products
                </a>
                <a href="#" class="text-gray-700 hover:text-purple-600 transition">
                    Blog
                </a>
                <a href="#" class="text-gray-700 hover:text-purple-600 transition">
                    About
                </a>
                <a href="#" class="text-gray-700 hover:text-purple-600 transition">
                    Contact
                </a>
            </div>
            
            {{-- Auth Buttons --}}
            <div class="hidden md:flex items-center space-x-2">
                @auth
                    {{-- Authenticated User --}}
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center space-x-2 text-gray-700 hover:text-purple-600 transition">
                            <i class="fas fa-user-circle text-2xl"></i>
                            <span>{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down text-xs"></i>
                        </button>
                        
                        {{-- Dropdown Menu --}}
                        <div x-show="open" @click.away="open = false" class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50">
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-user mr-2"></i> Profile
                            </a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-shopping-bag mr-2"></i> My Orders
                            </a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                                <i class="fas fa-cog mr-2"></i> Settings
                            </a>
                            <hr class="my-1">
                            <form method="POST" action="#">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-gray-100">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    {{-- Guest User --}}
                    <a href="#" class="px-4 py-2 text-purple-600 border border-purple-600 rounded hover:bg-purple-50 transition">
                        Login
                    </a>
                    <a href="#" class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 transition">
                        Register
                    </a>
                @endauth
            </div>
            
            {{-- Mobile Menu Button --}}
            <button class="md:hidden text-gray-700" onclick="toggleMobileMenu()">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
        
        {{-- Mobile Menu --}}
        <div id="mobile-menu" class="hidden md:hidden pb-4">
            <div class="flex flex-col space-y-2">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-purple-600 transition py-2">Home</a>
                <a href="#" class="text-gray-700 hover:text-purple-600 transition py-2">Products</a>
                <a href="#" class="text-gray-700 hover:text-purple-600 transition py-2">Blog</a>
                <a href="#" class="text-gray-700 hover:text-purple-600 transition py-2">About</a>
                <a href="#" class="text-gray-700 hover:text-purple-600 transition py-2">Contact</a>
                <hr>
                @auth
                    <a href="#" class="text-gray-700 hover:text-purple-600 transition py-2">Profile</a>
                    <a href="#" class="text-gray-700 hover:text-purple-600 transition py-2">My Orders</a>
                    <form method="POST" action="#">
                        @csrf
                        <button type="submit" class="text-left text-red-600 hover:text-red-700 transition py-2 w-full">
                            Logout
                        </button>
                    </form>
                @else
                    <a href="#" class="text-purple-600 py-2">Login</a>
                    <a href="#" class="text-purple-600 py-2">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>

<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobile-menu');
        menu.classList.toggle('hidden');
    }
</script>
