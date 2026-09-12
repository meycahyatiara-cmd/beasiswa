<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UniversitySeeder extends Seeder
{
    public function run()
    {
        DB::table('universities')->truncate();
        
        $universities = [
            ['name' => 'Universitas Indonesia', 'acronym' => 'UI', 'color' => '#6C5CE7', 'rank' => 1, 'logo' => 'images/ui.png'],
            ['name' => 'Universitas Gadjah Mada', 'acronym' => 'UGM', 'color' => '#00B894', 'rank' => 2, 'logo' => 'images/ugm.png'],
            ['name' => 'Institut Teknologi Bandung', 'acronym' => 'ITB', 'color' => '#0984E3', 'rank' => 3, 'logo' => 'images/itb.png'],
            ['name' => 'Universitas Airlangga', 'acronym' => 'UNAIR', 'color' => '#FD79A8', 'rank' => 4, 'logo' => 'images/unair.png'],
            ['name' => 'Institut Pertanian Bogor', 'acronym' => 'IPB', 'color' => '#00CEC9', 'rank' => 5, 'logo' => 'images/ipb.png'],
            ['name' => 'Institut Teknologi Sepuluh Nopember', 'acronym' => 'ITS', 'color' => '#FDCB6E', 'rank' => 6, 'logo' => 'images/its.png'],
            ['name' => 'Universitas Diponegoro', 'acronym' => 'UNDIP', 'color' => '#E17055', 'rank' => 7, 'logo' => 'images/undip.png'],
            ['name' => 'Universitas Brawijaya', 'acronym' => 'UB', 'color' => '#6C5CE7', 'rank' => 8, 'logo' => 'images/ub.png'],
            ['name' => 'Universitas Padjadjaran', 'acronym' => 'UNPAD', 'color' => '#00B894', 'rank' => 9, 'logo' => 'images/unpad.png'],
            ['name' => 'Universitas Bina Nusantara', 'acronym' => 'BINUS', 'color' => '#0984E3', 'rank' => 10, 'logo' => 'images/binus.png'],
        ];

        foreach ($universities as $uni) {
            DB::table('universities')->insert([
                'name' => $uni['name'],
                'acronym' => $uni['acronym'],
                'color' => $uni['color'],
                'rank' => $uni['rank'],
                'logo' => $uni['logo'],
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}