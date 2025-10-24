{{-- Footer Component --}}
<footer class="bg-gray-800 text-white mt-16">
    <div class="container mx-auto px-4 py-8">
        <div class="grid md:grid-cols-4 gap-8">
            {{-- About Section --}}
            <div>
                <h3 class="text-lg font-bold mb-4">Tentang Kami</h3>
                <p class="text-gray-400">
                    Tugas Besar Pemrograman Web - Kelompok Serigala Putih. 
                    Kami berkomitmen memberikan solusi digital terbaik.
                </p>
                <div class="mt-4">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-wolf-pack-battalion text-purple-400 text-2xl"></i>
                        <span class="font-bold text-xl">Serigala Putih</span>
                    </div>
                </div>
            </div>
            
            {{-- Quick Links --}}
            <div>
                <h3 class="text-lg font-bold mb-4">Link Cepat</h3>
                <ul class="space-y-2 text-gray-400">
                    <li>
                        <a href="{{ route('home') }}" class="hover:text-white transition">
                            <i class="fas fa-home mr-2"></i> Home
                        </a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-white transition">
                            <i class="fas fa-shopping-bag mr-2"></i> Products
                        </a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-white transition">
                            <i class="fas fa-blog mr-2"></i> Blog
                        </a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-white transition">
                            <i class="fas fa-info-circle mr-2"></i> About
                        </a>
                    </li>
                    <li>
                        <a href="#" class="hover:text-white transition">
                            <i class="fas fa-envelope mr-2"></i> Contact
                        </a>
                    </li>
                </ul>
            </div>
            
            {{-- Contact Info --}}
            <div>
                <h3 class="text-lg font-bold mb-4">Kontak</h3>
                <ul class="space-y-2 text-gray-400">
                    <li class="flex items-start">
                        <i class="fas fa-envelope mt-1 mr-3"></i>
                        <span>info@serigalaputih.com</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-phone mt-1 mr-3"></i>
                        <span>+62 xxx xxxx xxxx</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-map-marker-alt mt-1 mr-3"></i>
                        <span>Indonesia</span>
                    </li>
                    <li class="flex items-start">
                        <i class="fas fa-clock mt-1 mr-3"></i>
                        <span>24/7 Customer Support</span>
                    </li>
                </ul>
            </div>
            
            {{-- Social Media & Newsletter --}}
            <div>
                <h3 class="text-lg font-bold mb-4">Ikuti Kami</h3>
                <div class="flex space-x-4 text-2xl mb-6">
                    <a href="#" class="text-gray-400 hover:text-white transition" aria-label="Facebook">
                        <i class="fab fa-facebook"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition" aria-label="Twitter">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition" aria-label="Instagram">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition" aria-label="GitHub">
                        <i class="fab fa-github"></i>
                    </a>
                </div>
                
                <h4 class="font-bold mb-2">Newsletter</h4>
                <form class="flex">
                    <input 
                        type="email" 
                        placeholder="Your email" 
                        class="px-4 py-2 rounded-l bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-purple-500 flex-1"
                    >
                    <button 
                        type="submit" 
                        class="px-4 py-2 bg-purple-600 rounded-r hover:bg-purple-700 transition"
                    >
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
        
        {{-- Copyright --}}
        <div class="border-t border-gray-700 mt-8 pt-8">
            <div class="flex flex-col md:flex-row justify-between items-center text-gray-400 text-sm">
                <p>&copy; {{ date('Y') }} Kelompok Serigala Putih. All rights reserved.</p>
                <div class="flex space-x-4 mt-4 md:mt-0">
                    <a href="#" class="hover:text-white transition">Privacy Policy</a>
                    <span>•</span>
                    <a href="#" class="hover:text-white transition">Terms of Service</a>
                    <span>•</span>
                    <a href="#" class="hover:text-white transition">Sitemap</a>
                </div>
            </div>
        </div>
    </div>
</footer>

{{-- Scroll to Top Button --}}
<button 
    id="scrollToTop" 
    onclick="scrollToTop()" 
    class="hidden fixed bottom-8 right-8 bg-purple-600 text-white p-3 rounded-full shadow-lg hover:bg-purple-700 transition z-50"
    aria-label="Scroll to top"
>
    <i class="fas fa-arrow-up"></i>
</button>

<script>
    // Show/Hide Scroll to Top button
    window.addEventListener('scroll', function() {
        const scrollBtn = document.getElementById('scrollToTop');
        if (window.scrollY > 300) {
            scrollBtn.classList.remove('hidden');
        } else {
            scrollBtn.classList.add('hidden');
        }
    });
    
    // Scroll to Top function
    function scrollToTop() {
        window.scrollTo({
            top: 0,
            behavior: 'smooth'
        });
    }
</script>
