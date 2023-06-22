<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ArtikelHukumList;
use DB;

class SearchArtikelHukumController extends Controller
{
    public function index(Request $request)
    {
        $g_setting = DB::table('general_settings')->where('id', 1)->first();
        $keywords = $request->keyword;

        $artikelHukumItems = ArtikelHukumList::when($request->keyword, function($query, $keyword) {
            return $query->where('judul_artikel', 'like', "%{$keyword}%");
        })->when($request->tahun, function($query, $tahun) {
            return $query->where('tahun_artikel', '=', "{$tahun}");
        })->when($request->penulis, function($query, $penulis) {
            return $query->where('penulis_artikel', '=', "{$penulis}");
        },
        function ($query) {
            return $query->orderByDesc('created_at');
        })->paginate(10);

        $tahun = ArtikelHukumList::groupBy('tahun_artikel')->pluck('tahun_artikel');
        $penulis = ArtikelHukumList::groupBy('penulis_artikel')->pluck('penulis_artikel');

        return view('pages.search_artikel_result', compact('g_setting', 'keywords', 'tahun', 'penulis', 'artikelHukumItems'));
    }
}