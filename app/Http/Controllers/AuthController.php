<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLogin()
    {
        return view('Login');
    }

    // Proses login
    public function login(Request $request)
    {
        // Validasi input tidak boleh kosong
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Data user lokal (dummy)
        $users = [
            ['username' => 'admin', 'password' => '12345'],
            ['username' => 'nanda', 'password' => 'abcd'],
        ];

        // Cek kecocokan username & password
        foreach ($users as $user) {
            if (
                $user['username'] === $request->username &&
                $user['password'] === $request->password
            ) {
                // Jika cocok, kirim ke dashboard
                return view('Dashboard', ['username' => $request->username]);
            }
        }

        // Jika tidak cocok, kembali ke login dengan pesan error
        return redirect()
            ->route('login.show')
            ->with('error', 'Username atau password salah!');
    }
}

