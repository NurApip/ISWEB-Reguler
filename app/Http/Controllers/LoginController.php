<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class LoginController extends Controller
{
    public function showLogin() { return view('auth.login'); }

    public function login(Request $request) {
    $request->validate(['user' => 'required']);

    if ($request->login_mode === 'email') {
        if (!$request->filled('password')) {
            return back()->withInput()->withErrors(['msg' => 'Email dan Password wajib diisi!']);
        }

        $user = User::where('email', $request->user)->orWhere('name', $request->user)->first();

        if (!$user || !Auth::validate(['email' => $user->email, 'password' => $request->password])) {
            return back()->withInput()->withErrors(['msg' => 'Email atau Password salah!']);
        }
    } 
    else {
        if (!is_numeric($request->user)) {
             return back()->withInput()->withErrors(['msg' => 'Format Nomor HP tidak valid (Hanya angka)!']);
        }

        $user = User::where('hp', $request->user)->first();
        
        if (!$user) {
            return back()->withInput()->withErrors(['msg' => 'Nomor HP tidak terdaftar!']);
        }
    }

    Session::put(['otp' => '123456', 'temp_user_id' => $user->id]);
    return redirect('/verifikasi');
}

    public function verifyOtp(Request $request) {
    // Ambil OTP yang disimpan di session saat login
    $validOtp = Session::get('otp');
    $tempUserId = Session::get('temp_user_id');

    // REVISI: Cek apakah session ada dan input cocok
    if (!$validOtp || !$tempUserId) {
        return redirect('/login')->withErrors(['msg' => 'Sesi berakhir, silakan login ulang.']);
    }

    if ($request->otp !== $validOtp) {
        return back()->withErrors(['msg' => 'Kode OTP salah! Cek kembali.']);
    }

    // Jika benar
    Auth::loginUsingId($tempUserId);
    Session::forget(['otp', 'temp_user_id']);
    return redirect('/dashboard');
}
public function logout(Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/login');
}
}