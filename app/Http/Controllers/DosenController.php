<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DosenController extends Controller
{
    public function dashboard()
    {
        $data = DB::table('mahasiswa')
            ->join('akademik', 'mahasiswa.idMahasiswa', '=', 'akademik.idMahasiswa')
            ->join('matakuliah', 'akademik.kodeMataKuliah', '=', 'matakuliah.id')
            ->join('dosen', 'matakuliah.idDosen', '=', 'dosen.idDosen')
            ->select('mahasiswa.namaMahasiswa', 'mahasiswa.nim', 'mahasiswa.ipk', 'mahasiswa.ips', 'akademik.semester')
            ->where('dosen.idDosen', 1)
            ->get();

        // dd($data);

        return view('dashboardAkademik', ['data' => $data]);
    }
    //
}
