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

class DokumenKerjasamaController extends Controller
{
    public function index(Request $request)
    {
        $url = $request->path();
        $conName = explode('/',$url);
        $slug = $conName[1];
        
        $menu = DB::table('menus')->where('slug', $slug)->first();
        
        $keyword = $request->input('keyword');
        $tahun = $request->input('tahun');
        
        $data = ProdukHukumList::join('produk_hukum_types', 'produk_hukum_lists.produk_hukum_types_id', '=', 'produk_hukum_types.id');
            
        if(($keyword != '') && ($tahun == 0)) {
            $data->where('produk_hukum_lists.judul_peraturan', 'like', '%' . $keyword . '%');
        }

        if(($keyword == '') && ($tahun != 0)) {
            $data->whereYear('produk_hukum_lists.thn_peraturan', $tahun);
        }

        if(($keyword != '') && ($tahun != 0)) {
            $data->where('produk_hukum_lists.judul_peraturan', 'like', '%' . $keyword . '%')
                    ->whereYear('produk_hukum_lists.thn_peraturan', $tahun);
        }

        $contentList = $data->select(['produk_hukum_lists.*'])
                        ->where('produk_hukum_types.type_name', '=', 'MOU/PKS')
                        ->where('produk_hukum_lists.is_deleted', '=', 0)
                        ->where('produk_hukum_lists.is_publish', '=', 1)
                        ->orderByRaw('CASE WHEN produk_hukum_lists.tgl_pengundangan IS NULL THEN 1 ELSE 0 END, produk_hukum_lists.tgl_pengundangan DESC, produk_hukum_lists.created_at DESC')
                        ->paginate(10);

        $contentList->appends(['keyword' => $keyword, 'tahun' => $tahun]);
        
        $tahun = ProdukHukumList::join('produk_hukum_types', 'produk_hukum_lists.produk_hukum_types_id', '=', 'produk_hukum_types.id')
                    ->where('produk_hukum_types.type_name', '=', 'MOU/PKS')
                    ->where('produk_hukum_lists.thn_peraturan', '!=', null)
                    ->where('produk_hukum_lists.is_deleted', 0)
                    ->where('produk_hukum_lists.is_publish', 1)
                    ->groupBy('produk_hukum_lists.thn_peraturan')
                    ->orderBy('produk_hukum_lists.thn_peraturan', 'desc')
                    ->pluck('produk_hukum_lists.thn_peraturan');
        
        return view('pages.frontpage_pool', compact('menu', 'contentList', 'tahun'));
    }
}