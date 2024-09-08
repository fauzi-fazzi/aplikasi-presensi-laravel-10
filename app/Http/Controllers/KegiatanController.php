<?php

namespace App\Http\Controllers;

use App\Models\kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class KegiatanController extends Controller
{
    public function index()
    {
        // Misalnya Anda ingin menampilkan daftar kegiatan dari database
        $nim = Auth::guard('peserta')->user()->nim;
        $kegiatan = DB::table('kegiatans')
            ->where('nim', $nim)
            ->get();
        // dd($nim);
        return view('users.kegiatan.index', compact('kegiatan'));
    }
    //
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('kegiatan.create');
    }

    // Fungsi untuk menyimpan data kegiatan yang baru dibuat
    public function store(Request $request)
    {
        // Validasi request dari form (jika diperlukan)
        $request->validate([
            'tgl_kegiatan' => 'required|date',
            'nama_kegiatan' => 'required|string',
            'foto' => 'required|image|max:2048', // Maksimum 2MB
        ]);

        // Mengambil data dari request
        $nim = Auth::guard('peserta')->user()->nim;
        $tanggal_kegiatan = $request->tgl_kegiatan;
        $kegiatan = $request->nama_kegiatan;
        $foto = $request->file('foto')->store('public/kegiatan_foto'); // Menyimpan foto ke dalam storage

        // Contoh menyimpan data kegiatan ke dalam database menggunakan Query Builder
        $data = [
            'nim' => $nim,
            'tgl_kegiatan' => $tanggal_kegiatan,
            'nama_kegiatan' => $kegiatan,
            'foto' => $foto,
        ];

        $simpan = DB::table('kegiatans')->insert($data);

        // Menangani hasil penyimpanan
        if ($simpan) {
            return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil ditambahkan.');
        } else {
            return redirect()->route('kegiatan.index')->with('error', 'Gagal menyimpan kegiatan.');
        }
    }
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
        $request->validate([
            'tgl_kegiatan' => 'required|date',
            'nama_kegiatan' => 'required|string',
            'foto' => 'nullable|image|max:2048', // Maksimum 2MB, nullable berarti boleh kosong
        ]);

        // Cari kegiatan yang akan diupdate berdasarkan id
        $kegiatan = DB::table('kegiatans')->find($id);

        if ($kegiatan) {
            // Ambil data dari request
            $tanggal_kegiatan = $request->tgl_kegiatan;
            $nama_kegiatan = $request->nama_kegiatan;

            // Jika ada file foto baru yang diunggah
            if ($request->hasFile('foto')) {
                // Hapus foto lama dari storage
                Storage::delete($kegiatan->foto);

                // Simpan foto baru ke storage
                $foto = $request->file('foto')->store('public/kegiatan_foto');
            } else {
                // Jika tidak ada foto baru, gunakan foto lama
                $foto = $kegiatan->foto;
            }

            // Update data kegiatan
            $data = [
                'tgl_kegiatan' => $tanggal_kegiatan,
                'nama_kegiatan' => $nama_kegiatan,
                'foto' => $foto,
            ];

            $update = DB::table('kegiatans')->where('id', $id)->update($data);

            // Menangani hasil pembaruan
            if ($update) {
                return redirect()->route('kegiatan.index')->with('success', 'Kegiatan berhasil diperbarui.');
            } else {
                return redirect()->route('kegiatan.index')->with('error', 'Gagal memperbarui kegiatan.');
            }
        } else {
            return redirect()->route('kegiatan.index')->with('error', 'Kegiatan tidak ditemukan.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kegiatan = DB::table('kegiatans')->where('id', $id)->first();

        if ($kegiatan) {
            $hapus = DB::table('kegiatans')->where('id', $id)->delete();

            if ($hapus) {
                return redirect('/kegiatan')->with('success', 'Data kegiatan Berhasil Dihapus');
            } else {
                return redirect('/kegiatan')->with('error', 'Data kegiatan Gagal Dihapus');
            }
        } else {
            return redirect('/kegiatan')->with('error', 'Data kegiatan Tidak Ditemukan');
        }
    }
}