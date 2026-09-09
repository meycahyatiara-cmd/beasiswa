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
            // Kampus Top di Indonesia
            ['name' => 'Universitas Indonesia', 'acronym' => 'UI', 'color' => '#6C5CE7', 'rank' => 1],
            ['name' => 'Universitas Gadjah Mada', 'acronym' => 'UGM', 'color' => '#00B894', 'rank' => 2],
            ['name' => 'Institut Teknologi Bandung', 'acronym' => 'ITB', 'color' => '#0984E3', 'rank' => 3],
            ['name' => 'Universitas Airlangga', 'acronym' => 'UNAIR', 'color' => '#FD79A8', 'rank' => 4],
            ['name' => 'Institut Pertanian Bogor', 'acronym' => 'IPB', 'color' => '#00CEC9', 'rank' => 5],
            ['name' => 'Institut Teknologi Sepuluh Nopember', 'acronym' => 'ITS', 'color' => '#FDCB6E', 'rank' => 6],
            ['name' => 'Universitas Diponegoro', 'acronym' => 'UNDIP', 'color' => '#E17055', 'rank' => 7],
            ['name' => 'Universitas Brawijaya', 'acronym' => 'UB', 'color' => '#6C5CE7', 'rank' => 8],
            ['name' => 'Universitas Padjadjaran', 'acronym' => 'UNPAD', 'color' => '#00B894', 'rank' => 9],
            ['name' => 'Universitas Bina Nusantara', 'acronym' => 'BINUS', 'color' => '#0984E3', 'rank' => 10],
            
            // Kampus Tambahan
            ['name' => 'Universitas Sumatera Utara', 'acronym' => 'USU', 'color' => '#FD79A8', 'rank' => 11],
            ['name' => 'Universitas Andalas', 'acronym' => 'UNAND', 'color' => '#00CEC9', 'rank' => 12],
            ['name' => 'Universitas Hasanuddin', 'acronym' => 'UNHAS', 'color' => '#FDCB6E', 'rank' => 13],
            ['name' => 'Universitas Sriwijaya', 'acronym' => 'UNSRI', 'color' => '#E17055', 'rank' => 14],
            ['name' => 'Universitas Negeri Malang', 'acronym' => 'UM', 'color' => '#6C5CE7', 'rank' => 15],
            ['name' => 'Universitas Negeri Jakarta', 'acronym' => 'UNJ', 'color' => '#00B894', 'rank' => 16],
            ['name' => 'Universitas Pendidikan Indonesia', 'acronym' => 'UPI', 'color' => '#0984E3', 'rank' => 17],
            ['name' => 'Universitas Sebelas Maret', 'acronym' => 'UNS', 'color' => '#FD79A8', 'rank' => 18],
            ['name' => 'Universitas Riau', 'acronym' => 'UNRI', 'color' => '#00CEC9', 'rank' => 19],
            ['name' => 'Universitas Jenderal Soedirman', 'acronym' => 'UNSOED', 'color' => '#FDCB6E', 'rank' => 20],
            ['name' => 'Universitas Mulawarman', 'acronym' => 'UNMUL', 'color' => '#E17055', 'rank' => 21],
            ['name' => 'Universitas Udayana', 'acronym' => 'UNUD', 'color' => '#6C5CE7', 'rank' => 22],
        ];

        foreach ($universities as $uni) {
            DB::table('universities')->insert([
                'name' => $uni['name'],
                'acronym' => $uni['acronym'],
                'color' => $uni['color'],
                'rank' => $uni['rank'],
                'is_active' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
    }
}