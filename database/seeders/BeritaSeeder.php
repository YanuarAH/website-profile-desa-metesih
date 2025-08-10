<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Berita;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage; // Import Storage facade
use Illuminate\Support\Facades\File;     // Import File facade

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Pastikan direktori tujuan ada di storage
        $storagePath = 'berita'; // Direktori di dalam storage/app/public
        if (!Storage::disk('public')->exists($storagePath)) {
            Storage::disk('public')->makeDirectory($storagePath);
        }

        $beritaData = [
            [
                'judul' => 'Aksi KKN UNS 141: Bersama Siswa SDN 3 Metesih, Katakan “Tidak” pada Anemia!',
                'konten' => '<p>Dalam rangka mencegah peningkatan kasus anemia pada anak usia sekolah, Mahasiswa KKN Universitas Sebelas Maret (UNS) Kelompok 141 yang diterjunkan di Kecamatan Jiwan, Kabupaten Madiun, melaksanakan program edukasi kesehatan di SDN 03 Metesih. Kegiatan ini dilaksanakan pada bulan Juli 2025 dan menyasar siswa kelas 4 hingga kelas 6 sebagai target utama.

Program edukasi ini bertujuan untuk meningkatkan kesadaran siswa terhadap pentingnya menjaga pola hidup sehat, khususnya dalam hal pola tidur dan pola makan bergizi. Salah satu isu yang diangkat dalam kegiatan ini adalah kebiasaan begadang, yang saat ini mulai banyak dilakukan oleh anak-anak usia Sekolah Dasar, terutama untuk bermain game hingga larut malam.

Kebiasaan begadang tersebut tidak hanya mengganggu waktu istirahat, tetapi juga berdampak pada kesehatan tubuh secara menyeluruh. Kurangnya waktu tidur dapat memengaruhi metabolisme tubuh dan mengganggu proses penyerapan zat besi, yang merupakan faktor penting dalam pencegahan anemia. Hal ini dapat menyebabkan anak mudah lelah, pucat, kurang fokus saat belajar, serta penurunan prestasi di sekolah.

"Anak yang sering begadang dan kurang tidur memiliki risiko lebih tinggi mengalami anemia. Mereka cenderung sulit berkonsentrasi saat mengikuti pelajaran di kelas," ujar salah satu mahasiswa KKN saat menyampaikan materi edukatif kepada para siswa.

Selain memberikan pemahaman tentang penyebab dan dampak anemia, siswa juga diajak untuk memahami cara-cara pencegahannya. Mahasiswa menyampaikan pentingnya mengonsumsi makanan kaya zat besi seperti hati ayam, bayam, kacang-kacangan, dan telur. Tak hanya itu, siswa juga dianjurkan untuk tidur cukup, yaitu minimal 8 hingga 9 jam setiap malam, agar tubuh mereka tetap sehat dan kuat menjalani aktivitas sehari-hari.</p>',
                'tanggal' => '2025-07-17',
                'gambar_sumber' => 'tika.png', // Nama file gambar di public/images/berita/
            ],
            [
                'judul' => 'Tim KKN UNS Berbagi Pengalaman Eksperimen Sains Seru Kepada Siswa SDN 03 Metesih',
                'konten' => '<p>Gelaran Kuliah Kerja Nyata (KKN) Universitas Sebelas Maret (UNS) di Desa Metesih, Kecamatan Jiwan, Kabupaten Madiun, berlangsung penuh semangat. Program KKN ini bertujuan memberikan kontribusi nyata kepada masyarakat, khususnya dalam bidang pendidikan, melalui kegiatan yang edukatif dan menyenangkan bagi siswa.
Salah satu kegiatan menarik datang dari Tim KKN UNS di SDN 03 Metesih, yang mengusung pembelajaran sains melalui eksperimen sederhana namun penuh keseruan. Kegiatan ini dirancang agar siswa tidak hanya mendengar teori, tetapi juga melihat langsung proses ilmiah yang terjadi.
Dalam kegiatan tersebut, siswa diajak mencoba dua eksperimen, yaitu Balon Ajaib dan Lava Lamp. Pada eksperimen Balon Ajaib, siswa mengamati bagaimana campuran soda kue dan cuka menghasilkan gas karbon dioksida yang mampu mengembangkan balon tanpa perlu ditiup. Sementara pada eksperimen Lava Lamp, perpaduan minyak, air berwarna, dan soda kue menciptakan gelembung-gelembung bergerak layaknya lampu hias berwarna-warni.
Siswa tidak hanya mengamati, tetapi juga mempraktikkan langsung eksperimen tersebut dalam kelompok kecil. Selama prosesnya, mereka didampingi oleh tim KKN yang memberikan arahan, membantu menyiapkan bahan, dan menjelaskan konsep sains di balik percobaan. Dengan cara ini, siswa dapat merasakan pengalaman belajar yang lebih aktif, interaktif, dan menyenangkan.
Menurut tim KKN, eksperimen ini penting dilakukan untuk menumbuhkan rasa ingin tahu, melatih keterampilan berpikir kritis, serta membuat pembelajaran sains lebih menyenangkan dan mudah dipahami. “Kami berharap kegiatan ini dapat memotivasi siswa untuk terus belajar dan mencoba hal-hal baru, bahkan dengan alat dan bahan sederhana di sekitar mereka,” ungkap salah satu anggota tim.
Pihak sekolah pun menyambut baik kegiatan ini. Para guru berharap eksperimen sains seperti ini dapat menjadi kegiatan rutin agar siswa semakin dekat dengan dunia sains dan melihat bahwa belajar bisa semenyenangkan ini. Antusiasme siswa pun terlihat jelas selama kegiatan berlangsung. Banyak di antara mereka yang ingin mengulangi percobaan karena merasa penasaran dengan prosesnya. Ke depan, pihak sekolah dan tim KKN berharap pembelajaran dengan pendekatan praktik langsung seperti ini dapat terus dikembangkan di sekolah, sehingga anak-anak semakin akrab dengan dunia sains sekaligus memiliki semangat belajar yang tinggi.
</p>',
                'tanggal' => '2025-07-31',
                'gambar_sumber' => 'aul.png',
            ],
            [
                'judul' => 'Mengembangkan Kreativitas dan Cinta Lingkungan: KKN UNS Gelar Pelatihan Ecoprint untuk Siswa SDN 01 Metesih',
                'konten' => '<p>Di era modern ini, industri fashion mengalami perkembangan pesat yang mendorong para desainer untuk terus berinovasi menciptakan karya dengan motif-motif unik. Kreativitas tidak lagi terbatas pada penggunaan cat atau hiasan payet semata, namun telah merambah pada pemanfaatan bahan-bahan alami seperti dedaunan dan bunga untuk menghasilkan motif yang ramah lingkungan tanpa melibatkan zat kimia berbahaya.
Dalam rangka mempromosikan budaya lokal yang berkelanjutan, sekelompok mahasiswa Kuliah Kerja Nyata (KKN) Universitas Sebelas Maret mengadakan program pelatihan pembuatan totebag dengan teknik ecoprint di Desa Metesih, Kabupaten Madiun. Kegiatan edukatif ini berlangsung pada Jumat, 25 Maret 2025, di SDN 01 Metesih selama dua jam, mulai pukul 08.00 hingga 10.00 WIB, dengan melibatkan 21 siswa kelas 4 dan 5.
Ecoprint adalah metode pewarnaan dan pemberian motif pada berbagai media seperti kain atau kulit menggunakan bahan-bahan organik. Teknik ini memanfaatkan pigmen alami yang terkandung dalam berbagai jenis tumbuhan, mulai dari daun hingga bunga dengan karakteristik warna dan corak yang unik. Produk totebag ecoprint yang dihasilkan tidak sekadar memiliki daya tarik visual yang memukau, tetapi juga merefleksikan komitmen terhadap pelestarian alam dan keanekaragaman hayati.
Dalam praktiknya, terdapat dua pendekatan utama dalam teknik ecoprint: metode steaming dan metode pounding. Untuk kepraktisan pembelajaran, kegiatan ini menggunakan metode pounding yang lebih sederhana dan mudah dipahami anak-anak. Metode ini melibatkan proses pemukulan daun atau bunga yang telah diposisikan di atas totebag menggunakan palu, dengan bantuan lapisan plastik untuk melindungi dan mengekstrak pigmen warna secara optimal.
Antusiasme para siswa terlihat sangat tinggi sepanjang proses pembelajaran. Mereka bebas memilih jenis dedaunan dan bunga sesuai preferensi masing-masing untuk menciptakan desain personal yang unik. Kelompok 141 KKN UNS, selaku penyelenggara kegiatan, menyampaikan harapannya agar program ini dapat memperluas wawasan anak-anak Desa Metesih mengenai potensi tersembunyi dari flora di sekitar mereka.
</p>',
                'tanggal' => '2025-07-25',
                'gambar_sumber' => 'ersyad.png',
            ],
            [
                'judul' => 'Bangun Kesadaran Sejak Dini, Mahasiswa KKN UNS 2025 Gencarkan Edukasi Kesehatan Mental dan Anti Bullying',
                'konten' => '<p>Mahasiswa KKN UNS 2025 Kelompok 141 mengadakan sosialisasi mengenai kesehatan mental dan anti bullying di SDN 01 Metesih, Kec. Jiwan, Kab Madiun (23/7/2025). Kegiatan ini merupakan bagian dari program kerja KKN yang mendukung pencapaian Tujuan Pembangunan Berkelanjutan (Sustainable Development Goals/SDGs), khususnya poin ke-3 tentang Good Health and Well-being serta poin ke-4 tentang Quality Education,

Kegiatan ini dirancang untuk membangun kesadaran sejak dini tentang pentingnya menjaga kesehatan mental dan menciptakan lingkungan belajar yang aman dan suportif. Dengan mengusung tema “Yuk Jadi Teman yang Baik”, mahasiswa KKN UNS menyampaikan edukasi kepada siswa kelas 6 melalui penyuluhan interaktif dan menyenangkan yang menekankan pada penguatan kapasitas anak-anak dalam mengenali, mengelola, dan mengekspresikan emosinya dengan sehat, sekaligus menumbuhkan kesadaran terhadap bahaya perundungan (bullying) di lingkungan sekolah.

Dalam sesi edukasi mahasiswa KKN menjelaskan secara sederhana apa itu kesehatan mental, bagaimana cara mengenali perasaan sendiri, serta langkah-langkah yang bisa dilakukan anak-anak saat mengalami tekanan dan juga menjelaskan mengenai bullying dan dampaknya.

“Sebagai mahasiswa, kami ingin berkontribusi nyata dalam menciptakan ruang belajar yang aman dan sehat bagi anak-anak,” ujar Yanuar, Ketua KKN UNS Kelompok 141. “Kami percaya menciptakan ruang aman untuk anak-anak bisa dimulai dari edukasi yang sederhana namun konsisten,” sambungnya.

Selain penyuluhan yang disampaikan secara langsung di kelas, mahasiswa KKN UNS juga membagikan poster dan worksheet interaktif yang dirancang khusus untuk mendukung pemahaman siswa mengenai pentingnya menjaga kesehatan mental dan mencegah bullying. Poster tersebut berisi pesan positif untuk tidak melakukan perundungan sesama teman dengan menjadi teman yang baik. Sementara itu, worksheet atau lembar kerja diberikan kepada siswa sebagai sarana refleksi pribadi. Di dalamnya terdapat aktivitas untuk menuliskan perasaan yang sedang dirasakan oleh siswa. Melalui cara ini, siswa tidak hanya menjadi pendengar pasif dalam sesi edukasi, tetapi juga diajak berpikir kritis dan melibatkan diri secara aktif.

Dengan semangat pengabdian dan kepedulian sosial, mahasiswa KKN UNS Kelompok 141 berharap kegiatan ini dapat menjadi langkah awal dalam menciptakan generasi muda yang sehat secara mental, empatik, dan bebas dari kekerasan verbal maupun fisik.
</p>',
                'tanggal' => '2025-07-23',
                'gambar_sumber' => 'isti.png',
            ],
        ];

        foreach ($beritaData as $data) {
            $gambarPath = null;
            $sumberFile = public_path('images/berita/' . $data['gambar_sumber']);
            $namaFileTujuan = $data['gambar_sumber']; // Gunakan nama file yang sama

            if (File::exists($sumberFile)) {
                // Salin file dari public ke storage
                Storage::disk('public')->put($storagePath . '/' . $namaFileTujuan, File::get($sumberFile));
                $gambarPath = $storagePath . '/' . $namaFileTujuan; // Path yang akan disimpan di DB
            } else {
                // Jika gambar tidak ditemukan, gunakan placeholder atau null
                // Untuk demo, kita bisa menggunakan placeholder.svg jika tidak ada gambar nyata
                // Atau biarkan null jika Anda ingin menanganinya di view
                $gambarPath = '/placeholder.svg?height=400&width=600&text=' . urlencode($data['judul']);
                // Atau biarkan null: $gambarPath = null;
            }

            Berita::create([
                'judul' => $data['judul'],
                'konten' => $data['konten'],
                'tanggal' => $data['tanggal'],
                'gambar' => $gambarPath, // Simpan path gambar di storage
            ]);
        }
    }
}
