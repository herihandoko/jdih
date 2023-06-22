<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Admin\ProdukHukumList;
use App\Models\Admin\ProdukHukumListDocument;
use App\Models\Admin\Menu;
use DB;

class ProdukHukumController extends Controller
{
    // public function peraturanpusat()
    // {
    //     $peraturanPusat = DB::table('produk_hukum_categories')
    //                     ->where('category_name', 'Peraturan Pusat')
    //                     ->where('category_active', 1)
    //                     ->first();

    //     $peraturanList = ProdukHukumList::
    //                     where('produk_hukum_categories_id', $peraturanPusat->id)
    //                     ->orderby('created_at', 'desc')
    //                     ->paginate(10);

    //     $tahun = DB::table('produk_hukum_lists')->groupBy('thn_peraturan')->pluck('thn_peraturan');
    //     $bentuk = DB::table('produk_hukum_types')->where('type_active', 1)->orderBy('type_name', 'asc')->get();

    //     return view('pages.peraturanpusat', compact('peraturanPusat', 'peraturanList', 'tahun', 'bentuk'));
    // }

    public function peraturan($slug) {
        $menu = DB::table('menus')->where('slug', $slug)->first();
        $catMenuPeraturan = DB::table('produk_hukum_types')->select('id', 'type_name')->where('id', $menu->type_ruledoc)->first();
        $idPeraturan = DB::table('produk_hukum_categories')->where('category_name', 'like', 'Peraturan%')->first();
        
        if(!$catMenuPeraturan) {
            return abort(404);
        } else {
            $peraturanList = ProdukHukumList::where('produk_hukum_types_id', $menu->type_ruledoc)
                        ->where('is_deleted', 0)
                        ->orderby('updated_at', 'desc')
                        ->paginate(10);
        }
        
        $peraturanCount = ProdukHukumList::where('produk_hukum_types_id', $menu->type_ruledoc)->where('is_deleted', 0)->count();

        $tahun = DB::table('produk_hukum_lists')->where('thn_peraturan', '!=', null)->where('produk_hukum_categories_id', '=', $idPeraturan->id)->groupBy('thn_peraturan')->pluck('thn_peraturan');
        $bentuk = DB::table('produk_hukum_types')->where('type_active', 1)->orderBy('type_name', 'asc')->get();

        return view('pages.peraturanhukum', compact('menu', 'catMenuPeraturan', 'peraturanList', 'tahun', 'bentuk', 'peraturanCount'));
    }

    public function detail($menuslug, $slug)
    {
        $g_setting = DB::table('general_settings')->where('id', 1)->first();
        $menu = DB::table('menus')->where('slug', $menuslug)->first();

        $produkHukumDetail = ProdukHukumList::leftJoin('produk_hukum_urusan_pemerintahans', 'produk_hukum_lists.urusan', '=', 'produk_hukum_urusan_pemerintahans.id')
                                ->leftJoin('produk_hukum_bidang_hukums', 'produk_hukum_lists.bidang_hukum', '=', 'produk_hukum_bidang_hukums.id')
                                ->where('produk_hukum_lists.produk_hukum_types_id', $menu->type_ruledoc)
                                ->where('produk_hukum_lists.slug', $slug)
                                ->first(['produk_hukum_lists.*', 'produk_hukum_urusan_pemerintahans.up_name', 'produk_hukum_bidang_hukums.bh_name']);
        
        $produkHukumDocument = ProdukHukumListDocument::join('produk_hukum_lists', 'produk_hukum_list_documents.peraturan_terkait', '=', 'produk_hukum_lists.id')
                                ->whereIn('produk_hukum_list_documents.produk_hukum_lists_id', array($produkHukumDetail->id))
                                ->get();

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
        
        return view('pages.peraturan_detail', compact('g_setting', 'menu', 'produkHukumDetail', 'produkHukumDocument'));
    }
}