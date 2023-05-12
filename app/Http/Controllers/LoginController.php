<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index', [
            'title' => 'Login',
            'active' => 'login'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $user = User::firstWhere('email', $credentials['email']);

        if ($user){
            if (Hash::check($credentials['password'], $user->password)) {
                Auth::login($user);
                if (Auth::check() && Auth::user()->roles == '1') {
                    return redirect()->route('dashboard');
                    } else {
                        return redirect()->route('home');
                    }
                // return redirect()->route('dashboard');
            }
        }


        return back()->with('loginError', 'Login Failed!');
    }

    // public function masukProses(Request $request)
    // {
    //     $validasi = $request->validate([
    //     'masuk_nama_pengguna' => 'required',
    //     'masuk_kata_sandi' => 'required',
    //     ]);

    //     $user = Pengguna::firstWhere('nama_pengguna', $validasi['masuk_nama_pengguna']);

    //     if ($user) {
    //     if (Hash::check($validasi['masuk_kata_sandi'], $user->kata_sandi)) {
    //         Auth::login($user);
    //         return redirect()->route('beranda');
    //     }
    //     }

    //     return redirect()->route('masuk.tampil')->with('pesanGagal', true);
    // }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
