<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DosenController extends Controller
{
    public function dashboard()
    {
        // $data = DB::table('mahasiswa')
        //     ->join('akademik', 'mahasiswa.idMahasiswa', '=', 'akademik.idMahasiswa')
        //     ->join('matakuliah', 'akademik.kodeMataKuliah', '=', 'matakuliah.id')
        //     ->join('dosen', 'matakuliah.idDosen', '=', 'dosen.idDosen')
        //     ->select('mahasiswa.namaMahasiswa', 'mahasiswa.nim', 'mahasiswa.ipk', 'mahasiswa.ips', 'akademik.semester')
        //     ->where('dosen.idDosen', 1)
        //     ->get();

        // $data = DB::table('Mahasiswa')
        // ->join('Akademik as A1', 'Mahasiswa.idMahasiswa', '=', 'A1.idMahasiswa')
        // ->join(DB::raw('(SELECT idMahasiswa, MAX(semester) as MaxSemester FROM Akademik GROUP BY idMahasiswa) as A2'), function($join)
        // {
        //     $join->on('Mahasiswa.idMahasiswa', '=', 'A2.idMahasiswa');
        //     $join->on('A1.semester', '=', 'A2.MaxSemester');
        // })
        // ->select('Mahasiswa.idMahasiswa', 'Mahasiswa.namaMahasiswa', 'Mahasiswa.nim', 'A1.semester',
        // DB::raw('AVG(A1.nilai) as IPK'), DB::raw('AVG(A1.nilai) as IPS'))
        // ->groupBy('Mahasiswa.idMahasiswa', 'Mahasiswa.namaMahasiswa', 'Mahasiswa.nim', 'A1.semester')
        // ->get();

        // $data = DB::table('Mahasiswa')
        // ->join('Akademik as A1', 'Mahasiswa.idMahasiswa', '=', 'A1.idMahasiswa')
        // ->join(DB::raw('(SELECT idMahasiswa, MAX(semester) as MaxSemester, AVG(nilai) as IPS FROM Akademik GROUP BY idMahasiswa, semester) as A2'), function($join)
        // {
        //     $join->on('Mahasiswa.idMahasiswa', '=', 'A2.idMahasiswa');
        //     $join->on('A1.semester', '=', 'A2.MaxSemester');
        // })
        // ->select('Mahasiswa.idMahasiswa', 'Mahasiswa.namaMahasiswa', 'Mahasiswa.nim', 'A1.semester',
        // DB::raw('AVG(A1.nilai) as IPK'), 'A2.IPS')
        // ->groupBy('Mahasiswa.idMahasiswa', 'Mahasiswa.namaMahasiswa', 'Mahasiswa.nim', 'A1.semester', 'A2.IPS')
        // ->get();

        // $data = DB::table('Mahasiswa')
        // ->join(DB::raw('(SELECT idMahasiswa, MAX(semester) as MaxSemester, AVG(nilai) as IPS FROM Akademik  GROUP BY idMahasiswa, semester) as A1'), function($join)
        //     {
        //         $join->on('Mahasiswa.idMahasiswa', '=', 'A1.idMahasiswa');
        //     })
        // ->join(DB::raw('(SELECT idMahasiswa, AVG(nilai) as IPK FROM Akademik GROUP BY idMahasiswa) as A2'), 'Mahasiswa.idMahasiswa', '=', 'A2.idMahasiswa')
        // ->select('Mahasiswa.idMahasiswa', 'Mahasiswa.namaMahasiswa', 'Mahasiswa.nim', 'A1.MaxSemester', 'A1.IPS', 'A2.IPK')
        // ->groupBy('Mahasiswa.idMahasiswa', 'Mahasiswa.namaMahasiswa', 'Mahasiswa.nim', 'A1.MaxSemester', 'A1.IPS', 'A2.IPK')
        // ->get();

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
