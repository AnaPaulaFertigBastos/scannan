<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HomeController extends Controller
{
    public function login()
    {
        if (session()->has('jwt_token')) {
            return redirect()->route('obras.listar');
        }
        return view('home.login');
    }

    public function registrar()
    {
        return view('home.registrar');
    }
}
