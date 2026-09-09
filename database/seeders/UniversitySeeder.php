<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\University;

class UniversitySeeder extends Seeder
{
    public function run()
    {
        $universities = [
            [
                'name' => 'Universitas Indonesia',
                'acronym' => 'UI',
                'color' => '#FF6B35',
                'website' => 'https://ui.ac.id',
                'description' => 'Universitas terbaik di Indonesia dengan berbagai program beasiswa prestisius.',
                'rank' => 1
            ],
            [
                'name' => 'Universitas Gadjah Mada',
                'acronym' => 'UGM',
                'color' => '#4CAF50',
                'website' => 'https://ugm.ac.id',
                'description' => 'Kampus kebangsaan dengan berbagai beasiswa untuk mahasiswa berprestasi.',
                'rank' => 2
            ],
            [
                'name' => 'Institut Teknologi Bandung',
                'acronym' => 'ITB',
                'color' => '#2196F3',
                'website' => 'https://itb.ac.id',
                'description' => 'Institut teknologi unggulan dengan program beasiswa di bidang sains dan teknologi.',
                'rank' => 3
            ],
            [
                'name' => 'Universitas Airlangga',
                'acronym' => 'UNAIR',
                'color' => '#9C27B0',
                'website' => 'https://unair.ac.id',
                'description' => 'Universitas dengan tradisi unggul di bidang kesehatan dan sosial.',
                'rank' => 4
            ],
            [
                'name' => 'Institut Pertanian Bogor',
                'acronym' => 'IPB',
                'color' => '#4CAF50',
                'website' => 'https://ipb.ac.id',
                'description' => 'Pusat unggulan di bidang pertanian dan biosains.',
                'rank' => 5
            ],
            [
                'name' => 'Institut Teknologi Sepuluh Nopember',
                'acronym' => 'ITS',
                'color' => '#F44336',
                'website' => 'https://its.ac.id',
                'description' => 'Kampus teknologi dengan fokus di bidang maritim dan engineering.',
                'rank' => 6
            ],
            [
                'name' => 'Universitas Diponegoro',
                'acronym' => 'UNDIP',
                'color' => '#FF9800',
                'website' => 'https://undip.ac.id',
                'description' => 'Universitas dengan beragam program unggulan di berbagai disiplin ilmu.',
                'rank' => 7
            ],
            [
                'name' => 'Universitas Brawijaya',
                'acronym' => 'UB',
                'color' => '#795548',
                'website' => 'https://ub.ac.id',
                'description' => 'Kampus dengan semangat inovasi dan kewirausahaan.',
                'rank' => 8
            ],
            [
                'name' => 'Universitas Bina Nusantara',
                'acronym' => 'BINUS',
                'color' => '#FF5722',
                'website' => 'https://binus.ac.id',
                'description' => 'Universitas swasta terdepan di bidang teknologi dan bisnis.',
                'rank' => 9
            ],
            [
                'name' => 'Universitas Padjadjaran',
                'acronym' => 'UNPAD',
                'color' => '#009688',
                'website' => 'https://unpad.ac.id',
                'description' => 'Kampus unggulan di Jawa Barat dengan berbagai program internasional.',
                'rank' => 10
            ],
        ];

        foreach ($universities as $uni) {
            University::create($uni);
        }
    }
}