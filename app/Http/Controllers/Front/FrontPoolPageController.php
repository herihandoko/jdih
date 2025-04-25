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

class FrontPoolPageController extends Controller
{
    public function detail(Request $request)
    {
        $g_setting = DB::table('general_settings')->where('id', 1)->first();
        
        if($request->input('menuslug')) {
            $menuslug = $request->input('menuslug');
        }
        
        if($request->input('slug')) {
            $slug = $request->input('slug');
        }
        
        $id = decrypt($request->input('id'));
        $keyword = decrypt($request->input('keyword'));
        $tahun = decrypt($request->input('tahun'));
        $page = decrypt($request->input('page'));
        $pageFrom = $request->input('pagefrom');
        $routes = decrypt($request->input('routes'));
        
        $menu = DB::table('menus')->where('slug', $menuslug)->first();
        
        $produkHukumDetail = ProdukHukumList::leftJoin('produk_hukum_urusan_pemerintahans', 'produk_hukum_lists.urusan', '=', 'produk_hukum_urusan_pemerintahans.id')
                                ->leftJoin('produk_hukum_bidang_hukums', 'produk_hukum_lists.bidang_hukum', '=', 'produk_hukum_bidang_hukums.id')
                                ->where('produk_hukum_lists.id', $id)
                                ->first(['produk_hukum_lists.*', 'produk_hukum_urusan_pemerintahans.up_name', 'produk_hukum_bidang_hukums.bh_name']);
        
        $produkHukumDocument = ProdukHukumListDocument::join('produk_hukum_lists', 'produk_hukum_list_documents.peraturan_terkait', '=', 'produk_hukum_lists.id')
                                ->whereIn('produk_hukum_list_documents.produk_hukum_lists_id', array($produkHukumDetail->id))
                                ->get();
        
        $dokumenTerkait = ProdukHukumListDocTerkait::join('produk_hukum_lists', 'produk_hukum_list_doc_terkaits.produk_hukum_lists_id', '=', 'produk_hukum_lists.id')
                            ->whereIn('produk_hukum_list_doc_terkaits.produk_hukum_lists_id', array($produkHukumDetail->id))
                            ->get();
        
        $catatanStatus = ProdukHukumListCatatanStat::join('produk_hukum_lists', 'produk_hukum_list_catatan_stats.peraturan_catatan', '=', 'produk_hukum_lists.id')
                            ->select(['produk_hukum_list_catatan_stats.id AS id_catsts', 'produk_hukum_list_catatan_stats.produk_hukum_lists_id', 'produk_hukum_list_catatan_stats.peraturan_catatan', 'produk_hukum_list_catatan_stats.jenis_status', 'produk_hukum_lists.*'])
                            ->whereIn('produk_hukum_list_catatan_stats.produk_hukum_lists_id', array($produkHukumDetail->id))
                            ->get();
        
        $produkCat = ProdukHukumList::join('produk_hukum_categories', 'produk_hukum_lists.produk_hukum_categories_id', 'produk_hukum_categories.id')
                        ->where('produk_hukum_lists.id', $id)
                        ->first(['produk_hukum_categories.category_name']);

        if(!$produkHukumDetail) {
            return abort(404);
        } else {
            $currentView = $produkHukumDetail->view;
            $plusOneView = $currentView + 1;
            $dataView = [
                'view' => $plusOneView
            ];

            ProdukHukumList::where('id', '=', $produkHukumDetail->id)->update($dataView);
        }
        
        return view('pages.frontpage_pool_detail', compact('g_setting', 'menu', 'produkHukumDetail', 'produkHukumDocument', 'keyword', 'tahun', 'page', 'pageFrom', 'routes', 'dokumenTerkait', 'catatanStatus', 'produkCat'));
    }
}