<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $hariini = date('Y-m-d');
        $bulanini = date('m') * 1;
        $tahunini = date('Y');
        $nim = Auth::guard('peserta')->user()->nim;
        $presensihariini = DB::table('presensis')->where('nim', $nim)->where('tgl_presensi', $hariini)->first();
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        $rekap_izin = DB::table('izins')
            ->selectRaw('SUM(IF(status="izin",1,0)) as jmlhizin, SUM(IF(status="sakit",1,0)) as jmlhsakit')
            ->where('nim', $nim)
            ->whereRaw('MONTH(tgl_izin)= "' . $bulanini . '"')
            ->whereRaw('YEAR(tgl_izin)= "' . $tahunini . '"')
            ->where('status_approved', 1)
            ->first();

        $rekap_presensi = DB::table('presensis')
            // atur jam masuk disini
            ->selectRaw('COUNT(nim) as jmlhhadir, SUM(IF(jam_in > "07:00",1,0)) as jmlhterlambat')
            ->where('nim', $nim)
            ->whereRaw('MONTH(tgl_presensi)= "' . $bulanini . '"')
            ->whereRaw('YEAR(tgl_presensi)= "' . $tahunini . '"')
            ->first();

        // $rekap_kegiatan = DB::table('kegiatans')
        //     ->selectRaw('COUNT(id) as total_kegiatan')
        //     ->where('nim', $nim)
        //     ->whereMonth('tgl_kegiatan', '=', $bulanini)
        //     ->whereYear('tgl_kegiatan', '=', $tahunini)
        //     ->first();

        // dd($rekap_presensi);
        // dd($rekap_kegiatan);

        return view('users.home.index', compact(
            'presensihariini',
            'namabulan',
            'hariini',
            'bulanini',
            'tahunini',
            'rekap_presensi',
            'rekap_izin',
            // 'rekap_kegiatan'
        ));
    }
}