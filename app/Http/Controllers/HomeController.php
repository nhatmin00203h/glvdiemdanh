<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // Đã đăng nhập → chuyển đúng trang
        if (Auth::check()) {
            return Auth::user()->role === 'admin'
                ? redirect('/admin')
                : redirect('/glv');
        }

        return view('home');
    }
}
