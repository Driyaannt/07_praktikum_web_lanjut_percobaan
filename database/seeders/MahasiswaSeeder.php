<?php

namespace Database\Seeders;

use App\Models\Mahasiswa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
//        DB::table('mahasiswas')->insert([
//            'Nim' => '21417202214',
//            'Nama' => 'Driyaaa ananta',
//            'Email' => 'Driyaaa ananta',
//            'tanggal_lahir' => 'Driyaaa ananta',
//            'Kelas' => 'TI',
//            'Jurusan' => 'TI',
//            'No_Handphone' => '08123111',

//            'Kelas' => Str::random(10).'@gmail.com',
//            'password' => Hash::make('password'),

//        for($i = 0; $i <=31; $i++){
//            Mahasiswa::factory()->count(1)->create(['Nim'=>'2141720200'.$i]);
//        }
        for ($i = 1; $i <= 31; $i++){
            Mahasiswa::factory()->count(1)->create(['Nim' => '21417201' . $i]);
        }
    }
}
