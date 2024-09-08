<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $anggota = DB::table('pesertas')
            ->orderBy('nama_lengkap')
            ->paginate(5);
        return view('admin.anggota.index', compact('anggota'));
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
        //
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
    public function update(Request $request, string $nim)
    {
        // Validasi input jika diperlukan
        $nama_lengkap = $request->nama_lengkap;
        $no_hp = $request->no_hp;
        $asal_kampus = $request->asal_kampus;
        $password = $request->password;
        $newNim = $request->nim; // Mengambil nilai NIM baru dari permintaan

        $anggota = DB::table('pesertas')->where('nim', $nim)->first();

        if ($anggota) {
            $data = [
                'nama_lengkap' => $nama_lengkap,
                'no_hp' => $no_hp,
                'asal_kampus' => $asal_kampus,
            ];

            // Jika password diisi, update password dengan bcrypt
            if (!empty($password)) {
                $data['password'] = bcrypt($password);
            }

            // Jika NIM baru diisi, perbarui NIM
            if (!empty($newNim)) {
                $data['nim'] = $newNim;
            }

            $simpan = DB::table('pesertas')->where('nim', $nim)->update($data);

            if ($simpan) {
                return redirect('/anggota')->with('success', 'Data Anggota Berhasil Diperbarui');
            } else {
                return redirect('/anggota')->with('error', 'Data Anggota Gagal Diperbarui');
            }
        } else {
            return redirect('/anggota')->with('error', 'Data Anggota Tidak Ditemukan');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $nim)
    {
        $anggota = DB::table('pesertas')->where('nim', $nim)->first();

        if ($anggota) {
            $hapus = DB::table('pesertas')->where('nim', $nim)->delete();

            if ($hapus) {
                return redirect('/anggota')->with('success', 'Data Anggota Berhasil Dihapus');
            } else {
                return redirect('/anggota')->with('error', 'Data Anggota Gagal Dihapus');
            }
        } else {
            return redirect('/anggota')->with('error', 'Data Anggota Tidak Ditemukan');
        }
    }
}
