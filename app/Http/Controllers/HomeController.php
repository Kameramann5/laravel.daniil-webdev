<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Главная страница после входа
     */
    public function index()
    {
        return view('home');
    }
}