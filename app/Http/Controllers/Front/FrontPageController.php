<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ProdukHukumList;
use App\Models\Admin\BeritaList;
use App\Models\Admin\Page;
use Illuminate\Support\Str;
use DB;

class FrontPageController extends Controller
{
    public function index(Request $request, $slug)
    {
        if($request->input('slugs')) {
            $slug = $request->input('slugs');
        }
        
        $menu = DB::table('menus')->where('slug', $slug)->first();
        $pageView = Page::where('id', $menu->page_id)->first();
        
        $keyword = $request->input('keyword');
        $tahun = $request->input('tahun');
        
        if(isset($pageView)) {
            $secondNamespace = 'App\Http\Controllers\Front\\';
            $controllerName = $secondNamespace . $pageView->page_view;
            $secondMethod = 'index';
            $response = \App::call("$controllerName@$secondMethod");
            
            return $response;
        } else {
            
            $data = ProdukHukumList::where('produk_hukum_categories_id', $menu->type_doc);
            
            if(($keyword != '') && ($tahun == 0)) {
                $data->where(function($query) use ($keyword) {
                        $query->where('judul_peraturan', 'like', '%' . $keyword . '%')
                              ->orWhere('teu_badan', 'like', '%' . $keyword . '%');
                        });
            }
            
            if(($keyword == '') && ($tahun != 0)) {
                $data->whereYear('thn_peraturan', $tahun);
            }
            
            if(($keyword != '') && ($tahun != 0)) {
                
                $data->where(function($query) use ($keyword) {
                        $query->where('judul_peraturan', 'like', '%' . $keyword . '%')
                              ->orWhere('teu_badan', 'like', '%' . $keyword . '%');
                        })
                        ->whereYear('thn_peraturan', $tahun);
            }
            
            $contentList = $data->where('is_deleted', 0)
                            ->where('is_publish', 1)
                            ->orderby('created_at', 'desc')
                            ->paginate(10);
            $contentList->appends(['keyword' => $keyword, 'tahun' => $tahun]);
            
//            $contentList = ProdukHukumList::where('produk_hukum_categories_id', $menu->type_doc)
//                            ->where('is_deleted', 0)
//                            ->where('is_publish', 1)
//                            ->orderby('created_at', 'desc')
//                            ->paginate(10);

            $tahun = DB::table('produk_hukum_lists')
                        ->where('thn_peraturan', '!=', null)
                        ->where('produk_hukum_categories_id', '=', $menu->type_doc)
                        ->groupBy('thn_peraturan')
                        ->orderBy('thn_peraturan', 'desc')
                        ->pluck('thn_peraturan');
            
            return view('pages.frontpage', compact('menu', 'contentList', 'tahun'));
        }
    }
    
    public function detail(Request $request)
    {
        $g_setting = DB::table('general_settings')->where('id', 1)->first();
        
        $menuslug = $request->input('menuslug');
        $slug = $request->input('slug');
        
        $menu = DB::table('menus')->where('slug', $menuslug)->first();

//        $produkHukumDetail = ProdukHukumList::leftJoin('produk_hukum_types', 'produk_hukum_lists.produk_hukum_types_id', '=', 'produk_hukum_types.id')
//                                                ->where('produk_hukum_categories_id', $menu->type_doc)
//                                                ->where('slug', $slug)
//                                                ->first();
        
        $produkHukumDetail = ProdukHukumList::where('id', $request->input('id'))->first();

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
        
        $keyword = $request->input('keyword');
        $tahun = $request->input('tahun');
        $page = $request->input('page', 1);
        
        return view('pages.frontpage_detail', compact('g_setting', 'menu', 'produkHukumDetail', 'keyword', 'tahun', 'page'));
    }
    
    public function detailBerita($slug) {
        $g_setting = DB::table('general_settings')->where('id', 1)->first();

        $beritaDetail = BeritaList::join('admins', 'berita_lists.created_by', '=', 'admins.id')
                        ->where('berita_lists.slug', $slug)
                        ->first();
        
        $beritaList = BeritaList::join('admins', 'berita_lists.created_by', '=', 'admins.id')
                        ->where('berita_lists.is_deleted', 0)
                        ->where('berita_lists.publish', 1)
                        ->where('berita_lists.slug', '!=', $slug)
                        ->orderby('berita_lists.created_at', 'desc')
                        ->get();
        
        return view('pages.berita_detail', compact('g_setting', 'beritaDetail', 'beritaList'));
    }
}