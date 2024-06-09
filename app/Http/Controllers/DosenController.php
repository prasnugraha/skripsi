<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DosenController extends Controller
{
    public function dashboard()
    {
        $data = DB::table('Mahasiswa')
        ->join(DB::raw('(SELECT idMahasiswa, MAX(semester) as MaxSemester FROM Akademik GROUP BY idMahasiswa) as A1'), function($join)
            {
                $join->on('Mahasiswa.idMahasiswa', '=', 'A1.idMahasiswa');
            })
        ->join(DB::raw('(SELECT idMahasiswa, semester, AVG(nilai) as IPS FROM Akademik GROUP BY idMahasiswa, semester) as A2'), function($join)
            {
                $join->on('A1.idMahasiswa', '=', 'A2.idMahasiswa')
                ->on('A1.MaxSemester', '=', 'A2.semester');
            })
        ->join(DB::raw('(SELECT idMahasiswa, AVG(nilai) as IPK FROM Akademik GROUP BY idMahasiswa) as A3'), 'Mahasiswa.idMahasiswa', '=', 'A3.idMahasiswa')
        ->select('Mahasiswa.idMahasiswa', 'Mahasiswa.namaMahasiswa', 'Mahasiswa.nim', 'A1.MaxSemester', 'A2.IPS', 'A3.IPK')
        ->get();

        // dd($data);

        return view('dashboardAkademik', ['data' => $data]);
    }

    //
}
