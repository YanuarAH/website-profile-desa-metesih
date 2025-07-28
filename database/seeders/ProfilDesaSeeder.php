<?php

namespace Database\Seeders;

use App\Models\Dusun;
use App\Models\ProfilDesa;
use App\Models\RT;
use App\Models\RW;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfilDesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profilDesa = ProfilDesa::create([
            'nama_desa' => 'Metesih',
            'visi_misi' => 'VISI: Terwujudnya Desa Metesih yang maju, mandiri, sejahtera, dan berkarakter berdasarkan nilai-nilai gotong royong.

MISI:
1. Meningkatkan kualitas pelayanan publik yang prima kepada masyarakat
2. Mengembangkan potensi ekonomi desa berbasis kearifan lokal
3. Memperkuat tata kelola pemerintahan desa yang transparan dan akuntabel
4. Meningkatkan kualitas sumber daya manusia melalui pendidikan dan pelatihan
5. Melestarikan budaya dan tradisi lokal sebagai identitas desa
6. Membangun infrastruktur desa yang mendukung kesejahteraan masyarakat',
            'jumlah_penduduk' => 3250, // Estimasi berdasarkan 27 RT
            'jumlah_rt' => 27,
            'jumlah_rw' => 7,
            'luas_wilayah' => 265.33,
            'batas_utara' => 'Jiwan',
            'batas_selatan' => 'Bukur',
            'batas_timur' => 'Sambirejo',
            'batas_barat' => 'Tegalorium',
        ]);

        // Dusun Krajan
        $dusunKrajan = Dusun::create([
            'nama_dusun' => 'Krajan',
            'profil_desa_id' => $profilDesa->id,
        ]);

        // RW 01 - Dusun Krajan
        $rw01 = RW::create([
            'nomor' => '01',
            'dusun_id' => $dusunKrajan->id,
        ]);

        // RT untuk RW 01
        $rtRw01 = ['01', '02', '03', '04'];
        foreach ($rtRw01 as $rtNomor) {
            RT::create([
                'nomor' => $rtNomor,
                'r_w_id' => $rw01->id,
            ]);
        }

        // RW 02 - Dusun Krajan
        $rw02 = RW::create([ // FIX: Rw -> RW
            'nomor' => '02',
            'dusun_id' => $dusunKrajan->id,
        ]);

        // RT untuk RW 02
        $rtRw02 = ['05', '06', '07'];
        foreach ($rtRw02 as $rtNomor) {
            RT::create([ // FIX: Rt -> RT
                'nomor' => $rtNomor,
                'r_w_id' => $rw02->id,
            ]);
        }

        // RW 05 - Dusun Krajan
        $rw05 = RW::create([ // FIX: Rw -> RW
            'nomor' => '05',
            'dusun_id' => $dusunKrajan->id,
        ]);

        // RT untuk RW 05
        $rtRw05 = ['15', '16', '17'];
        foreach ($rtRw05 as $rtNomor) {
            RT::create([ // FIX: Rt -> RT
                'nomor' => $rtNomor,
                'r_w_id' => $rw05->id,
            ]);
        }

        // Dusun Gendu
        $dusunGendu = Dusun::create([
            'nama_dusun' => 'Gendu',
            'profil_desa_id' => $profilDesa->id,
        ]);

        // RW 03 - Dusun Gendu
        $rw03 = RW::create([ // FIX: Rw -> RW
            'nomor' => '03',
            'dusun_id' => $dusunGendu->id,
        ]);

        // RT untuk RW 03
        $rtRw03 = ['08', '09', '10', '11'];
        foreach ($rtRw03 as $rtNomor) {
            RT::create([ // FIX: Rt -> RT
                'nomor' => $rtNomor,
                'r_w_id' => $rw03->id,
            ]);
        }

        // RW 04 - Dusun Gendu
        $rw04 = RW::create([ // FIX: Rw -> RW
            'nomor' => '04',
            'dusun_id' => $dusunGendu->id,
        ]);

        // RT untuk RW 04
        $rtRw04 = ['12', '13', '14'];
        foreach ($rtRw04 as $rtNomor) {
            RT::create([ // FIX: Rt -> RT
                'nomor' => $rtNomor,
                'r_w_id' => $rw04->id,
            ]);
        }

        // Dusun Koci
        $dusunKoci = Dusun::create([
            'nama_dusun' => 'Koci',
            'profil_desa_id' => $profilDesa->id,
        ]);

        // RW 06 - Dusun Koci
        $rw06 = RW::create([ // FIX: Rw -> RW
            'nomor' => '06',
            'dusun_id' => $dusunKoci->id,
        ]);

        // RT untuk RW 06
        $rtRw06 = ['18', '19', '20', '21'];
        foreach ($rtRw06 as $rtNomor) {
            RT::create([ // FIX: Rt -> RT
                'nomor' => $rtNomor,
                'r_w_id' => $rw06->id,
            ]);
        }

        // Dusun Ngepoh
        $dusunNgepoh = Dusun::create([
            'nama_dusun' => 'Ngepoh',
            'profil_desa_id' => $profilDesa->id,
        ]);

        // RW 07 - Dusun Ngepoh
        $rw07 = RW::create([ // FIX: Rw -> RW
            'nomor' => '07',
            'dusun_id' => $dusunNgepoh->id,
        ]);

        // RT untuk RW 07
        $rtRw07 = ['22', '23', '24', '25', '26', '27'];
        foreach ($rtRw07 as $rtNomor) {
            RT::create([ // FIX: Rt -> RT
                'nomor' => $rtNomor,
                'r_w_id' => $rw07->id,
            ]);
        }
    }
}
