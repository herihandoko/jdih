<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\MajalahHukumList;
use DB;

class SearchHukumAdatViewController extends Controller
{
    public function index(Request $request)
    {
        $g_setting = DB::table('general_settings')->where('id', 1)->first();
        $keywords = $request->keyword;

        $majalahHukumItems = MajalahHukumList::when($request->keyword, function ($query, $keyword) {
            return $query->where('judul_majalah', 'like', "%{$keyword}%");
        })->when($request->tahun, function ($query, $tahun) {
            return $query->where('tahun_majalah', '=', "{$tahun}");
        })->when(
            $request->penerbit,
            function ($query, $penerbit) {
                return $query->where('penerbit_majalah', '=', "{$penerbit}");
            },
            function ($query) {
                return $query->orderByDesc('created_at');
            }
        )->paginate(10);

        $tahun = MajalahHukumList::groupBy('tahun_majalah')->pluck('tahun_majalah');
        $penerbit = MajalahHukumList::groupBy('penerbit_majalah')->pluck('penerbit_majalah');

        return view('pages.search_majalah_result', compact('g_setting', 'keywords', 'tahun', 'penerbit', 'majalahHukumItems'));
    }
}
