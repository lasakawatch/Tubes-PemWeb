<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();
        $doctors = User::where('role', 'doctor')->get();

        if (!$admin) {
            $this->command->warn('Please run AdminSeeder first!');
            return;
        }

        $articles = [
            [
                'title' => '10 Tips Menjaga Kesehatan di Musim Hujan',
                'excerpt' => 'Musim hujan membawa berbagai tantangan kesehatan. Berikut tips praktis untuk menjaga daya tahan tubuh Anda.',
                'content' => '<h2>Mengapa Kesehatan di Musim Hujan Penting?</h2>
<p>Musim hujan sering kali menjadi waktu di mana banyak orang mengalami penurunan daya tahan tubuh. Perubahan cuaca yang drastis, kelembaban tinggi, dan paparan virus yang meningkat membuat kita lebih rentan terhadap penyakit.</p>

<h3>1. Konsumsi Vitamin C Secukupnya</h3>
<p>Vitamin C berperan penting dalam meningkatkan sistem imun. Konsumsi buah-buahan seperti jeruk, jambu biji, dan papaya secara rutin.</p>

<h3>2. Jaga Kebersihan Tangan</h3>
<p>Cuci tangan dengan sabun secara teratur, terutama sebelum makan dan setelah bepergian dari luar rumah.</p>

<h3>3. Istirahat yang Cukup</h3>
<p>Tidur 7-8 jam sehari membantu tubuh memperbaiki sel-sel yang rusak dan memperkuat sistem imun.</p>

<h3>4. Hindari Makanan Tidak Bersih</h3>
<p>Pastikan makanan yang dikonsumsi bersih dan dimasak dengan matang untuk menghindari infeksi bakteri.</p>

<h3>5. Gunakan Payung atau Jas Hujan</h3>
<p>Hindari kehujanan langsung yang dapat menurunkan suhu tubuh dan memicu flu.</p>

<h3>6. Olahraga Teratur</h3>
<p>Meski cuaca mendung, tetap lakukan olahraga ringan di dalam ruangan untuk menjaga kebugaran.</p>

<h3>7. Minum Air Putih yang Cukup</h3>
<p>Tetap hidrasi dengan minum minimal 8 gelas air putih sehari.</p>

<h3>8. Konsumsi Makanan Hangat</h3>
<p>Sup, teh hangat, dan makanan berkuah dapat membantu menghangatkan tubuh.</p>

<h3>9. Jaga Kebersihan Lingkungan</h3>
<p>Bersihkan rumah secara rutin untuk mencegah perkembangbiakan nyamuk dan bakteri.</p>

<h3>10. Segera Berobat Jika Sakit</h3>
<p>Jangan tunggu sampai parah. Konsultasikan ke dokter segera jika mengalami gejala flu berkepanjangan.</p>',
                'category' => 'health_tips',
                'tags' => ['musim hujan', 'tips kesehatan', 'daya tahan tubuh', 'vitamin C'],
                'status' => 'published',
                'views' => rand(500, 2000),
            ],
            [
                'title' => 'Mengenal Diabetes Mellitus: Penyebab, Gejala, dan Pencegahan',
                'excerpt' => 'Diabetes mellitus adalah penyakit kronis yang mempengaruhi cara tubuh memproses gula darah. Kenali lebih dalam.',
                'content' => '<h2>Apa itu Diabetes Mellitus?</h2>
<p>Diabetes mellitus adalah kondisi di mana kadar gula (glukosa) dalam darah terlalu tinggi. Glukosa adalah sumber energi utama tubuh yang berasal dari makanan yang kita konsumsi.</p>

<h3>Jenis-jenis Diabetes</h3>
<h4>1. Diabetes Tipe 1</h4>
<p>Terjadi ketika sistem kekebalan tubuh menyerang sel-sel yang memproduksi insulin di pankreas. Biasanya muncul pada anak-anak dan remaja.</p>

<h4>2. Diabetes Tipe 2</h4>
<p>Tipe yang paling umum, terjadi ketika tubuh tidak dapat menggunakan insulin dengan efektif. Sering dikaitkan dengan gaya hidup tidak sehat.</p>

<h4>3. Diabetes Gestasional</h4>
<p>Diabetes yang berkembang selama kehamilan dan biasanya hilang setelah melahirkan.</p>

<h3>Gejala Umum Diabetes</h3>
<ul>
<li>Sering buang air kecil</li>
<li>Rasa haus berlebihan</li>
<li>Penurunan berat badan tanpa sebab</li>
<li>Luka yang sulit sembuh</li>
<li>Pandangan kabur</li>
<li>Kelelahan ekstrem</li>
</ul>

<h3>Faktor Risiko</h3>
<ul>
<li>Kelebihan berat badan</li>
<li>Kurang aktivitas fisik</li>
<li>Riwayat keluarga diabetes</li>
<li>Usia di atas 45 tahun</li>
<li>Tekanan darah tinggi</li>
</ul>

<h3>Pencegahan Diabetes</h3>
<ol>
<li>Jaga berat badan ideal</li>
<li>Olahraga minimal 30 menit sehari</li>
<li>Kurangi konsumsi gula dan karbohidrat sederhana</li>
<li>Perbanyak sayur dan buah</li>
<li>Periksa gula darah secara rutin</li>
</ol>

<p><strong>Penting:</strong> Konsultasikan dengan dokter jika Anda mengalami gejala-gejala di atas atau memiliki faktor risiko diabetes.</p>',
                'category' => 'disease_info',
                'tags' => ['diabetes', 'gula darah', 'penyakit kronis', 'pencegahan'],
                'status' => 'published',
                'views' => rand(800, 3000),
            ],
            [
                'title' => 'Panduan Lengkap Penggunaan Antibiotik yang Benar',
                'excerpt' => 'Antibiotik sering disalahgunakan. Pelajari cara menggunakan antibiotik dengan benar untuk hasil pengobatan optimal.',
                'content' => '<h2>Apa itu Antibiotik?</h2>
<p>Antibiotik adalah obat yang digunakan untuk mengobati infeksi yang disebabkan oleh bakteri. Antibiotik TIDAK efektif untuk infeksi virus seperti flu atau pilek.</p>

<h3>Kapan Antibiotik Diperlukan?</h3>
<p>Antibiotik diperlukan untuk:</p>
<ul>
<li>Infeksi saluran kemih</li>
<li>Pneumonia bakterial</li>
<li>Infeksi telinga berat</li>
<li>Infeksi kulit</li>
<li>Tuberkulosis</li>
</ul>

<h3>Aturan Penggunaan Antibiotik</h3>

<h4>1. Harus dengan Resep Dokter</h4>
<p>Jangan membeli antibiotik tanpa resep. Dokter akan menentukan jenis antibiotik yang tepat berdasarkan infeksi yang dialami.</p>

<h4>2. Habiskan Seluruh Dosis</h4>
<p>Meski merasa sudah sembuh, tetap habiskan antibiotik sesuai resep untuk memastikan semua bakteri mati.</p>

<h4>3. Ikuti Waktu Minum yang Tepat</h4>
<p>Jika diresepkan 3x sehari, minum setiap 8 jam. Konsistensi waktu penting untuk efektivitas obat.</p>

<h4>4. Perhatikan Instruksi Khusus</h4>
<p>Beberapa antibiotik harus diminum sebelum atau sesudah makan. Ikuti petunjuk dengan benar.</p>

<h3>Bahaya Resistensi Antibiotik</h3>
<p>Penggunaan antibiotik yang salah dapat menyebabkan bakteri menjadi resisten (kebal). Hal ini membuat infeksi lebih sulit diobati di masa depan.</p>

<h3>Yang Harus Dihindari</h3>
<ul>
<li>Berbagi antibiotik dengan orang lain</li>
<li>Menyimpan sisa antibiotik untuk digunakan nanti</li>
<li>Menghentikan antibiotik sebelum waktunya</li>
<li>Meminta antibiotik untuk flu atau batuk biasa</li>
</ul>

<p><em>Selalu konsultasikan dengan dokter atau apoteker jika ada pertanyaan tentang penggunaan antibiotik.</em></p>',
                'category' => 'medicine_info',
                'tags' => ['antibiotik', 'obat', 'infeksi bakteri', 'resistensi'],
                'status' => 'published',
                'views' => rand(600, 1800),
            ],
            [
                'title' => 'Makanan Sehat untuk Menjaga Kesehatan Jantung',
                'excerpt' => 'Diet yang tepat berperan besar dalam menjaga kesehatan jantung. Ketahui makanan apa saja yang baik untuk jantung Anda.',
                'content' => '<h2>Pentingnya Diet Sehat untuk Jantung</h2>
<p>Penyakit jantung adalah penyebab kematian utama di dunia. Salah satu cara terbaik untuk mencegahnya adalah dengan menjaga pola makan yang sehat.</p>

<h3>Makanan yang Baik untuk Jantung</h3>

<h4>1. Ikan Berlemak</h4>
<p>Salmon, makarel, dan sarden kaya akan omega-3 yang dapat menurunkan risiko aritmia dan aterosklerosis.</p>

<h4>2. Kacang-kacangan</h4>
<p>Almond, kenari, dan kacang tanah mengandung lemak sehat, protein, dan serat yang baik untuk jantung.</p>

<h4>3. Sayuran Hijau</h4>
<p>Bayam, kangkung, dan brokoli kaya vitamin K yang membantu melindungi arteri.</p>

<h4>4. Oatmeal</h4>
<p>Serat larut dalam oatmeal membantu menurunkan kolesterol jahat (LDL).</p>

<h4>5. Buah Berry</h4>
<p>Strawberry, blueberry, dan raspberry kaya antioksidan yang melawan peradangan.</p>

<h4>6. Alpukat</h4>
<p>Sumber lemak tak jenuh tunggal yang dapat menurunkan kolesterol dan risiko penyakit jantung.</p>

<h4>7. Minyak Zaitun</h4>
<p>Pengganti minyak goreng yang lebih sehat dengan kandungan antioksidan tinggi.</p>

<h4>8. Teh Hijau</h4>
<p>Kaya katekin dan antioksidan yang membantu melindungi pembuluh darah.</p>

<h3>Makanan yang Harus Dibatasi</h3>
<ul>
<li>Makanan tinggi natrium (garam)</li>
<li>Makanan olahan dan cepat saji</li>
<li>Minuman manis</li>
<li>Lemak trans dan lemak jenuh</li>
<li>Daging merah berlebihan</li>
</ul>

<h3>Tips Diet Sehat Jantung</h3>
<ol>
<li>Makan porsi kecil tapi sering</li>
<li>Kurangi garam dalam masakan</li>
<li>Pilih metode memasak kukus, panggang, atau rebus</li>
<li>Baca label nutrisi sebelum membeli makanan kemasan</li>
</ol>',
                'category' => 'nutrition',
                'tags' => ['kesehatan jantung', 'diet sehat', 'nutrisi', 'makanan sehat'],
                'status' => 'published',
                'views' => rand(700, 2500),
            ],
            [
                'title' => 'Mengatasi Stres dan Kecemasan di Era Modern',
                'excerpt' => 'Tekanan hidup modern sering menyebabkan stres. Pelajari cara mengelola stres untuk kesehatan mental yang lebih baik.',
                'content' => '<h2>Memahami Stres dan Kecemasan</h2>
<p>Stres adalah respons alami tubuh terhadap tekanan atau tantangan. Namun, stres berkepanjangan dapat berdampak negatif pada kesehatan fisik dan mental.</p>

<h3>Tanda-tanda Stres Berlebih</h3>
<ul>
<li>Sulit tidur atau insomnia</li>
<li>Mudah marah atau tersinggung</li>
<li>Sulit berkonsentrasi</li>
<li>Sakit kepala atau tegang otot</li>
<li>Perubahan nafsu makan</li>
<li>Perasaan cemas berlebihan</li>
</ul>

<h3>Teknik Mengelola Stres</h3>

<h4>1. Teknik Pernapasan</h4>
<p>Latihan pernapasan dalam dapat menenangkan sistem saraf. Tarik napas dalam 4 detik, tahan 4 detik, hembuskan 4 detik.</p>

<h4>2. Meditasi dan Mindfulness</h4>
<p>Luangkan 10-15 menit sehari untuk meditasi. Fokus pada saat ini dan biarkan pikiran negatif berlalu.</p>

<h4>3. Olahraga Teratur</h4>
<p>Aktivitas fisik melepaskan endorfin yang membuat perasaan lebih baik. Berjalan kaki 30 menit sehari sudah cukup membantu.</p>

<h4>4. Tidur yang Cukup</h4>
<p>Kurang tidur memperburuk stres. Usahakan tidur 7-8 jam dengan kualitas baik setiap malam.</p>

<h4>5. Batasi Konsumsi Kafein dan Alkohol</h4>
<p>Kedua zat ini dapat memperburuk gejala kecemasan.</p>

<h4>6. Luangkan Waktu untuk Hobi</h4>
<p>Aktivitas yang disukai dapat menjadi pelarian sehat dari tekanan sehari-hari.</p>

<h4>7. Berbicara dengan Seseorang</h4>
<p>Berbagi perasaan dengan teman, keluarga, atau profesional dapat sangat membantu.</p>

<h3>Kapan Harus Mencari Bantuan Profesional?</h3>
<p>Jika stres mengganggu aktivitas sehari-hari, menyebabkan pikiran untuk menyakiti diri sendiri, atau berlangsung lebih dari beberapa minggu, segera konsultasikan dengan psikolog atau psikiater.</p>

<p><strong>Ingat:</strong> Meminta bantuan adalah tanda kekuatan, bukan kelemahan.</p>',
                'category' => 'mental_health',
                'tags' => ['kesehatan mental', 'stres', 'kecemasan', 'meditasi'],
                'status' => 'published',
                'views' => rand(900, 3500),
            ],
            [
                'title' => 'Olahraga yang Aman untuk Pemula',
                'excerpt' => 'Ingin mulai berolahraga tapi bingung mulai dari mana? Panduan lengkap olahraga untuk pemula.',
                'content' => '<h2>Memulai Perjalanan Kebugaran</h2>
<p>Memulai rutinitas olahraga bisa terasa menakutkan. Namun, dengan pendekatan yang tepat, siapa pun bisa menjadi lebih aktif dan sehat.</p>

<h3>Persiapan Sebelum Berolahraga</h3>
<ul>
<li>Konsultasi dengan dokter jika memiliki kondisi kesehatan tertentu</li>
<li>Siapkan pakaian dan sepatu yang nyaman</li>
<li>Pilih waktu yang konsisten setiap hari</li>
<li>Tetapkan target yang realistis</li>
</ul>

<h3>Jenis Olahraga untuk Pemula</h3>

<h4>1. Jalan Kaki</h4>
<p>Aktivitas paling sederhana tapi efektif. Mulai dengan 15-20 menit dan tingkatkan bertahap.</p>

<h4>2. Berenang</h4>
<p>Baik untuk seluruh tubuh dan minim risiko cedera karena tidak membebani sendi.</p>

<h4>3. Bersepeda</h4>
<p>Menyenangkan dan bisa dilakukan outdoor atau dengan sepeda statis.</p>

<h4>4. Yoga</h4>
<p>Meningkatkan fleksibilitas, keseimbangan, dan membantu relaksasi.</p>

<h4>5. Senam Aerobik</h4>
<p>Banyak video gratis online yang bisa diikuti di rumah.</p>

<h3>Struktur Latihan Dasar</h3>
<ol>
<li><strong>Pemanasan (5-10 menit):</strong> Jalan di tempat, gerakan dinamis ringan</li>
<li><strong>Latihan Inti (20-30 menit):</strong> Aktivitas utama pilihan</li>
<li><strong>Pendinginan (5-10 menit):</strong> Peregangan statis</li>
</ol>

<h3>Tips Penting</h3>
<ul>
<li>Mulai perlahan, jangan memaksakan diri</li>
<li>Dengarkan tubuh Anda</li>
<li>Tetap terhidrasi</li>
<li>Istirahat cukup antara sesi latihan</li>
<li>Variasikan jenis olahraga untuk menghindari kebosanan</li>
</ul>

<h3>Jadwal yang Disarankan untuk Pemula</h3>
<p>Mulai dengan 3 kali seminggu, masing-masing 30 menit. Setelah 4-6 minggu, tingkatkan frekuensi atau durasi.</p>

<p><em>Konsistensi lebih penting daripada intensitas. Lebih baik olahraga ringan secara teratur daripada berat tapi jarang.</em></p>',
                'category' => 'fitness',
                'tags' => ['olahraga', 'kebugaran', 'pemula', 'gaya hidup sehat'],
                'status' => 'published',
                'views' => rand(600, 2200),
            ],
            [
                'title' => 'Pola Hidup Sehat untuk Mencegah Penyakit Kronis',
                'excerpt' => 'Pencegahan lebih baik dari pengobatan. Terapkan pola hidup sehat untuk menghindari berbagai penyakit kronis.',
                'content' => '<h2>Pentingnya Pencegahan Penyakit</h2>
<p>Penyakit kronis seperti jantung, diabetes, dan kanker seringkali dapat dicegah dengan gaya hidup sehat. Investasi pada kesehatan hari ini menentukan kualitas hidup di masa depan.</p>

<h3>Pilar Pola Hidup Sehat</h3>

<h4>1. Pola Makan Seimbang</h4>
<p>Konsumsi makanan bervariasi dengan proporsi yang tepat. Perbanyak sayur, buah, protein tanpa lemak, dan biji-bijian utuh.</p>

<h4>2. Aktivitas Fisik Teratur</h4>
<p>Minimal 150 menit aktivitas sedang atau 75 menit aktivitas intens per minggu.</p>

<h4>3. Tidak Merokok</h4>
<p>Merokok adalah faktor risiko utama berbagai penyakit. Berhenti merokok segera meningkatkan kesehatan.</p>

<h4>4. Batasi Alkohol</h4>
<p>Jika mengonsumsi alkohol, batasi konsumsinya sesuai rekomendasi kesehatan.</p>

<h4>5. Kelola Stres</h4>
<p>Stres kronis merusak kesehatan. Temukan cara sehat untuk mengelolanya.</p>

<h4>6. Tidur Berkualitas</h4>
<p>Tidur 7-9 jam per malam penting untuk pemulihan tubuh.</p>

<h4>7. Pemeriksaan Kesehatan Rutin</h4>
<p>Deteksi dini meningkatkan peluang pengobatan sukses.</p>

<h3>Pemeriksaan yang Direkomendasikan</h3>
<ul>
<li>Tekanan darah: minimal setahun sekali</li>
<li>Gula darah: setiap 3 tahun (lebih sering jika berisiko)</li>
<li>Kolesterol: setiap 4-6 tahun</li>
<li>Pap smear (wanita): setiap 3 tahun</li>
<li>Mammogram (wanita 40+): setiap 1-2 tahun</li>
<li>Kolonoskopi (50+): setiap 10 tahun</li>
</ul>

<h3>Mulai Perubahan Hari Ini</h3>
<p>Tidak perlu mengubah semuanya sekaligus. Mulai dengan satu kebiasaan baru, kuasai, lalu tambahkan yang lain.</p>',
                'category' => 'lifestyle',
                'tags' => ['pola hidup sehat', 'pencegahan', 'penyakit kronis', 'medical checkup'],
                'status' => 'published',
                'views' => rand(500, 1800),
            ],
            [
                'title' => 'Update Terbaru: Vaksin COVID-19 Booster Kedua',
                'excerpt' => 'Informasi terkini mengenai vaksin booster COVID-19 dan siapa saja yang direkomendasikan mendapatkannya.',
                'content' => '<h2>Perkembangan Vaksinasi COVID-19</h2>
<p>Program vaksinasi COVID-19 terus berkembang seiring pemahaman kita tentang virus dan varian-variannya. Vaksin booster kedua kini direkomendasikan untuk kelompok tertentu.</p>

<h3>Siapa yang Perlu Booster Kedua?</h3>
<ul>
<li>Lansia usia 60 tahun ke atas</li>
<li>Individu dengan sistem imun lemah</li>
<li>Tenaga kesehatan</li>
<li>Pekerja di fasilitas perawatan jangka panjang</li>
</ul>

<h3>Jenis Vaksin yang Tersedia</h3>
<p>Saat ini tersedia beberapa jenis vaksin untuk booster, termasuk vaksin bivalent yang menargetkan strain asli dan varian Omicron.</p>

<h3>Efek Samping yang Mungkin Terjadi</h3>
<p>Efek samping umumnya ringan dan sementara:</p>
<ul>
<li>Nyeri di tempat suntikan</li>
<li>Kelelahan</li>
<li>Sakit kepala</li>
<li>Nyeri otot</li>
<li>Demam ringan</li>
</ul>

<h3>Pentingnya Tetap Waspada</h3>
<p>Meski vaksin memberikan perlindungan, tetap terapkan protokol kesehatan seperti mencuci tangan dan memakai masker di tempat ramai saat diperlukan.</p>

<p><strong>Konsultasikan dengan dokter untuk informasi lebih lanjut tentang vaksinasi yang tepat untuk Anda.</strong></p>',
                'category' => 'news',
                'tags' => ['COVID-19', 'vaksin', 'booster', 'kesehatan masyarakat'],
                'status' => 'published',
                'views' => rand(1200, 4000),
            ],
            [
                'title' => 'Cara Menjaga Kesehatan Mata di Era Digital',
                'excerpt' => 'Paparan layar terus-menerus dapat mempengaruhi kesehatan mata. Pelajari cara melindungi mata Anda.',
                'content' => '<h2>Dampak Layar Digital pada Mata</h2>
<p>Di era digital, kita menghabiskan rata-rata 6-8 jam sehari menatap layar. Hal ini dapat menyebabkan sindrom penglihatan komputer atau digital eye strain.</p>

<h3>Gejala Digital Eye Strain</h3>
<ul>
<li>Mata lelah dan kering</li>
<li>Penglihatan kabur</li>
<li>Sakit kepala</li>
<li>Nyeri leher dan bahu</li>
<li>Kesulitan fokus</li>
</ul>

<h3>Tips Melindungi Mata</h3>

<h4>1. Aturan 20-20-20</h4>
<p>Setiap 20 menit, lihat objek sejauh 20 kaki (6 meter) selama 20 detik.</p>

<h4>2. Atur Pencahayaan</h4>
<p>Pastikan ruangan cukup terang dan kurangi silau pada layar.</p>

<h4>3. Posisi Layar yang Tepat</h4>
<p>Layar harus sejajar atau sedikit di bawah mata, dengan jarak 50-70 cm.</p>

<h4>4. Kedipkan Mata Secara Sadar</h4>
<p>Saat fokus pada layar, kita cenderung lebih jarang berkedip. Usahakan berkedip lebih sering.</p>

<h4>5. Gunakan Air Mata Buatan</h4>
<p>Tetes mata dapat membantu menjaga kelembaban mata.</p>

<h4>6. Kacamata Anti Blue Light</h4>
<p>Pertimbangkan menggunakan kacamata khusus untuk menyaring cahaya biru.</p>

<h4>7. Periksa Mata Rutin</h4>
<p>Kunjungi dokter mata setidaknya setahun sekali untuk pemeriksaan komprehensif.</p>

<p><em>Jaga kesehatan mata Anda, karena penglihatan yang baik sangat berharga.</em></p>',
                'category' => 'health_tips',
                'tags' => ['kesehatan mata', 'digital', 'layar', 'tips'],
                'status' => 'published',
                'views' => rand(400, 1500),
            ],
            [
                'title' => 'Manfaat Tidur Cukup untuk Kesehatan Tubuh',
                'excerpt' => 'Tidur bukan hanya istirahat, tapi proses vital untuk kesehatan. Ketahui manfaat tidur yang cukup.',
                'content' => '<h2>Mengapa Tidur Itu Penting?</h2>
<p>Tidur adalah kebutuhan biologis dasar yang sama pentingnya dengan makan dan minum. Selama tidur, tubuh melakukan berbagai proses penting untuk kesehatan.</p>

<h3>Manfaat Tidur yang Cukup</h3>

<h4>1. Meningkatkan Sistem Imun</h4>
<p>Selama tidur, sistem imun memproduksi protein pelindung yang melawan infeksi dan peradangan.</p>

<h4>2. Memperbaiki Sel dan Jaringan</h4>
<p>Hormon pertumbuhan dilepaskan selama tidur, membantu perbaikan otot dan jaringan.</p>

<h4>3. Meningkatkan Fungsi Otak</h4>
<p>Tidur membantu konsolidasi memori dan meningkatkan kemampuan belajar.</p>

<h4>4. Mengatur Metabolisme</h4>
<p>Kurang tidur dikaitkan dengan risiko obesitas dan diabetes.</p>

<h4>5. Menjaga Kesehatan Mental</h4>
<p>Tidur cukup membantu mengatur emosi dan mengurangi risiko depresi.</p>

<h4>6. Kesehatan Jantung</h4>
<p>Tidur yang cukup membantu mengatur tekanan darah dan mengurangi stres pada jantung.</p>

<h3>Tips Tidur Lebih Baik</h3>
<ol>
<li>Pertahankan jadwal tidur yang konsisten</li>
<li>Buat lingkungan kamar yang nyaman</li>
<li>Hindari kafein dan alkohol sebelum tidur</li>
<li>Matikan gadget 1 jam sebelum tidur</li>
<li>Lakukan aktivitas relaksasi sebelum tidur</li>
</ol>

<h3>Berapa Lama Tidur yang Ideal?</h3>
<ul>
<li>Dewasa: 7-9 jam</li>
<li>Remaja: 8-10 jam</li>
<li>Anak sekolah: 9-11 jam</li>
<li>Balita: 10-13 jam</li>
</ul>

<p><strong>Prioritaskan tidur Anda seperti Anda memprioritaskan olahraga dan pola makan sehat.</strong></p>',
                'category' => 'lifestyle',
                'tags' => ['tidur', 'istirahat', 'kesehatan', 'gaya hidup'],
                'status' => 'published',
                'views' => rand(550, 2000),
            ],
        ];

        foreach ($articles as $index => $articleData) {
            $author = $doctors->isNotEmpty() && $index % 2 === 0 ? $doctors->random() : $admin;
            
            Article::create([
                'title' => $articleData['title'],
                'slug' => Str::slug($articleData['title']),
                'excerpt' => $articleData['excerpt'],
                'content' => $articleData['content'],
                'category' => $articleData['category'],
                'tags' => $articleData['tags'],
                'author_id' => $author->id,
                'status' => $articleData['status'],
                'views' => $articleData['views'],
                'published_at' => now()->subDays(rand(1, 90)),
            ]);
        }
    }
}
