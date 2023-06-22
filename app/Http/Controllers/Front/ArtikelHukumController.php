<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Admin\ArtikelHukumList;
use DB;

class ArtikelHukumController extends Controller
{
    public function index()
    {
        $artikelHukumList = ArtikelHukumList::where('publish', 1)
                        ->orderby('created_at', 'desc')
                        ->paginate(10);

        $tahun = ArtikelHukumList::groupBy('tahun_artikel')->pluck('tahun_artikel');
        $penulis = ArtikelHukumList::groupBy('penulis_artikel')->pluck('penulis_artikel');

        return view('pages.artikelhukum', compact('artikelHukumList', 'tahun', 'penulis'));
    }

    public function detail($slug)
    {
        $g_setting = DB::table('general_settings')->where('id', 1)->first();

        $artikelHukumDetail = ArtikelHukumList::where('slug', $slug)->first();

        if(!$artikelHukumDetail) {
            return abort(404);
        }
        
        return view('pages.artikelhukum_detail', compact('g_setting', 'artikelHukumDetail'));
    }
}