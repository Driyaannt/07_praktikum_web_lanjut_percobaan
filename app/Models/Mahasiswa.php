<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table="mahasiswa"; // Eloquent akan membuat model mahasiswa
//menyimpan record di tabel mahasiswas
    public $timestamps= false;
    protected $primaryKey = 'Nim';

    protected $fillable = [
        'Nim',
        'Nama',
        'Email',
        'tanggal_lahir',
        'Kelas',
        'Jurusan',
        'No_Handphone',
    ];
}
