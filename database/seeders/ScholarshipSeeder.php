<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Scholarship;
use App\Models\University;

class ScholarshipSeeder extends Seeder
{
    public function run()
    {
        $scholarships = [
            [
                'university_acronym' => 'UI',
                'title' => 'Beasiswa Unggulan UI',
                'description' => 'Beasiswa penuh untuk mahasiswa berprestasi di Universitas Indonesia.',
                'type' => 'full',
                'level' => 'S1',
                'field_of_study' => 'Semua Jurusan',
                'deadline' => '2026-12-31',
                'requirements' => 'IPK minimal 3.5, aktif dalam organisasi',
                'quota' => 50
            ],
            [
                'university_acronym' => 'UGM',
                'title' => 'Beasiswa Prestasi UGM',
                'description' => 'Beasiswa parsial untuk mahasiswa berprestasi di Universitas Gadjah Mada.',
                'type' => 'partial',
                'level' => 'S1',
                'field_of_study' => 'Semua Jurusan',
                'deadline' => '2026-11-30',
                'requirements' => 'IPK minimal 3.3',
                'quota' => 100
            ],
            [
                'university_acronym' => 'ITB',
                'title' => 'Beasiswa Teknologi ITB',
                'description' => 'Beasiswa penuh untuk mahasiswa di bidang sains dan teknologi.',
                'type' => 'full',
                'level' => 'S1',
                'field_of_study' => 'Teknik, Sains',
                'deadline' => '2026-10-15',
                'requirements' => 'IPK minimal 3.6, memiliki prestasi di bidang teknologi',
                'quota' => 30
            ],
            [
                'university_acronym' => 'UNAIR',
                'title' => 'Beasiswa Kesehatan UNAIR',
                'description' => 'Beasiswa parsial untuk mahasiswa di bidang kesehatan.',
                'type' => 'partial',
                'level' => 'S1',
                'field_of_study' => 'Kedokteran, Farmasi, Kesehatan Masyarakat',
                'deadline' => '2026-09-30',
                'requirements' => 'IPK minimal 3.4',
                'quota' => 40
            ],
            [
                'university_acronym' => 'IPB',
                'title' => 'Beasiswa Pertanian IPB',
                'description' => 'Beasiswa penuh untuk mahasiswa di bidang pertanian dan biosains.',
                'type' => 'full',
                'level' => 'S1',
                'field_of_study' => 'Pertanian, Kehutanan, Perikanan',
                'deadline' => '2026-08-20',
                'requirements' => 'IPK minimal 3.5, memiliki minat di bidang pertanian',
                'quota' => 25
            ],
            [
                'university_acronym' => 'ITS',
                'title' => 'Beasiswa Maritim ITS',
                'description' => 'Beasiswa parsial untuk mahasiswa di bidang maritim dan engineering.',
                'type' => 'partial',
                'level' => 'S1',
                'field_of_study' => 'Teknik Kelautan, Teknik Perkapalan',
                'deadline' => '2026-07-15',
                'requirements' => 'IPK minimal 3.2',
                'quota' => 35
            ],
        ];

        foreach ($scholarships as $scholarship) {
            $university = University::where('acronym', $scholarship['university_acronym'])->first();
            if ($university) {
                unset($scholarship['university_acronym']);
                $scholarship['university_id'] = $university->id;
                Scholarship::create($scholarship);
            }
        }
    }
}