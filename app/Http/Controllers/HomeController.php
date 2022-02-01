<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use App\Models\Profil;
use App\Models\Pegawai;
use App\Models\Galeri;
use App\Models\Pangkat;
use App\Models\Tag;
use App\Models\Informasi;
use App\Models\Category;
use Harimayco\Menu\Models\Menus;
use Harimayco\Menu\Models\MenuItems;

class HomeController extends Controller
{
    public function __construct()
    {
        $menu = Menus::where('id', 1)->with('items')->first();
        $this->public_menu = $menu->items->toArray();
    }

    public function index()
    {
        $public_menu = $this->public_menu;
        $new_beritas = Berita::orderBy('created_at', 'desc')->take(3)->get();
        $new_videos = Galeri::with('files')->where('tipe', 2)->orderBy('created_at', 'desc')->take(3)->get();
        $pegawai = Pegawai::count();
        $tanah = Informasi::where('nama', 'tanah')->first('deskripsi')->deskripsi;
        return view('site.index', compact('public_menu', 'new_beritas', 'pegawai', 'tanah', 'new_videos'));
    }

    public function berita()
    {
        $public_menu = $this->public_menu;
        $beritas = Berita::orderBy('created_at', 'desc')->paginate(6);
        $new_beritas = Berita::orderBy('created_at', 'desc')->take(3)->get();
        return view('site.berita.index', compact('public_menu', 'beritas', 'new_beritas'));
    }

    public function beritaShow($slug)
    {
        $public_menu = $this->public_menu;
        $berita  = Berita::where('slug', $slug)->first();
        $new_beritas = Berita::orderBy('created_at', 'desc')->take(3)->get();
        $tags = Tag::all();
        $categories = Category::all();
        return view('site.berita.show', compact('public_menu', 'berita', 'new_beritas', 'tags', 'categories'));
    }

    public function beritaCari($tipe, $parameter)
    {
        $public_menu = $this->public_menu;
        if ($tipe == 'Pencarian') {
            $beritas = Berita::where('slug', $parameter)->orderBy('created_at', 'desc')->paginate(6);
        } else if ($tipe == 'Kategori') {
            $beritas = Berita::whereHas('categories', function ($query) use ($parameter) {
                return $query->where('name', $parameter);
            })->paginate(6);
        } else {
            $beritas = Berita::whereHas('tags', function ($query) use ($parameter) {
                return $query->where('name', $parameter);
            })->paginate(6);
        }
        $new_beritas = Berita::orderBy('created_at', 'desc')->take(3)->get();
        return view('site.berita.param', compact('public_menu', 'beritas', 'parameter', 'tipe', 'new_beritas'));
    }

    public function beritaPencarian(Request $request)
    {
        $public_menu = $this->public_menu;
        $parameter = $request->name;
        $beritas = Berita::where('title', 'LIKE', '%' . $parameter . '%')->orWhere('body', 'LIKE', '%' . $parameter . '%')->orderBy('created_at', 'desc')->paginate(6);
        $tipe = 'Pencarian';
        $new_beritas = Berita::orderBy('created_at', 'desc')->take(3)->get();
        return view('site.berita.param', compact('public_menu', 'beritas', 'parameter', 'tipe', 'new_beritas'));
    }

    public function profil()
    {
        $public_menu = $this->public_menu;
        $new_beritas = Berita::orderBy('created_at', 'desc')->take(3)->get();
        return view('site.profil.index', compact('public_menu', 'new_beritas'));
    }

    public function pegawai()
    {
        $public_menu = $this->public_menu;
        $pegawais = Pegawai::where('status', 1)->with(['divisi', 'jabatan', 'pangkat', 'eselon'])->get()->groupBy(['divisi.divisi', 'jabatan.jabatan', 'pangkat.id']);
        $data['tenaga_kontrak'] = Pegawai::where('status', 2)->count();
        $data['pegawai'] = Pegawai::count();
        $data['pegawai_tetap'] = Pegawai::where('status', 1)->count();
        $data['pangkat'] = Pangkat::whereHas('pegawais')->get();
        // dd(Pangkat::whereHas('pegawais')->get());
        $new_beritas = Berita::orderBy('created_at', 'desc')->take(3)->get();
        return view('site.pegawai.index', compact('public_menu', 'pegawais', 'new_beritas', 'data'));
    }

    public function profilShow($slug)
    {
        $public_menu = $this->public_menu;
        $profil  = Profil::where('slug', $slug)->first();
        $new_beritas = Berita::orderBy('created_at', 'desc')->take(3)->get();
        return view('site.profil.index', compact('public_menu', 'profil', 'new_beritas'));
    }

    public function galeri()
    {
        $public_menu = $this->public_menu;
        $new_beritas = Berita::orderBy('created_at', 'desc')->take(3)->get();
        return view('site.galeri.index', compact('public_menu', 'new_beritas'));
    }

    public function galeriVideo()
    {
        $public_menu = $this->public_menu;
        $videos = Galeri::with('files')->where('tipe', 2)->orderBy('created_at', 'desc')->paginate(6);
        $new_beritas = Berita::orderBy('created_at', 'desc')->take(3)->get();
        return view('site.galeri.video', compact('public_menu', 'videos', 'new_beritas'));
    }

    public function galeriFoto()
    {
        $public_menu = $this->public_menu;
        $fotos = Galeri::whereHas('files')->with(['files', 'tags'])->where('tipe', 1)->orderBy('created_at', 'desc')->get();
        $tags = Tag::whereHas('galeris.files')->get();
        $new_beritas = Berita::orderBy('created_at', 'desc')->take(3)->get();
        return view('site.galeri.foto', compact('public_menu', 'fotos', 'new_beritas', 'tags'));
    }


    public function kontak()
    {
        $public_menu = $this->public_menu;
        $new_beritas = Berita::orderBy('created_at', 'desc')->take(3)->get();
        return view('site.kontak', compact('public_menu', 'new_beritas'));
    }
}
