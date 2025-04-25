<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Admin\ProdukHukumList;
use App\Models\Admin\ProdukHukumListDocument;
use App\Models\Admin\ProdukHukumListDocTerkait;
use App\Models\Admin\ProdukHukumListCatatanStat;
use App\Models\Admin\Menu;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use DB;

class DokumenHukumTerjemahanController extends Controller
{
    public function index(Request $request)
    {
        $url = $request->path();
        $conName = explode('/',$url);
        $slug = $conName[1];
        
        $menu = DB::table('menus')->where('slug', $slug)->first();
        
        $keyword = $request->input('keyword');
        $tahun = $request->input('tahun');
        
        $data = ProdukHukumList::where('bahasa', 'English');
            
        if(($keyword != '') && ($tahun == 0)) {
            $data->where('judul_peraturan', 'like', '%' . $keyword . '%');
        }

        if(($keyword == '') && ($tahun != 0)) {
            $data->whereYear('thn_peraturan', $tahun);
        }

        if(($keyword != '') && ($tahun != 0)) {
            $data->where('judul_peraturan', 'like', '%' . $keyword . '%')
                    ->whereYear('thn_peraturan', $tahun);
        }

        $contentList = $data->where('is_deleted', '=', 0)
                        ->where('is_publish', '=', 1)
                        ->orderByRaw('CASE WHEN tgl_pengundangan IS NULL THEN 1 ELSE 0 END, tgl_pengundangan DESC, created_at DESC')
                        ->paginate(10);

        $contentList->appends(['keyword' => $keyword, 'tahun' => $tahun]);
        
        $tahun = DB::table('produk_hukum_lists')
                    ->where('thn_peraturan', '!=', null)
                    ->where('bahasa', 'English')
                    ->where('is_deleted', 0)
                    ->where('is_publish', 1)
                    ->groupBy('thn_peraturan')
                    ->orderBy('thn_peraturan', 'desc')
                    ->pluck('thn_peraturan');
        
        return view('pages.frontpage_pool', compact('menu', 'contentList', 'tahun'));
    }
}