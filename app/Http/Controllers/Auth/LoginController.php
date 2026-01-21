<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLogin() {
        return view('auth.login');
    }

    public function login(Request $request) {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        // Tambahkan fitur 'remember me' jika diinginkan dengan $request->has('remember')
        if (Auth::attempt($credentials, $request->has('remember'))) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Proteksi: Pastikan relasi employee ada sebelum mengambil role
            if (!$user->employee) {
                Auth::logout();
                return back()->withErrors(['username' => 'Akun Anda tidak terhubung dengan data pegawai.']);
            }

            $role = $user->employee->role;

            // Menggunakan 'match' (PHP 8+) lebih rapi daripada 'switch'
            return match ($role) {
                'finance'  => redirect()->route('finance.dashboard'),
                'director' => redirect()->route('director.dashboard'),
                'employee' => redirect()->route('employee.dashboard'),
                default    => redirect('/dashboard'),
            };
        }

        return back()->withErrors([
            'username' => 'Username atau password yang Anda masukkan salah.',
        ])->onlyInput('username');
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}