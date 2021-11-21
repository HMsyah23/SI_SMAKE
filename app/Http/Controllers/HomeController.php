<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('site.index');
    }

    public function berita()
    {
        return view('site.berita.index');
    }

    public function profil()
    {
        return view('site.profil.index');
    }

    public function galeri()
    {
        return view('site.galeri.index');
    }

    public function kontak()
    {
        return view('site.kontak');
    }
}
