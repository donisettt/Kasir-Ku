<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\LogActivity;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'alpha_dash'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            LogActivity::add('berhasil login');
        }

        return back()->withErrors([
            'username' => 'The provided credentials do not match our records.',
        ])->onlyInput('username');
    }

    public function store(Request $request)
    {
        return to_route('transaksi/show', ['transaksi' => $transaksi->id]);
    }

    public function logout(Request $request)
    {
        LogActivity::add('Berhasil Logout');
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}