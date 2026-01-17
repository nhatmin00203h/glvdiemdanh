<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt([
            'username' => $request->username,
            'password' => $request->password,
            'role'     => 'admin',
        ])) {
            $request->session()->regenerate();
            return redirect('/admin');
        }

        return back()
            ->withErrors([
                'admin_login' => 'Sai tài khoản hoặc mật khẩu',
            ])
            ->with('login_tab', 'admin')
            ->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
