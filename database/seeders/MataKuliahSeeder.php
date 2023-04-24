<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MataKuliahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $matkul=[
            [   'matkul' => 'Pemrograman Berbasis Objek',
                'sks' => '3',
                'jam' => '6',
                'semester' => '4',
            ],
            [   'matkul' => 'Pemrograman Web Lanjut',
                'sks' => '3',
                'jam' => '6',
                'semester' => '4',
            ],
            [   'matkul' => 'Basis Data Lanjut',
                'sks' => '3',
                'jam' => '4',
                'semester' => '4',
            ],
            [   'matkul' => 'Praktikum Basis Data Lanjut',
                'sks' => '3',
                'jam' => '6',
                'semester' => '4',
            ],
        ];

        DB::table('matakuliah')->insert($matkul);
    }
}
