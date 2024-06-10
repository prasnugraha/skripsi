<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AkademikMhs extends Controller
{
    // public function index() {
    //     $data = DB::table('akademik')
    //     ->join('mahasiswa', 'mahasiswa.idMahasiswa', '=', 'akademik.idMahasiswa')
    //     ->select('akademik.idMahasiswa', 'mahasiswa.namaMahasiswa', 'akademik.nilai',
    //         DB::raw("CASE
    //             WHEN akademik.nilai >= 0 AND nilai < 45 THEN 'E'
    //             WHEN akademik.nilai >= 45 AND nilai < 55 THEN 'D'
    //             WHEN akademik.nilai >= 55 AND nilai < 60 THEN 'C'
    //             WHEN akademik.nilai >= 60 AND nilai < 70 THEN 'B-'
    //             WHEN akademik.nilai >= 70 AND nilai < 75 THEN 'B'
    //             WHEN akademik.nilai >= 75 AND nilai < 80 THEN 'B+'
    //             WHEN akademik.nilai >= 80 AND nilai < 85 THEN 'A-'
    //             WHEN akademik.nilai >= 85 AND nilai <= 100 THEN 'A'
    //             ELSE 'Nilai tidak valid'
    //         END as NilaiHuruf"))
    //     ->get();

    //     $groupedData = [];
    //     foreach ($data as $item) {
    //         $groupedData[$item->namaMahasiswa][$item->NilaiHuruf][] = $item->nilai;
    //     }

    //     return view('akademikmhs', ['data' => $groupedData]);
    // }


    public function show($idMahasiswa)
    {
        $data = DB::table('akademik')
        ->join('mahasiswa', 'mahasiswa.idMahasiswa', '=', 'akademik.idMahasiswa')
        ->where('akademik.idMahasiswa', $idMahasiswa)
        ->select('akademik.idMahasiswa', 'mahasiswa.namaMahasiswa', 'akademik.nilai',
            DB::raw("CASE
                WHEN akademik.nilai >= 0 AND nilai < 45 THEN 'E'
                WHEN akademik.nilai >= 45 AND nilai < 55 THEN 'D'
                WHEN akademik.nilai >= 55 AND nilai < 60 THEN 'C'
                WHEN akademik.nilai >= 60 AND nilai < 70 THEN 'B-'
                WHEN akademik.nilai >= 70 AND nilai < 75 THEN 'B'
                WHEN akademik.nilai >= 75 AND nilai < 80 THEN 'B+'
                WHEN akademik.nilai >= 80 AND nilai < 85 THEN 'A-'
                WHEN akademik.nilai >= 85 AND nilai <= 100 THEN 'A'
                ELSE 'Nilai tidak valid'
            END as NilaiHuruf"))
        ->get();

    $groupedData = [];
    foreach ($data as $item) {
        if (!isset($groupedData[$item->namaMahasiswa])) {
            $groupedData[$item->namaMahasiswa] = [];
        }
        if (!isset($groupedData[$item->namaMahasiswa][$item->NilaiHuruf])) {
            $groupedData[$item->namaMahasiswa][$item->NilaiHuruf] = [];
        }
        $groupedData[$item->namaMahasiswa][$item->NilaiHuruf][] = $item->nilai;
    }

    return view('akademikmhs', ['data' => $groupedData]);
    }
}
