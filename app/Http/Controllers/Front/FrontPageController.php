<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ProdukHukumList;
use App\Models\Admin\BeritaList;
use App\Models\Admin\Page;
use App\Models\Admin\ProdukHukumListDocument;
use App\Models\Admin\ProdukHukumListDocTerkait;
use App\Models\Admin\ProdukHukumListCatatanStat;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\App;

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
            $response = app()->call("$controllerName@$secondMethod");
            
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
    
    public function detail(Request $request, $menuslug, $slug)
    {
        $g_setting = DB::table('general_settings')->where('id', 1)->first();
        
        if($request->input('menuslug')) {
            $menuslug = $request->input('menuslug');
        }
        
        if($request->input('slug')) {
            $slug = $request->input('slug');
        }

        $menu = DB::table('menus')->where('slug', $menuslug)->first();
        
        // For POST requests with encrypted data
        if ($request->isMethod('post')) {
            try {
                $id = decrypt($request->input('id'));
                $keyword = $request->input('keyword') ? decrypt($request->input('keyword')) : '';
                $kategori = $request->input('kategori') ? decrypt($request->input('kategori')) : '';
                $tahun = $request->input('tahun') ? decrypt($request->input('tahun')) : '';
                $page = $request->input('page') ? decrypt($request->input('page')) : 1;
                $pageFrom = $request->input('pagefrom') ?: '';
                $routes = $request->input('routes') ? decrypt($request->input('routes')) : '';
            } catch (\Exception $e) {
                // For direct URL access when POST data is invalid
                $document = ProdukHukumList::where('slug', $slug)
                    ->where(function($query) use ($menu) {
                        $query->where('produk_hukum_types_id', $menu->type_ruledoc)
                            ->orWhere('produk_hukum_categories_id', $menu->type_doc);
                    })
                    ->first();
                    
                if (!$document) {
                    abort(404);
                }
                
                $id = $document->id;
                $keyword = '';
                $kategori = '';
                $tahun = '';
                $page = 1;
                $pageFrom = '';
                $routes = '';
            }
        } else {
            // For direct URL access (GET requests)
            // Find the document by slug
            $document = ProdukHukumList::where('slug', $slug)
                ->where(function($query) use ($menu) {
                    $query->where('produk_hukum_types_id', $menu->type_ruledoc)
                        ->orWhere('produk_hukum_categories_id', $menu->type_doc);
                })
                ->first();
                
            if (!$document) {
                abort(404);
            }
            
            $id = $document->id;
            $keyword = '';
            $kategori = '';
            $tahun = '';
            $page = 1;
            $pageFrom = '';
            $routes = '';
        }

        $produkHukumDetail = ProdukHukumList::with(['produk_hukum_categories', 'produk_hukum_types'])
                                ->leftJoin('produk_hukum_urusan_pemerintahans', 'produk_hukum_lists.urusan', '=', 'produk_hukum_urusan_pemerintahans.id')
                                ->leftJoin('produk_hukum_bidang_hukums', 'produk_hukum_lists.bidang_hukum', '=', 'produk_hukum_bidang_hukums.id')
                                ->leftJoin('produk_hukum_categories', 'produk_hukum_lists.produk_hukum_categories_id', '=', 'produk_hukum_categories.id')
                                ->leftJoin('produk_hukum_types', 'produk_hukum_lists.produk_hukum_types_id', '=', 'produk_hukum_types.id')
                                ->where('produk_hukum_lists.id', $id)
                                ->select([
                                    'produk_hukum_lists.*',
                                    'produk_hukum_urusan_pemerintahans.up_name',
                                    'produk_hukum_bidang_hukums.bh_name',
                                    'produk_hukum_categories.category_name',
                                    'produk_hukum_types.type_name'
                                ])
                                ->first();

        if(!$produkHukumDetail) {
            abort(404);
        }

        $produkHukumDetail->increment('view');

        $produkHukumListDocument = ProdukHukumListDocument::where('produk_hukum_lists_id', $id)->get();
        $produkHukumListDocTerkait = ProdukHukumListDocTerkait::where('produk_hukum_lists_id', $id)->get();
        $produkHukumListCatatanStat = ProdukHukumListCatatanStat::where('produk_hukum_lists_id', $id)->get();

        return view('pages.frontpage_detail', compact('g_setting', 'menu', 'produkHukumDetail', 'produkHukumListDocument', 'produkHukumListDocTerkait', 'produkHukumListCatatanStat', 'keyword', 'kategori', 'tahun', 'page', 'pageFrom', 'routes'));
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