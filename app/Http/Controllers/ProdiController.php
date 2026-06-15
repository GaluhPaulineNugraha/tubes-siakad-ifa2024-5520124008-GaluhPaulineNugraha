<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdiController extends Controller
{
    public function beranda()
    {
        return view('prodi.beranda');
    }
    
    public function visiMisi()
    {
        return view('prodi.visi-misi');
    }
}