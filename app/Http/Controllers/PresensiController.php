<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PresensiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hariini = date('Y-m-d');
        $nim = Auth::guard('peserta')->user()->nim;
        $cek = DB::table('presensis')->where('tgl_presensi', $hariini)->where('nim', $nim)->count();
        $lok_tempat = DB::table('lokasis')->where('id', 1)->first();
        return view('users.presensi.create', compact('cek', 'lok_tempat'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $nim = Auth::guard('peserta')->user()->nim;
        $tgl_presensi = date('Y-m-d');
        $jam = date('H:i:s');
        $lok_tempat = DB::table('lokasis')->where('id', 1)->first();
        $lok = explode(',', $lok_tempat->lokasi_tempat);
        $latkantor = $lok[0];
        $longkantor = $lok[1];
        $lokasi = $request->lokasi;
        $lokasiuser = explode(',', $lokasi);
        $latuser = $lokasiuser[0];
        $longuser = $lokasiuser[1];

        $jarak = $this->distance($latkantor, $longkantor, $latuser, $longuser);
        $radius = round($jarak['meters']);
        // dd($radius);

        $cek = DB::table('presensis')->where('tgl_presensi', $tgl_presensi)->where('nim', $nim)->count();

        if ($cek > 0) {
            $ket = "out";
        } else {
            $ket = "in";
        }

        $image = $request->image;
        $folderPath = "public/uploads/absensi/";
        $formatName = $nim . "-" . $tgl_presensi . "-" . $ket;
        $image_parts = explode(";base64,", $image);
        $image_base64 = base64_decode($image_parts[1]);
        $fileName = $formatName . ".png";
        $file = $folderPath . $fileName;
        Storage::put($file, $image_base64);

        if ($radius > $lok_tempat->radius) {
            echo "error|Maaf Gagal, Anda diluar Radius|";
        } else {
            if ($cek > 0) {
                $datapulang = [
                    'jam_out' => $jam,
                    'foto_out' => $fileName,
                    'lokasi_out' => $lokasi
                ];
                $update = DB::table('presensis')->where('tgl_presensi', $tgl_presensi)->where('nim', $nim)->update($datapulang);
                if ($update) {
                    echo "success|Terimakasih, Hati Hati Di jalan|out";
                    Storage::put($file, $image_base64);
                } else {
                    echo "error|Maaf Gagal, Silakan Hubungi Tim IT|out";
                }
            } else {
                $data = [
                    'nim' => $nim,
                    'tgl_presensi' => $tgl_presensi,
                    'jam_in' => $jam,
                    'foto_in' => $fileName,
                    'lokasi_in' => $lokasi
                ];
                $simpan = DB::table('presensis')->insert($data);
                if ($simpan) {
                    echo "success|Terimakasih, Sudah Absen|in";
                    Storage::put($file, $image_base64);
                } else {
                    echo "error|Maaf Gagal, Silakan Hubungi Tim IT|in";
                }
            }
        }
    }
    //Menghitung Jarak
    function distance($lat1, $lon1, $lat2, $lon2)
    {
        $theta = $lon1 - $lon2;
        $miles = (sin(deg2rad($lat1)) * sin(deg2rad($lat2))) + (cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)));
        $miles = acos($miles);
        $miles = rad2deg($miles);
        $miles = $miles * 60 * 1.1515;
        $feet = $miles * 5280;
        $yards = $feet / 3;
        $kilometers = $miles * 1.609344;
        $meters = $kilometers * 1000;
        return compact('meters');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
