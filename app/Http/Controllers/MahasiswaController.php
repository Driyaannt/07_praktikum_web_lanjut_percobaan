<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\Response;
use App\Models\Kelas;

class MahasiswaController extends Controller
{
    public function cari(Request $request)
    {
        $cari = $request->cari;
        $paginate = Mahasiswa::where('nama', 'like', '%'.$cari.'%')->paginate(5);
        return view('mahasiswas.index', compact('paginate'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index():view
    {
        //fungsi eloquent menampilkan data menggunakan pagination
//        $mahasiswas = Mahasiswa::all(); // Mengambil semua isi tabel
//        $posts = Mahasiswa::orderBy('Nim', 'desc')->paginate(6);~
//        return view('mahasiswas.index', compact('mahasiswas'));
//        with('i', (request()->input('page', 1) - 1) * 5);
        $mahasiswas = Mahasiswa::with('kelas')->get();
//        $mahasiswas = Mahasiswa::paginate(5);
        $paginate = Mahasiswa::orderBy('Nim', 'asc')->paginate(3);
//        return view('mahasiswas.index', compact('mahasiswas'));
        return view('mahasiswas.index',['mahasiswa' => $mahasiswas,'paginate' => $paginate,compact('mahasiswas')]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $kelas = Kelas::all();
        return view('mahasiswas.create', ['kelas' => $kelas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
//            'Nim' => 'required',
//            'Nama' => 'required',
//            'Email' => 'required',
//            'tanggal_lahir' => 'required',
//            'Kelas' => 'required',
//            'Jurusan' => 'required',
//            'No_Handphone' => 'required',
            'Nim' => 'required',
            'Nama' => 'required',
            'Email' => 'nullable|email',
            'tanggal_lahir' => 'nullable',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'No_Handphone' => 'nullable',
        ]);

        $mahasiswa = new Mahasiswa();
        $mahasiswa->nim = $request->get('Nim');
        $mahasiswa->nama = $request->get('Nama');
        $mahasiswa->jurusan = $request->get('Jurusan');
        $mahasiswa->email = $request->get('Email', 'default_email@example.com'); // default email
        $mahasiswa->tanggal_lahir = $request->get('tanggal_lahir', '2000-01-01');
        $mahasiswa->no_handphone = $request->get('No_Handphone', '08123456789'); // default no handphone

        $kelas = new Kelas();
        $kelas->id = $request->get('Kelas');

        //fungsi eloquent untuk menambah data dengan relasi belongsto
        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa Berhasil Ditambahkan');
//        Mahasiswa::create($request->all());
        //jika data berhasil ditambahkan, akan kembali ke halaman utama
//        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $Nim
     * @return \Illuminate\Http\Response
     */
    public function show($Nim)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
//        $Mahasiswa = Mahasiswa::find($Nim);
        $mahasiswa = Mahasiswa::with('kelas')->where('nim',$Nim)->first();
        return view('mahasiswas.detail', ['mahasiswa'=>$mahasiswa]);

//        return view('mahasiswas.detail', compact('Mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $iNim
     * @return \Illuminate\Http\Response
     */
    public function edit($Nim)
    {
        //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
//        $Mahasiswa = Mahasiswa::find($Nim);
//        return view('mahasiswas.edit', compact('Mahasiswa'));

            $mahasiswa = Mahasiswa::with('kelas')->where('nim', $Nim)->first();
            $kelas = Kelas::all();
            return view('mahasiswas.edit', compact('mahasiswa','kelas'));

            }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $Nim
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Nim)
    {
        //melakukan validasi data
        $request->validate([
//            'Nim' => 'required',
//            'Nama' => 'required',
//            'Email' => 'required',
//            'tanggal_lahir' => 'required',
//            'Kelas' => 'required',
//            'Jurusan' => 'required',
//            'No_Handphone' => 'required',

            'Nim' => 'required',
            'Nama' => 'required',
            'Email' => 'nullable|email',
            'tanggal_lahir' => 'nullable',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'No_Handphone' => 'nullable',
        ]);
        $mahasiswa = Mahasiswa::with('kelas')->where('nim', $Nim)->first();
        $mahasiswa->nim = $request->get('Nim');
        $mahasiswa->nama = $request->get('Nama');
        $mahasiswa->jurusan = $request->get('Jurusan');
        $mahasiswa->email = $request->get('Email', 'default_email@example.com'); // default email
        $mahasiswa->tanggal_lahir = $request->get('tanggal_lahir', '2000-01-01');
        $mahasiswa->no_handphone = $request->get('No_Handphone', '08123456789'); // default no handphone
        $mahasiswa->save();

        $kelas = new Kelas();
        $kelas->id = $request->get('Kelas');

//fungsi eloquent untuk mengupdate data inputan kita
//        Mahasiswa::find($Nim)->update($request->all());
        $mahasiswa->kelas()->associate($kelas);
        $mahasiswa->save();
//jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $Nim
     * @return \Illuminate\Http\Response
     */
    public function destroy($Nim)
    {
        //fungsi eloquent untuk menghapus data
        Mahasiswa::find($Nim)->delete();
        return redirect()->route('mahasiswa.index')-> with('success', 'Mahasiswa Berhasil Dihapus');
    }
}
