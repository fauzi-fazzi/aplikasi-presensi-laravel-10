<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $hariini = date('Y-m-d');
        $rekap_presensi = DB::table('presensis')
            // atur jam masuk disini
            ->selectRaw('COUNT(nim) as jmlhhadir, SUM(IF(jam_in > "07:00",1,0)) as jmlhterlambat')
            ->where('tgl_presensi', $hariini)
            ->first();

        // $rekap_kegiatan = DB::table('kegiatans')
        //     ->selectRaw('COUNT(id) as Kegiatan')
        //     ->whereDate('tgl_kegiatan', $hariini)
        //     ->first();

        $rekap_izin = DB::table('izins')
            ->selectRaw('SUM(IF(status="izin",1,0)) as jmlhizin, SUM(IF(status="sakit",1,0)) as jmlhsakit')
            ->where('status_approved', 1)
            ->where('tgl_izin', $hariini)
            ->first();

        $data_anggota = DB::table('pesertas')->count();

        return view('admin.home.index', compact('rekap_presensi', 'rekap_izin', 'data_anggota'));
    }
}