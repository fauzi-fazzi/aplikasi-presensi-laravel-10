<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class IzinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $nim = Auth::guard('peserta')->user()->nim;
        $izin = DB::table('izins')->where('nim', $nim)->get();
        return view('users.izin.index', compact('izin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $tgl_izin = $request->tgl_izin;
        $nim = Auth::guard('peserta')->user()->nim;
        $ket = $request->ket;
        $status = $request->status;

        $data = [
            'nim' => $nim,
            'tgl_izin' => $tgl_izin,
            'ket' => $ket,
            'status' => $status
        ];

        $simpan = DB::table('izins')->insert($data);
        if ($simpan) {
            return redirect('/izin')->with(['success' => 'Izin Berhasil dikirim']);
        } else {
            return redirect('/izin')->with(['error' => 'Izin Gagal dikirim']);
        }
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
