<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'nim' => 'required|regex:/^\d{2}\.\d\.\d\.\d{4}$/',
            'password' => 'required',
        ]);

        $nim = preg_replace('/\./', '', $request->nim);

        if (Auth::guard('peserta')->attempt(['nim' => $nim, 'password' => $request->password])) {
            return redirect('/home');
        } else {
            return redirect('/')->with('status', 'Login Gagal');
        }
    }

    public function logout()
    {
        if (Auth::guard('peserta')->check()) {
            Auth::guard('peserta')->logout();
        }
        return redirect('/');
    }

    public function logoutadmin()
    {
        if (Auth::guard('user')->check()) {
            Auth::guard('user')->logout();
        }
        return redirect('/loginadmin');
    }

    public function register()
    {
        return view('auth.register');
    }

    //proses register user
    public function prosesregis(Request $request)
    {
        $request->validate([
            'nim' => 'required|unique:pesertas,nim|regex:/^\d{2}\.\d\.\d\.\d{4}$/',
            'password' => 'required',
            'nama_lengkap' => 'required',
            'asal_kampus' => 'required',
            'no_hp' => 'required',
        ]);

        $nim = preg_replace('/\./', '', $request->nim);
        $nimExisting = DB::table('pesertas')->where('nim', $nim)->first();

        if ($nimExisting) {
            return redirect('/register')->with(['error' => 'NIM sudah terdaftar dalam database.'])->withInput();
        }

        $data = [
            'nim' => $nim,
            'nama_lengkap' => $request->nama_lengkap,
            'asal_kampus' => $request->asal_kampus,
            'no_hp' => $request->no_hp,
            'password' => bcrypt($request->password),
        ];

        $simpan = DB::table('pesertas')->insert($data);

        if ($simpan) {
            return redirect('/')->with('success', 'Registrasi Berhasil');
        } else {
            return redirect('/register')->with('error', 'Registrasi Gagal');
        }
    }

    //login adminn
    public function loginadmin()
    {
        return view('auth.loginadmin');
    }

    public function prosesloginadmin(Request $request)
    {
        if (Auth::guard('user')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/panel');
        } else {
            return redirect('/loginadmin')->with('status', 'Login Gagal');
        }
    }
}