<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\Admin\ProdukHukumList;
use App\Models\Admin\BeritaList;
use App\Models\Admin\ProdukHukumType;
use App\Models\Admin\ProdukHukumCategory;
use App\Models\Tracker;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function index()
    {
    	$sliders = DB::table('sliders')->get();
    	$page_home = DB::table('page_home_items')->where('id',1)->first();
    	$why_choose_items = DB::table('why_choose_items')->get();
    	$services = DB::table('services')->get();
    	$testimonials = DB::table('testimonials')->get();
    	$projects = DB::table('projects')->get();
    	$team_members = DB::table('team_members')->get();
    	$blogs = DB::table('blogs')->get();

        $artikelId = DB::table('produk_hukum_categories')->where('category_name', 'like', 'Artikel%')->first();
        $artikelMenu = DB::table('menus')->where('type_doc', '=', $artikelId->id)->first();
        $artikel = ProdukHukumList::where('produk_hukum_categories_id', '=', $artikelId->id)->where('is_publish', '=', 1)->where('is_deleted', '=', 0)->get();
        
        $majalahId = DB::table('produk_hukum_categories')->where('category_name', 'like', 'Monografi%')->first();
        $majalahMenu = DB::table('menus')->where('type_doc', '=', $majalahId->id)->first();
        $majalah = ProdukHukumList::where('produk_hukum_categories_id', '=', $majalahId->id)->where('is_publish', '=', 1)->where('is_deleted', '=', 0)->get();
        
        $peraturanId = DB::table('produk_hukum_categories')->where('category_name', 'like', 'Peraturan%')->first();
        $peraturanTerbaru = ProdukHukumList::join('menus', 'produk_hukum_lists.produk_hukum_types_id', '=', 'menus.type_ruledoc')
                                ->select('produk_hukum_lists.*', 'menus.slug as menuSlug')
                                ->where('produk_hukum_lists.produk_hukum_categories_id', $peraturanId->id)
                                ->where('produk_hukum_lists.is_deleted', 0)
                                ->orderBy('produk_hukum_lists.updated_at', 'desc')
                                ->paginate(5);
        
        $peraturanTerpopuler = ProdukHukumList::join('menus', 'produk_hukum_lists.produk_hukum_types_id', '=', 'menus.type_ruledoc')
                                ->select('produk_hukum_lists.*', 'menus.slug as menuSlug')
                                ->where('produk_hukum_lists.produk_hukum_categories_id', $peraturanId->id)
                                ->where('produk_hukum_lists.is_deleted', 0)
                                ->orderBy('produk_hukum_lists.view', 'desc')
                                ->paginate(5);
        
        $produkHukumType = ProdukHukumType::select('id', 'type_name')->where('type_active', '=', 1)->get();
        
        $produkHukumKategoriId = ProdukHukumCategory::where('category_name', 'like', 'Peraturan%')->first();
        $produkHukumKategoriStatus = ProdukHukumList::where('produk_hukum_categories_id', '=', $produkHukumKategoriId->id)->groupBy('status_akhir')->pluck('status_akhir');
        
        $berita = BeritaList::where('publish', '=', 1)->where('is_deleted', '=', 0)->orderBy('publish_at', 'desc')->limit(6)->get();

        Tracker::hit();

        return view('pages.index', compact('sliders','page_home','why_choose_items','services', 'testimonials','projects','team_members','blogs', 'artikel', 'artikelMenu', 'majalah', 'majalahMenu', 'peraturanTerbaru', 'peraturanTerpopuler', 'produkHukumType', 'produkHukumKategoriStatus', 'berita'));
    }
}
