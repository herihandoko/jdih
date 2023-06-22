<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\ProdukHukumList;
use App\Models\Admin\BeritaList;
use App\Models\Admin\PhotosList;
use Illuminate\Support\Str;
use DB;

class FrontPageController extends Controller
{
    public function index($slug)
    {   
        if($slug == "berita") {
            $contentList = BeritaList::join('admins', 'berita_lists.created_by', '=', 'admins.id')
                            ->where('berita_lists.is_deleted', 0)
                            ->where('berita_lists.publish', 1)
                            ->orderby('berita_lists.created_at', 'desc')
                            ->paginate(10);
            
            $contentCount = BeritaList::where('is_deleted', 0)
                            ->where('publish', 1)
                            ->orderby('created_at', 'desc')
                            ->count();
            
            return view('pages.berita', compact('contentList', 'contentCount'));
        } elseif(Str::contains($slug, 'foto')) {
            $contentList = PhotosList::where('is_deleted', 0)
                            ->orderby('created_at', 'desc')
                            ->paginate(10);
            
            $contentCount = PhotosList::where('is_deleted', 0)
                            ->orderby('created_at', 'desc')
                            ->count();
            
            return view('pages.photo_gallery', compact('contentList', 'contentCount'));
        } else {
            $menu = DB::table('menus')->where('slug', $slug)->first();
            
            $contentList = ProdukHukumList::where('produk_hukum_categories_id', $menu->type_doc)
                            ->where('is_deleted', 0)
                            ->where('is_publish', 1)
                            ->orderby('created_at', 'desc')
                            ->paginate(10);

            $contentCount = ProdukHukumList::where('produk_hukum_categories_id', $menu->type_doc)
                            ->where('is_deleted', 0)
                            ->where('is_publish', 1)
                            ->count();

            $tahun = DB::table('produk_hukum_lists')->where('thn_peraturan', '!=', null)->where('produk_hukum_categories_id', '=', $menu->type_doc)->groupBy('thn_peraturan')->pluck('thn_peraturan');
            
            return view('pages.frontpage', compact('menu', 'contentList', 'contentCount', 'tahun'));
        }
    }
    
    public function detail($menuslug, $slug)
    {
        $g_setting = DB::table('general_settings')->where('id', 1)->first();
        $menu = DB::table('menus')->where('slug', $menuslug)->first();

        $produkHukumDetail = ProdukHukumList::where('produk_hukum_categories_id', $menu->type_doc)->where('slug', $slug)->first();

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
        
        return view('pages.frontpage_detail', compact('g_setting', 'menu', 'produkHukumDetail'));
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