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

    public function peraturan(Request $request, $slug)
    {
        if($request->input('slugs')) {
            $slug = $request->input('slugs');
        }
        
        $menu = DB::table('menus')->where('slug', $slug)->first();
        $catMenuPeraturan = DB::table('produk_hukum_types')->select('id', 'type_name')->where('id', $menu->type_ruledoc)->first();
//        $idPeraturan = DB::table('produk_hukum_categories')->where('category_name', 'like', 'Peraturan%')->first();
        
        $keyword = $request->input('keyword');
        $nomor = $request->input('nomor');
        $tahun = $request->input('tahun');
        
        if(!$catMenuPeraturan) {
            return abort(404);
        } else {
            
            $data = ProdukHukumList::where('produk_hukum_types_id', $menu->type_ruledoc);
            
            if(($keyword != '') && ($nomor == '') && ($tahun == 0)) {
                $data->where('judul_peraturan', 'like', '%' . $keyword . '%');
            }
            
            if(($keyword == '') && ($nomor != '') && ($tahun == 0)) {
                $data->where('nmr_peraturan', $nomor);
            }
            
            if(($keyword == '') && ($nomor == '') && ($tahun != 0)) {
                $data->whereYear('thn_peraturan', $tahun);
            }
            
            if(($keyword != '') && ($nomor != '') && ($tahun == 0)) {
                $data->where('judul_peraturan', 'like', '%' . $keyword . '%')
                        ->where('nmr_peraturan', $nomor);
            }
            
            if(($keyword != '') && ($nomor == '') && ($tahun != 0)) {
                $data->where('judul_peraturan', 'like', '%' . $keyword . '%')
                        ->whereYear('thn_peraturan', $tahun);
            }
            
            if(($keyword == '') && ($nomor != '') && ($tahun != 0)) {
                $data->where('nmr_peraturan', $nomor)
                        ->whereYear('thn_peraturan', $tahun);
            }
            
            if(($keyword != '') && ($nomor != '') && ($tahun != 0)) {
                $data->where('judul_peraturan', 'like', '%' . $keyword . '%')
                        ->where('nmr_peraturan', $nomor)
                        ->whereYear('thn_peraturan', $tahun);
            }
            
            $peraturanList = $data->where('is_deleted', '=', 0)
                            ->where('is_publish', '=', 1)
                            ->orderby('tgl_pengundangan', 'desc')
                            ->paginate(10);
            $peraturanList->appends(['keyword' => $keyword, 'nomor' => $nomor, 'tahun' => $tahun]);
        }

//        $tahun = DB::table('produk_hukum_lists')
//                    ->where('thn_peraturan', '!=', null)
//                    ->where('produk_hukum_categories_id', '=', $idPeraturan->id)
//                    ->groupBy('thn_peraturan')
//                    ->pluck('thn_peraturan');
        
        $tahun = DB::table('produk_hukum_lists')
                    ->where('thn_peraturan', '!=', null)
                    ->where('produk_hukum_types_id', '=', $menu->type_ruledoc)
                    ->groupBy('thn_peraturan')
                    ->orderBy('thn_peraturan', 'desc')
                    ->pluck('thn_peraturan');
        
        $bentuk = DB::table('produk_hukum_types')
                    ->where('type_active', 1)
                    ->orderBy('type_name', 'asc')
                    ->get();

        return view('pages.peraturanhukum', compact('menu', 'catMenuPeraturan', 'peraturanList', 'tahun', 'bentuk'));
    }

    public function detail(Request $request, $menuslug, $slug)
    {
        $g_setting = DB::table('general_settings')->where('id', 1)->first();
        
        if($request->input('menuslug')) {
            $menuslug = $request->input('menuslug');
        }
        
        if($request->input('slug')) {
            $slug = $request->input('slug');
        }
        
        if($request->input('pagefrom') != 'terkait') {
            $id = decrypt($request->input('id'));
            $keyword = decrypt($request->input('keyword'));
            $nomor = decrypt($request->input('nomor'));
            $tahun = decrypt($request->input('tahun'));
            $page = decrypt($request->input('page'));
            $pageFrom = $request->input('pagefrom');
            $routes = decrypt($request->input('routes'));
        } else {
            $id = $request->input('id');
            $keyword = $request->input('keyword');
            $nomor = $request->input('nomor');
            $tahun = $request->input('tahun');
            $page = $request->input('page');
            $pageFrom = $request->input('pagefrom');
            $routes = $request->input('routes');
        }
        
        $menu = DB::table('menus')->where('slug', $menuslug)->first();

        $produkHukumDetail = ProdukHukumList::leftJoin('produk_hukum_urusan_pemerintahans', 'produk_hukum_lists.urusan', '=', 'produk_hukum_urusan_pemerintahans.id')
                                ->leftJoin('produk_hukum_bidang_hukums', 'produk_hukum_lists.bidang_hukum', '=', 'produk_hukum_bidang_hukums.id')
//                                ->where('produk_hukum_lists.produk_hukum_types_id', $menu->type_ruledoc)
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
        
        return view('pages.peraturan_detail', compact('g_setting', 'menu', 'produkHukumDetail', 'produkHukumDocument', 'keyword', 'nomor', 'tahun', 'page', 'pageFrom', 'routes', 'dokumenTerkait', 'catatanStatus'));
    }
    
    public function detailApi($menuslug, $encryptedId)
    {
        try {
            $id = Crypt::decryptString($encryptedId);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return abort(404, 'Invalid ID');
        }
        
        $g_setting = DB::table('general_settings')->where('id', 1)->first();
        
        $menu = DB::table('menus')->where('slug', $menuslug)->first();

        $produkHukumDetail = ProdukHukumList::leftJoin('produk_hukum_urusan_pemerintahans', 'produk_hukum_lists.urusan', '=', 'produk_hukum_urusan_pemerintahans.id')
                                ->leftJoin('produk_hukum_bidang_hukums', 'produk_hukum_lists.bidang_hukum', '=', 'produk_hukum_bidang_hukums.id')
                                ->where('produk_hukum_lists.produk_hukum_types_id', $menu->type_ruledoc)
                                ->where('produk_hukum_lists.id', $id)
                                ->first(['produk_hukum_lists.*', 'produk_hukum_urusan_pemerintahans.up_name', 'produk_hukum_bidang_hukums.bh_name']);
        
        $produkHukumDocument = ProdukHukumListDocument::join('produk_hukum_lists', 'produk_hukum_list_documents.peraturan_terkait', '=', 'produk_hukum_lists.id')
                                ->whereIn('produk_hukum_list_documents.produk_hukum_lists_id', array($produkHukumDetail->id))
                                ->get();
        
        $keyword = '';
        $nomor = '';
        $tahun = '';
        $page = '';
        $pageFrom = 'home';
        
        return view('pages.peraturan_detail', compact('g_setting', 'menu', 'produkHukumDetail', 'produkHukumDocument', 'keyword', 'nomor', 'tahun', 'page', 'pageFrom'));
    }
}