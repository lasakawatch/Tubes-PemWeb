<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use Illuminate\Database\Seeder;

class ContactMessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $messages = [
            [
                'name' => 'Ahmad Rizki',
                'email' => 'ahmad.rizki@gmail.com',
                'phone' => '081234567890',
                'subject' => 'Pertanyaan tentang Pengiriman',
                'message' => 'Halo, saya ingin menanyakan apakah pengiriman ke daerah Kalimantan Timur tersedia? Berapa estimasi waktu pengiriman dan biayanya? Terima kasih.',
                'status' => 'replied',
                'priority' => 'medium',
                'reply' => 'Terima kasih telah menghubungi kami, Pak Ahmad. Pengiriman ke Kalimantan Timur tersedia dengan estimasi 4-7 hari kerja. Biaya pengiriman mulai dari Rp 35.000 tergantung berat paket. Silakan melakukan pemesanan dan pilih kurir yang tersedia saat checkout.',
                'replied_at' => now()->subDays(5),
            ],
            [
                'name' => 'Siti Nurhaliza',
                'email' => 'siti.nurhaliza@yahoo.com',
                'phone' => '082345678901',
                'subject' => 'Keluhan Produk Rusak',
                'message' => 'Pesanan saya dengan nomor ORD202412150001 tiba dalam kondisi rusak. Kemasan botol obat pecah dan isinya tumpah. Mohon segera ditindaklanjuti karena obat tersebut sangat saya butuhkan.',
                'status' => 'replied',
                'priority' => 'urgent',
                'admin_notes' => 'Sudah diverifikasi dengan tim gudang, kesalahan packing. Proses replacement segera.',
                'reply' => 'Mohon maaf atas ketidaknyamanan yang dialami, Bu Siti. Kami sudah memproses pengiriman pengganti tanpa biaya tambahan. Paket akan dikirim hari ini dengan layanan express. Sebagai bentuk permohonan maaf, kami berikan voucher diskon 20% untuk pembelian selanjutnya.',
                'replied_at' => now()->subDays(3),
            ],
            [
                'name' => 'Budi Santoso',
                'email' => 'budi.santoso@hotmail.com',
                'phone' => '083456789012',
                'subject' => 'Cara Konsultasi Online',
                'message' => 'Saya pengguna baru dan ingin bertanya bagaimana cara melakukan konsultasi online dengan dokter? Apakah ada biaya tambahan? Dan spesialisasi apa saja yang tersedia?',
                'status' => 'read',
                'priority' => 'low',
                'admin_notes' => 'Pertanyaan umum, bisa diarahkan ke FAQ.',
            ],
            [
                'name' => 'Dewi Lestari',
                'email' => 'dewi.lestari@gmail.com',
                'phone' => '084567890123',
                'subject' => 'Pembayaran Tidak Terverifikasi',
                'message' => 'Saya sudah melakukan pembayaran untuk pesanan ORD202412180002 sejak kemarin malam, tapi status pembayaran masih pending. Berikut saya lampirkan bukti transfer. Mohon segera diproses.',
                'status' => 'unread',
                'priority' => 'high',
            ],
            [
                'name' => 'Eko Prasetyo',
                'email' => 'eko.prasetyo@outlook.com',
                'phone' => '085678901234',
                'subject' => 'Saran Fitur Baru',
                'message' => 'Saya sangat menyukai layanan HealthFirst. Sebagai saran, bagaimana jika ditambahkan fitur reminder minum obat dan fitur rekam medis pribadi? Pasti akan sangat membantu banyak pengguna.',
                'status' => 'read',
                'priority' => 'low',
                'admin_notes' => 'Forward ke tim product development untuk pertimbangan roadmap.',
            ],
            [
                'name' => 'Fitri Handayani',
                'email' => 'fitri.handayani@gmail.com',
                'phone' => '086789012345',
                'subject' => 'Refund Belum Diterima',
                'message' => 'Pengajuan refund saya untuk pesanan yang dibatalkan sudah 2 minggu, tapi dana belum masuk ke rekening. Nomor pesanan ORD202412010005. Tolong dibantu cek status refund nya.',
                'status' => 'unread',
                'priority' => 'urgent',
            ],
            [
                'name' => 'Gunawan Wijaya',
                'email' => 'gunawan.w@gmail.com',
                'phone' => '087890123456',
                'subject' => 'Pertanyaan Tentang Obat Resep',
                'message' => 'Apakah saya bisa membeli obat antibiotik tanpa resep dokter? Saya sudah pernah menggunakan obat ini sebelumnya atas resep dokter yang sama.',
                'status' => 'replied',
                'priority' => 'medium',
                'reply' => 'Terima kasih telah menghubungi kami, Pak Gunawan. Sesuai regulasi, antibiotik termasuk obat keras yang memerlukan resep dokter yang masih berlaku. Anda bisa melakukan konsultasi online dengan dokter kami untuk mendapatkan resep baru. Biaya konsultasi mulai Rp 25.000.',
                'replied_at' => now()->subDays(1),
            ],
            [
                'name' => 'Hani Kusuma',
                'email' => 'hani.kusuma@yahoo.com',
                'phone' => '088901234567',
                'subject' => 'Kerjasama Bisnis',
                'message' => 'Perkenalkan saya Hani dari PT Medika Sehat. Kami tertarik untuk menjalin kerjasama distribusi produk kesehatan dengan HealthFirst. Apakah bisa diatur jadwal meeting untuk membahas lebih lanjut?',
                'status' => 'read',
                'priority' => 'medium',
                'admin_notes' => 'Forward ke tim Business Development.',
            ],
            [
                'name' => 'Indra Permana',
                'email' => 'indra.permana@gmail.com',
                'phone' => '089012345678',
                'subject' => 'Error Saat Checkout',
                'message' => 'Saya mengalami error saat proses checkout. Halaman loading terus dan tidak bisa melanjutkan pembayaran. Sudah dicoba beberapa kali dengan browser berbeda tetap sama. Mohon bantuan teknisnya.',
                'status' => 'unread',
                'priority' => 'high',
            ],
            [
                'name' => 'Julia Rachman',
                'email' => 'julia.rachman@gmail.com',
                'phone' => '081123456789',
                'subject' => 'Apresiasi Pelayanan',
                'message' => 'Saya ingin mengucapkan terima kasih atas pelayanan yang sangat baik dari tim HealthFirst. Pesanan obat ibu saya yang urgent bisa sampai dalam waktu same day. Customer service juga sangat responsif. Semoga sukses terus!',
                'status' => 'replied',
                'priority' => 'low',
                'reply' => 'Terima kasih banyak atas apresiasi dan kepercayaannya, Bu Julia! Kami sangat senang bisa membantu. Semoga Ibu lekas sembuh. Kami akan terus berusaha memberikan pelayanan terbaik. Salam sehat! 🙏',
                'replied_at' => now()->subHours(12),
            ],
            [
                'name' => 'Kevin Saputra',
                'email' => 'kevin.saputra@outlook.com',
                'phone' => '082234567890',
                'subject' => 'Produk Tidak Tersedia',
                'message' => 'Saya sudah 3 kali mengecek produk Vitamin D3 1000 IU merk Nature Way tapi selalu stock habis. Kapan akan tersedia lagi? Bisakah saya minta notifikasi ketika stock sudah ada?',
                'status' => 'read',
                'priority' => 'medium',
            ],
            [
                'name' => 'Lisa Permata',
                'email' => 'lisa.permata@gmail.com',
                'phone' => '083345678901',
                'subject' => 'Kendala Verifikasi Resep',
                'message' => 'Saya sudah upload resep dokter untuk pembelian obat diabetes, tapi sudah 2 hari belum ada update. Padahal obat ibu saya sudah hampir habis. Bisakah dipercepat proses verifikasinya?',
                'status' => 'unread',
                'priority' => 'urgent',
            ],
            [
                'name' => 'Muhammad Fadlan',
                'email' => 'm.fadlan@gmail.com',
                'phone' => '084456789012',
                'subject' => 'Perbedaan Harga',
                'message' => 'Saya melihat harga Paracetamol di app lebih mahal daripada di website. Apakah memang berbeda? Mana yang benar? Terima kasih.',
                'status' => 'read',
                'priority' => 'low',
            ],
            [
                'name' => 'Nina Safitri',
                'email' => 'nina.safitri@yahoo.com',
                'phone' => '085567890123',
                'subject' => 'Voucher Tidak Bisa Digunakan',
                'message' => 'Saya punya voucher HEALTH50 untuk diskon 50% tapi saat di checkout muncul pesan "voucher tidak valid". Padahal voucher ini baru saya dapat dari email promo kemarin. Mohon dibantu.',
                'status' => 'unread',
                'priority' => 'medium',
            ],
            [
                'name' => 'Oscar Tanujaya',
                'email' => 'oscar.tanujaya@gmail.com',
                'phone' => '086678901234',
                'subject' => 'Permintaan Invoice Perusahaan',
                'message' => 'Saya dari bagian purchasing PT ABC Indonesia. Kami melakukan pembelian rutin produk kesehatan untuk karyawan. Apakah bisa diterbitkan invoice atas nama perusahaan beserta faktur pajak?',
                'status' => 'read',
                'priority' => 'medium',
                'admin_notes' => 'Arahkan ke tim B2B sales untuk follow up corporate account.',
            ],
        ];

        foreach ($messages as $index => $message) {
            ContactMessage::create(array_merge($message, [
                'created_at' => now()->subDays(rand(0, 30))->subHours(rand(0, 23)),
                'updated_at' => now()->subDays(rand(0, 15)),
                'replied_by' => isset($message['replied_at']) ? 1 : null,
            ]));
        }
    }
}
