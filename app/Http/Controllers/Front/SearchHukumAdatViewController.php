<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\MajalahHukumList;
use App\Models\Admin\HukumAdat;
use App\Models\Admin\HukumAdatRegulasi;
use DB;

class SearchHukumAdatViewController extends Controller
{
    public function index(Request $request)
    {
        $g_setting = DB::table('general_settings')->where('id', 1)->first();
        $keywords = $request->keyword;

        $hukumadatList = HukumAdat::when($request->keyword, function ($query, $keyword) {
            return $query->where('hukumadat_name', 'like', "%{$keyword}%")->where('is_deleted', 0)->orderby('created_at', 'desc');
        })->paginate(10);

        return view('pages.search_hukumadat_result', compact('g_setting', 'keywords', 'hukumadatList'));
    }
}
