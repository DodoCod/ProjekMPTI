<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * Tampilkan formulir login.
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Tangani upaya login masuk.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // 1. Validasi Input
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Coba Autentikasi
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            // Redirect pengguna ke halaman admin dashboard
            return redirect()->intended(route('admin.dashboard'));
        } else if ($request['email']) {
            // 3. Jika email admin tidak terdaftar di database
            return back()->withErrors([
                'email' => 'Email belum terdaftar.',
            ]);
        } else {
            // 3. Jika Gagal, kembalikan dengan error
            return back()->withErrors([
                'email' => 'Kombinasi email dan password tidak cocok.',
            ])->onlyInput('email');
        }

    }

    /**
     * Tangani logout pengguna.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        // Redirect ke halaman landing
        return redirect(route('admin.dashboard')); 
    }
}