<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ProdukHukumList;
use DB;

class SearchPeraturanPusatController extends Controller
{
    public function index(Request $request, $slug)
    {
        // if($request->method() == 'GET') 
        // {
        //     return abort(404);
        // }

        $g_setting = DB::table('general_settings')->where('id', 1)->first();
        $menu = DB::table('menus')->select('menu_name', 'slug')->where('slug', $slug)->first();
        $catMenuPeraturan = DB::table('produk_hukum_categories')->select('id', 'category_name')->where('category_name', $menu->menu_name)->first();
        $keywords = $request->keyword;

        $produkHukumItems = ProdukHukumList::when($request->keyword, function($query, $keyword) {
            return $query->where('judul_peraturan', 'like', "%{$keyword}%");
        })->when($request->nomor, function($query, $nomor) {
            return $query->where('nmr_peraturan', 'like', "%{$nomor}%");
        })->when($request->tahun, function($query, $tahun) {
            return $query->where('thn_peraturan', '=', "{$tahun}");
        })->when($request->bentuk, function($query, $bentuk) {
            return $query->where('produk_hukum_types_id', '=', "{$bentuk}");
        },
        function ($query) {
            return $query->orderByDesc('created_at');
        })->where('produk_hukum_categories_id', $catMenuPeraturan->id)->paginate(10);

        $tahun = DB::table('produk_hukum_lists')->groupBy('thn_peraturan')->pluck('thn_peraturan');
        $bentuk = DB::table('produk_hukum_types')->where('type_active', 1)->orderBy('type_name', 'asc')->get();

        return view('pages.search_peraturan_result', compact('g_setting', 'menu', 'keywords', 'tahun', 'bentuk', 'produkHukumItems'));
    }
}
    