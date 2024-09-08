<?php

namespace App\Http\Controllers;

use App\Models\kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class MonitoringAbsenController extends Controller
{
    public function index()
    {
        return view('admin.monitoring.index');
    }

    public function getabsen(Request $request)
    {
        $tanggal = $request->tanggal;
        // dd($tanggal);
        $presensi = DB::table('presensis')
            ->select('presensis.*', 'nama_lengkap', 'asal_kampus')
            ->join('pesertas', 'presensis.nim', '=', 'pesertas.nim')
            ->where('tgl_presensi', $tanggal)
            ->get();
        // dd($presensi);
        return view('admin.monitoring.presensi', compact('presensi'));
    }

    public function pengajuanizin()
    {
        $izinsakit = DB::table('izins')
            ->join('pesertas', 'izins.nim', '=', 'pesertas.nim')
            ->orderBy('tgl_izin', 'desc')
            ->get();
        return view('admin.pengajuan.izin', compact('izinsakit'));
    }

    public function kegiatan(Request $request)
    {
        $tanggal = $request->tanggal;

        // Ambil kegiatan berdasarkan tanggal tertentu
        $kegiatan = kegiatan::whereDate('tgl_kegiatan', $tanggal)->get();

        return view('admin.kegiatan.index', compact('kegiatan'));
    }

    public function getkegiatan(Request $request)
    {
        $tanggal = $request->tanggal;
        // dd($tanggal);
        $kegiatan = DB::table('kegiatans')
            ->select('kegiatans.*', 'nama_lengkap', 'asal_kampus')
            ->join('pesertas', 'kegiatans.nim', '=', 'pesertas.nim')
            ->where('tgl_kegiatan', $tanggal)
            ->get();
        // dd($kegiatan);
        return view('admin.kegiatan.kegiatan', compact('kegiatan'));
    }

    public function approveizinsakit(Request $request)
    {
        $status_approved = $request->status_approved;
        $id_izinsakit_form = $request->id_izinsakit_form;
        $update = DB::table('izins')->where('id', $id_izinsakit_form)
            ->update(['status_approved' => $status_approved]);
        if ($update) {
            return redirect('/pengajuanizin')->with('success', 'Data Berhasil');
        } else {
            return redirect('/pengajuanizin')->with('error', 'Data Gagal dikirim');
        }
    }

    public function batalkanizinsakit($id)
    {
        $update = DB::table('izins')->where('id', $id)
            ->update(['status_approved' => 0]);
        if ($update) {
            return redirect('/pengajuanizin')->with('success', 'Data Berhasil');
        } else {
            return redirect('/pengajuanizin')->with('error', 'Data Gagal dikirim');
        }
    }


    public function setlokasi()
    {
        $lok_tempat = DB::table('lokasis')->where('id', 1)->first();

        return view('admin.lokasi.index', compact('lok_tempat'));
    }

    public function setlokasiupdate(Request $request)
    {
        $lokasi_tempat = $request->lokasi_tempat;
        $radius = $request->radius;

        $update = DB::table('lokasis')->where('id', 1)->update([
            'lokasi_tempat' => $lokasi_tempat,
            'radius' => $radius
        ]);
        if ($update) {
            return redirect('/setlokasi')->with('success', 'Data Berhasil');
        } else {
            return redirect('/setlokasi')->with('error', 'Data Gagal dikirim');
        }
    }

    public function rekapabsen()
    {
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        return view('admin.rekap.absen', compact('namabulan'));
    }

    public function cetakabsen(Request $request)
    {
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];

        $bulan = $request->bulan;
        $tahun = $request->tahun;
        $rekap = DB::table('presensis')
            ->selectRaw(' presensis.nim,
        nama_lengkap,
        MAX(IF(DAY(tgl_presensi) = 1, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_1,
        MAX(IF(DAY(tgl_presensi) = 2, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_2,
        MAX(IF(DAY(tgl_presensi) = 3, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_3,
        MAX(IF(DAY(tgl_presensi) = 4, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_4,
        MAX(IF(DAY(tgl_presensi) = 5, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_5,
        MAX(IF(DAY(tgl_presensi) = 6, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_6,
        MAX(IF(DAY(tgl_presensi) = 7, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_7,
        MAX(IF(DAY(tgl_presensi) = 8, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_8,
        MAX(IF(DAY(tgl_presensi) = 9, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_9,
        MAX(IF(DAY(tgl_presensi) = 10, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_10,
        MAX(IF(DAY(tgl_presensi) = 11, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_11,
        MAX(IF(DAY(tgl_presensi) = 12, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_12,
        MAX(IF(DAY(tgl_presensi) = 13, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_13,
        MAX(IF(DAY(tgl_presensi) = 14, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_14,
        MAX(IF(DAY(tgl_presensi) = 15, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_15,
        MAX(IF(DAY(tgl_presensi) = 16, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_16,
        MAX(IF(DAY(tgl_presensi) = 17, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_17,
        MAX(IF(DAY(tgl_presensi) = 18, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_18,
        MAX(IF(DAY(tgl_presensi) = 19, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_19,
        MAX(IF(DAY(tgl_presensi) = 20, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_20,
        MAX(IF(DAY(tgl_presensi) = 21, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_21,
        MAX(IF(DAY(tgl_presensi) = 22, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_22,
        MAX(IF(DAY(tgl_presensi) = 23, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_23,
        MAX(IF(DAY(tgl_presensi) = 24, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_24,
        MAX(IF(DAY(tgl_presensi) = 25, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_25,
        MAX(IF(DAY(tgl_presensi) = 26, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_26,
        MAX(IF(DAY(tgl_presensi) = 27, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_27,
        MAX(IF(DAY(tgl_presensi) = 28, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_28,
        MAX(IF(DAY(tgl_presensi) = 29, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_29,
        MAX(IF(DAY(tgl_presensi) = 30, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_30,
        MAX(IF(DAY(tgl_presensi) = 31, CONCAT(jam_in, "-", IFNULL(jam_out, "00:00:00")), "")) AS tgl_31')
            ->join('pesertas', 'presensis.nim', '=', 'pesertas.nim')
            ->whereRaw('MONTH(tgl_presensi) = ?', [$bulan])
            ->whereRaw('YEAR(tgl_presensi) = ?', [$tahun])
            ->groupBy('presensis.nim', 'nama_lengkap')
            ->get();
        // dd($rekap);

        return view('admin.rekap.cetak', compact('rekap', 'bulan', 'namabulan', 'tahun'));
    }



    public function rekapkegiatan()
    {
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        return view('admin.rekap.kegiatan', compact('namabulan'));
    }


    public function cetakkegiatan(Request $request)
    {
        $bulan = $request->get('bulan');
        $tahun = $request->get('tahun');
        $namabulan = ["", "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
        $rekap = DB::table('kegiatans')
            ->selectRaw('kegiatans.nim, nama_lengkap,
             MAX(IF(DAY(tgl_kegiatan) = 1, nama_kegiatan, "")) AS tgl_1,
             MAX(IF(DAY(tgl_kegiatan) = 2, nama_kegiatan, "")) AS tgl_2,
             MAX(IF(DAY(tgl_kegiatan) = 3, nama_kegiatan, "")) AS tgl_3,
             MAX(IF(DAY(tgl_kegiatan) = 4, nama_kegiatan, "")) AS tgl_4,
             MAX(IF(DAY(tgl_kegiatan) = 5, nama_kegiatan, "")) AS tgl_5,
             MAX(IF(DAY(tgl_kegiatan) = 6, nama_kegiatan, "")) AS tgl_6,
             MAX(IF(DAY(tgl_kegiatan) = 7, nama_kegiatan, "")) AS tgl_7,
             MAX(IF(DAY(tgl_kegiatan) = 8, nama_kegiatan, "")) AS tgl_8,
             MAX(IF(DAY(tgl_kegiatan) = 9, nama_kegiatan, "")) AS tgl_9,
             MAX(IF(DAY(tgl_kegiatan) = 10, nama_kegiatan, "")) AS tgl_10,
             MAX(IF(DAY(tgl_kegiatan) = 11, nama_kegiatan, "")) AS tgl_11,
             MAX(IF(DAY(tgl_kegiatan) = 12, nama_kegiatan, "")) AS tgl_12,
             MAX(IF(DAY(tgl_kegiatan) = 13, nama_kegiatan, "")) AS tgl_13,
             MAX(IF(DAY(tgl_kegiatan) = 14, nama_kegiatan, "")) AS tgl_14,
             MAX(IF(DAY(tgl_kegiatan) = 15, nama_kegiatan, "")) AS tgl_15,
             MAX(IF(DAY(tgl_kegiatan) = 16, nama_kegiatan, "")) AS tgl_16,
             MAX(IF(DAY(tgl_kegiatan) = 17, nama_kegiatan, "")) AS tgl_17,
             MAX(IF(DAY(tgl_kegiatan) = 18, nama_kegiatan, "")) AS tgl_18,
             MAX(IF(DAY(tgl_kegiatan) = 19, nama_kegiatan, "")) AS tgl_19,
             MAX(IF(DAY(tgl_kegiatan) = 20, nama_kegiatan, "")) AS tgl_20,
             MAX(IF(DAY(tgl_kegiatan) = 21, nama_kegiatan, "")) AS tgl_21,
             MAX(IF(DAY(tgl_kegiatan) = 22, nama_kegiatan, "")) AS tgl_22,
             MAX(IF(DAY(tgl_kegiatan) = 23, nama_kegiatan, "")) AS tgl_23,
             MAX(IF(DAY(tgl_kegiatan) = 24, nama_kegiatan, "")) AS tgl_24,
             MAX(IF(DAY(tgl_kegiatan) = 25, nama_kegiatan, "")) AS tgl_25,
             MAX(IF(DAY(tgl_kegiatan) = 26, nama_kegiatan, "")) AS tgl_26,
             MAX(IF(DAY(tgl_kegiatan) = 27, nama_kegiatan, "")) AS tgl_27,
             MAX(IF(DAY(tgl_kegiatan) = 28, nama_kegiatan, "")) AS tgl_28,
             MAX(IF(DAY(tgl_kegiatan) = 29, nama_kegiatan, "")) AS tgl_29,
             MAX(IF(DAY(tgl_kegiatan) = 30, nama_kegiatan, "")) AS tgl_30,
             MAX(IF(DAY(tgl_kegiatan) = 31, nama_kegiatan, "")) AS tgl_31')
            ->join('pesertas', 'kegiatans.nim', '=', 'pesertas.nim')
            ->whereRaw('MONTH(tgl_kegiatan) = ?', [$bulan])
            ->whereRaw('YEAR(tgl_kegiatan) = ?', [$tahun])
            ->groupBy('kegiatans.nim', 'nama_lengkap')
            ->get();

        return view('admin.rekap.cetakkegiatan', compact('rekap', 'bulan', 'namabulan', 'tahun'));
    }
}
