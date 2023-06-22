<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ProdukHukumList;
use App\Models\Admin\ProdukHukumType;
use DB;

class SearchPeraturanController extends Controller
{
    public function index(Request $request)
    {
        // if($request->method() == 'GET') 
        // {
        //     return abort(404);
        // }
        
        $g_setting = DB::table('general_settings')->where('id', 1)->first();
        $menu = DB::table('menus')->where('slug', $request->slug)->first();
        $catMenuPeraturan = DB::table('produk_hukum_categories')->select('id', 'category_name')->where('category_name', 'like', 'Peraturan%')->first();

        if($request->keyword) {
            $keywords = $request->keyword;
            $param = 'keyword';
        } elseif($request->nomor) {
            $keywords = $request->nomor;
            $param = 'nomor';
        } elseif($request->tahun) {
            $keywords = $request->tahun;
            $param = 'tahun';
        } elseif($request->bentuk) {
            $typeHukum = ProdukHukumType::select('id', 'type_name')->where('id', $request->bentuk)->first();
            $keywords = $typeHukum;
            $param = 'bentuk';
        } elseif($request->status) {
            $keywords = $request->status;
            $param = 'status';
        }

        $produkHukumItems = ProdukHukumList::when($request->keyword, function($query, $keyword) {
                                return $query->where('judul_peraturan', 'like', "%{$keyword}%")->orderBy('nmr_peraturan', 'asc');
                            })->when($request->nomor, function($query, $nomor) {
                                return $query->where('nmr_peraturan', 'like', "%{$nomor}%")->orderBy('nmr_peraturan', 'asc');
                            })->when($request->tahun, function($query, $tahun) {
                                return $query->where('thn_peraturan', '=', "{$tahun}")->orderBy('nmr_peraturan', 'asc');
                            })->when($request->bentuk, function($query, $bentuk) {
                                return $query->where('produk_hukum_types_id', '=', "{$bentuk}")->orderBy('nmr_peraturan', 'asc');
                            })->when($request->status, function($query, $status) {
                                return $query->where('status_akhir', '=', "{$status}")->orderBy('nmr_peraturan', 'asc');
                            })->where('is_deleted', 0)
                              ->where('produk_hukum_categories_id', $catMenuPeraturan->id)
                              ->paginate(10);
        
        $produkHukumCount = ProdukHukumList::when($request->keyword, function($query, $keyword) {
                                return $query->where('judul_peraturan', 'like', "%{$keyword}%");
                            })->when($request->nomor, function($query, $nomor) {
                                return $query->where('nmr_peraturan', 'like', "%{$nomor}%");
                            })->when($request->tahun, function($query, $tahun) {
                                return $query->where('thn_peraturan', '=', "{$tahun}");
                            })->when($request->bentuk, function($query, $bentuk) {
                                return $query->where('produk_hukum_types_id', '=', "{$bentuk}");
                            })->when($request->status, function($query, $status) {
                                return $query->where('status_akhir', '=', "{$status}");
                            },
                            function ($query) {
                                return $query->orderByDesc('created_at');
                            })->where('is_deleted', 0)
                              ->where('produk_hukum_categories_id', $catMenuPeraturan->id)
                            ->count();

        $tahun = DB::table('produk_hukum_lists')->where('thn_peraturan', '!=', null)->where('produk_hukum_categories_id', $catMenuPeraturan->id)->groupBy('thn_peraturan')->pluck('thn_peraturan');
        $bentuk = DB::table('produk_hukum_types')->where('type_active', 1)->orderBy('type_name', 'asc')->get();
        
        if($request->slug == "home") {
            if($request->keyword == null && $request->bentuk == 0 && $request->nomor == null && $request->tahun == 0 && $request->status == null) {
                return redirect()->route('homepage');
            } else {
                return view('pages.search_peraturan_result', compact('g_setting', 'param', 'menu', 'keywords', 'tahun', 'bentuk', 'produkHukumItems', 'produkHukumCount'));
            }
        } else {
            if($request->keyword == null && $request->nomor == null && $request->tahun == 0 && $request->bentuk == 0 && $request->status == null) {
                return redirect()->route('front.peraturanhukum', ['slug' => $menu->slug]);
            } else {
                return view('pages.search_peraturan_result', compact('g_setting', 'param', 'menu', 'keywords', 'tahun', 'bentuk', 'produkHukumItems', 'produkHukumCount'));
            }
        }
    }
    
    public function dokumen(Request $request, $slug)
    {
        $g_setting = DB::table('general_settings')->where('id', 1)->first();
        $menu = DB::table('menus')->where('slug', $slug)->first();
        
        if($request->keyword == null && $request->tahun == 0) {
            return redirect()->route('front.frontpage', ['slug' => $menu->slug]);
        } else {
            if($request->keyword) {
                $keywords = $request->keyword;
            } elseif($request->tahun) {
                $keywords = $request->tahun;
            }

            $produkHukumItems = ProdukHukumList::when($request->keyword, function($query, $keyword) {
                                    return $query->where('judul_peraturan', 'like', "%{$keyword}%");
                                })->when($request->tahun, function($query, $tahun) {
                                    return $query->where('thn_peraturan', '=', "{$tahun}");
                                },
                                function ($query) {
                                    return $query->orderByDesc('created_at');
                                })->where('is_deleted', 0)
                                  ->where('produk_hukum_categories_id', $menu->type_doc)
                                  ->paginate(10);
            $produkHukumCount = ProdukHukumList::when($request->keyword, function($query, $keyword) {
                                    return $query->where('judul_peraturan', 'like', "%{$keyword}%");
                                })->when($request->tahun, function($query, $tahun) {
                                    return $query->where('thn_peraturan', '=', "{$tahun}");
                                },
                                function ($query) {
                                    return $query->orderByDesc('created_at');
                                })->where('is_deleted', 0)
                                  ->where('produk_hukum_categories_id', $menu->type_doc)
                                ->count();

            $tahun = DB::table('produk_hukum_lists')->where('thn_peraturan', '!=', null)->where('produk_hukum_categories_id', '=', $menu->type_doc)->groupBy('thn_peraturan')->pluck('thn_peraturan');

            return view('pages.search_dokumen_result', compact('g_setting', 'menu', 'keywords', 'tahun', 'produkHukumItems', 'produkHukumCount'));
        }
    }
}
