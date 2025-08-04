<?php

namespace Database\Seeders;

use App\Models\StrukturOrganisasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PerangkatDesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $strukturDesa = [
            [
                'nama' => 'Paidjo',
                'jabatan' => 'Kepala Desa',
                'urutan' => '1',
                'foto' => null
            ],
            [
                'nama' => 'Puri Capricorn Ningrum',
                'jabatan' => 'Sekretaris Desa',
                'urutan' => '2',
                'foto' => null
            ],
            [
                'nama' => 'Rahmanto',
                'jabatan' => 'Kasi Pemerintahan',
                'urutan' => '3',
                'foto' => null
            ],
            [
                'nama' => 'Bunga Ayu',
                'jabatan' => 'Kasi Kesejahteraan',
                'urutan' => '3',
                'foto' => null
            ],
            [
                'nama' => 'Sunarsi',
                'jabatan' => 'Kaur Keuangan',
                'urutan' => '3',
                'foto' => null
            ],
        ];

        foreach ($strukturDesa as $data) {
            StrukturOrganisasi::create($data);
        }
    }
}
