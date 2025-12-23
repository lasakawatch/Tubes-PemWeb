<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faqs = [
            // General
            [
                'question' => 'Apa itu HealthFirst Medical?',
                'answer' => 'HealthFirst Medical adalah platform kesehatan digital terpadu yang menyediakan layanan konsultasi online dengan dokter, pembelian obat dan alat kesehatan, serta informasi kesehatan terpercaya. Kami berkomitmen memberikan layanan kesehatan yang mudah diakses, terjangkau, dan berkualitas tinggi.',
                'category' => 'general',
                'order' => 1,
            ],
            [
                'question' => 'Bagaimana cara mendaftar sebagai pengguna baru?',
                'answer' => 'Untuk mendaftar, klik tombol "Daftar" di halaman utama. Isi formulir pendaftaran dengan nama lengkap, email, nomor telepon, dan kata sandi. Verifikasi email Anda melalui link yang dikirim ke inbox. Setelah verifikasi berhasil, Anda dapat langsung menggunakan semua layanan kami.',
                'category' => 'account',
                'order' => 2,
            ],
            [
                'question' => 'Apakah data pribadi saya aman?',
                'answer' => 'Ya, keamanan data Anda adalah prioritas utama kami. Kami menggunakan enkripsi SSL 256-bit untuk semua transaksi dan komunikasi. Data medis Anda disimpan dengan standar keamanan tinggi dan hanya dapat diakses oleh Anda dan dokter yang menangani. Kami mematuhi regulasi privasi data kesehatan yang berlaku.',
                'category' => 'general',
                'order' => 3,
            ],

            // Orders
            [
                'question' => 'Bagaimana cara memesan produk?',
                'answer' => 'Pilih produk yang ingin dibeli dan masukkan ke keranjang. Setelah selesai berbelanja, klik "Checkout". Pilih alamat pengiriman, metode pengiriman, dan metode pembayaran. Konfirmasi pesanan dan lakukan pembayaran. Anda akan menerima notifikasi setiap ada update status pesanan.',
                'category' => 'orders',
                'order' => 4,
            ],
            [
                'question' => 'Berapa lama pesanan saya akan diproses?',
                'answer' => 'Setelah pembayaran dikonfirmasi, pesanan akan diproses dalam 1-2 hari kerja. Untuk produk dengan resep dokter, diperlukan waktu tambahan untuk verifikasi resep. Anda dapat memantau status pesanan melalui halaman "Pesanan Saya" di akun Anda.',
                'category' => 'orders',
                'order' => 5,
            ],
            [
                'question' => 'Bisakah saya membatalkan pesanan?',
                'answer' => 'Anda dapat membatalkan pesanan selama status masih "Menunggu Konfirmasi" atau "Diproses". Setelah pesanan dikirim, pembatalan tidak dapat dilakukan. Untuk membatalkan, buka halaman "Pesanan Saya", pilih pesanan yang ingin dibatalkan, dan klik "Batalkan Pesanan". Refund akan diproses dalam 3-7 hari kerja.',
                'category' => 'orders',
                'order' => 6,
            ],

            // Payment
            [
                'question' => 'Metode pembayaran apa saja yang tersedia?',
                'answer' => 'Kami menerima berbagai metode pembayaran: Transfer Bank (BCA, Mandiri, BNI, BRI), Kartu Kredit/Debit (Visa, Mastercard), E-Wallet (GoPay, OVO, DANA, ShopeePay), dan Bayar di Tempat (COD) untuk area tertentu. Semua transaksi dijamin aman dengan sistem pembayaran terenkripsi.',
                'category' => 'payment',
                'order' => 7,
            ],
            [
                'question' => 'Bagaimana jika pembayaran gagal?',
                'answer' => 'Jika pembayaran gagal, pastikan saldo atau limit kartu Anda mencukupi. Coba ulangi pembayaran atau gunakan metode pembayaran lain. Jika masalah berlanjut, hubungi customer service kami di 021-xxxx-xxxx atau email support@healthfirst.com. Tim kami akan membantu menyelesaikan masalah dalam 24 jam.',
                'category' => 'payment',
                'order' => 8,
            ],
            [
                'question' => 'Apakah ada biaya tambahan untuk pembayaran?',
                'answer' => 'Tidak ada biaya tambahan dari HealthFirst untuk semua metode pembayaran. Namun, beberapa bank mungkin mengenakan biaya transfer antar bank. Untuk pembayaran cicilan kartu kredit, bunga mengikuti ketentuan bank penerbit kartu Anda.',
                'category' => 'payment',
                'order' => 9,
            ],

            // Shipping
            [
                'question' => 'Berapa biaya pengiriman?',
                'answer' => 'Biaya pengiriman bervariasi tergantung lokasi dan berat paket. Untuk pengiriman dalam kota biasanya Rp 10.000 - Rp 25.000. Pengiriman luar kota mulai dari Rp 15.000 - Rp 50.000. Gratis ongkir untuk pembelian minimal Rp 150.000 (area tertentu). Rincian biaya akan ditampilkan saat checkout.',
                'category' => 'shipping',
                'order' => 10,
            ],
            [
                'question' => 'Berapa lama estimasi pengiriman?',
                'answer' => 'Estimasi pengiriman: Same Day (pesanan sebelum jam 14:00 di area tertentu), 1-2 hari untuk Jabodetabek, 2-4 hari untuk Pulau Jawa, 4-7 hari untuk luar Jawa. Untuk wilayah terpencil mungkin memerlukan waktu lebih lama. Anda bisa melacak pesanan melalui nomor resi yang diberikan.',
                'category' => 'shipping',
                'order' => 11,
            ],
            [
                'question' => 'Bagaimana cara melacak pesanan saya?',
                'answer' => 'Setelah pesanan dikirim, Anda akan menerima nomor resi melalui email dan notifikasi aplikasi. Buka halaman "Pesanan Saya", pilih pesanan yang ingin dilacak, dan klik "Lacak Pesanan". Anda juga bisa melacak langsung di website kurir dengan memasukkan nomor resi.',
                'category' => 'shipping',
                'order' => 12,
            ],

            // Products
            [
                'question' => 'Apakah semua produk asli dan legal?',
                'answer' => 'Ya, semua produk yang dijual di HealthFirst adalah produk asli dengan izin edar BPOM/Kemenkes. Kami hanya bekerja sama dengan distributor resmi dan produsen terpercaya. Setiap produk memiliki tanggal kadaluarsa yang jelas dan disimpan sesuai standar penyimpanan obat.',
                'category' => 'products',
                'order' => 13,
            ],
            [
                'question' => 'Bagaimana cara membeli obat dengan resep?',
                'answer' => 'Untuk obat dengan resep, Anda perlu mengunggah foto resep dokter saat checkout. Tim farmasis kami akan memverifikasi resep dalam 2-4 jam kerja. Setelah diverifikasi, pembayaran dapat dilakukan dan pesanan akan diproses. Resep asli dapat diserahkan ke kurir saat pengiriman.',
                'category' => 'products',
                'order' => 14,
            ],
            [
                'question' => 'Apa yang harus dilakukan jika produk yang diterima rusak?',
                'answer' => 'Jika produk yang diterima rusak atau tidak sesuai pesanan, segera hubungi kami dalam 24 jam dengan menyertakan foto bukti. Kami akan memproses penggantian produk atau refund sesuai ketentuan. Simpan produk dalam kondisi seadanya untuk pengembalian jika diperlukan.',
                'category' => 'products',
                'order' => 15,
            ],

            // Consultation
            [
                'question' => 'Bagaimana cara konsultasi dengan dokter?',
                'answer' => 'Pilih menu "Konsultasi" dan pilih spesialis yang sesuai kebutuhan. Pilih jadwal yang tersedia atau konsultasi langsung jika dokter online. Jelaskan keluhan Anda melalui chat atau video call. Dokter akan memberikan diagnosis dan resep jika diperlukan. Riwayat konsultasi tersimpan di akun Anda.',
                'category' => 'consultation',
                'order' => 16,
            ],
            [
                'question' => 'Berapa biaya konsultasi online?',
                'answer' => 'Biaya konsultasi bervariasi tergantung spesialisasi dokter, mulai dari Rp 25.000 untuk dokter umum hingga Rp 150.000 untuk dokter spesialis. Beberapa layanan tersedia gratis untuk konsultasi pertama. Cek promo yang berlaku untuk diskon konsultasi.',
                'category' => 'consultation',
                'order' => 17,
            ],
            [
                'question' => 'Apakah resep dari dokter online bisa digunakan di apotek lain?',
                'answer' => 'Ya, resep digital dari dokter HealthFirst adalah resep yang sah dan dapat digunakan di apotek manapun. Anda dapat mengunduh atau mencetak resep dari halaman riwayat konsultasi. Namun, kami sarankan membeli di HealthFirst untuk kemudahan dan jaminan keaslian obat.',
                'category' => 'consultation',
                'order' => 18,
            ],

            // Refund
            [
                'question' => 'Bagaimana kebijakan pengembalian produk?',
                'answer' => 'Pengembalian produk dapat dilakukan dalam 7 hari setelah produk diterima jika: produk rusak/cacat, produk tidak sesuai pesanan, atau produk mendekati kadaluarsa. Produk harus dalam kondisi belum dibuka/digunakan dengan kemasan asli. Obat dengan resep tidak dapat dikembalikan kecuali rusak.',
                'category' => 'refund',
                'order' => 19,
            ],
            [
                'question' => 'Berapa lama proses refund?',
                'answer' => 'Setelah pengajuan refund disetujui, proses pengembalian dana membutuhkan waktu: 1-3 hari kerja untuk E-Wallet, 3-7 hari kerja untuk Transfer Bank, 7-14 hari kerja untuk Kartu Kredit. Anda akan menerima notifikasi ketika refund berhasil diproses.',
                'category' => 'refund',
                'order' => 20,
            ],

            // Account
            [
                'question' => 'Bagaimana cara mengubah password?',
                'answer' => 'Login ke akun Anda dan buka menu "Profil" atau "Pengaturan Akun". Pilih "Ubah Password". Masukkan password lama, kemudian masukkan password baru sebanyak dua kali untuk konfirmasi. Klik "Simpan". Demi keamanan, gunakan password yang kuat dengan kombinasi huruf, angka, dan simbol.',
                'category' => 'account',
                'order' => 21,
            ],
            [
                'question' => 'Saya lupa password, bagaimana cara reset?',
                'answer' => 'Di halaman login, klik "Lupa Password". Masukkan email yang terdaftar. Anda akan menerima link reset password via email. Klik link tersebut dan buat password baru. Link reset hanya berlaku 24 jam. Jika tidak menerima email, cek folder spam atau hubungi customer service.',
                'category' => 'account',
                'order' => 22,
            ],
        ];

        foreach ($faqs as $faq) {
            Faq::create(array_merge($faq, ['is_active' => true, 'views' => rand(10, 500)]));
        }
    }
}
