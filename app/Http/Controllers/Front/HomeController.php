<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\Admin\ProdukHukumList;
use App\Models\Admin\BeritaList;
use App\Models\Admin\Videos;
use App\Models\Admin\ProdukHukumType;
use App\Models\Admin\ProdukHukumCategory;
use App\Models\Admin\ApiLink;
use App\Models\Tracker;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    public function index()
    {
    	$sliders = DB::table('sliders')->where('is_publish', 1)->orderBy('slider_sort', 'asc')->get();
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
                                ->where('produk_hukum_lists.is_publish', 1)
                                ->where('produk_hukum_lists.is_deleted', 0)
                                ->orderBy('produk_hukum_lists.tgl_pengundangan', 'desc')
                                ->paginate(5);
        
        $peraturanTerpopuler = ProdukHukumList::join('menus', 'produk_hukum_lists.produk_hukum_types_id', '=', 'menus.type_ruledoc')
                                ->select('produk_hukum_lists.*', 'menus.slug as menuSlug')
                                ->where('produk_hukum_lists.produk_hukum_categories_id', $peraturanId->id)
                                ->where('produk_hukum_lists.is_publish', 1)
                                ->where('produk_hukum_lists.is_deleted', 0)
                                ->orderBy('produk_hukum_lists.view', 'desc')
                                ->paginate(5);
        
        $produkHukumKategori = ProdukHukumCategory::select('id', 'category_name')->where('category_active', '=', 1)->get();
        
        $produkHukumKategoriId = ProdukHukumCategory::where('category_name', 'like', 'Peraturan%')->first();
        $produkHukumKategoriStatus = ProdukHukumList::where('produk_hukum_categories_id', '=', $produkHukumKategoriId->id)->groupBy('status_akhir')->pluck('status_akhir');
        
        $instansi = ApiLink::select('id', 'api_name')->where('api_active', '=', 1)->get();
        
        $berita = BeritaList::join('admins', 'berita_lists.created_by', '=', 'admins.id')
                    ->select('berita_lists.judul_berita', 'berita_lists.content_berita', 'berita_lists.slug', 'berita_lists.photo_berita', 'berita_lists.created_at', 'berita_lists.publish_at', 'admins.name',)
                    ->where('berita_lists.publish', '=', 1)
                    ->where('berita_lists.is_deleted', '=', 0)
                    ->orderBy('berita_lists.publish_at', 'desc')
                    ->limit(6)
                    ->get();
        
        $video = Videos::where('publish', '=', 1)->where('is_deleted', '=', 0)->orderBy('publish_at', 'desc')->limit(6)->get();
        
        $totalPeraturan = DB::select('select full_month.month, COUNT(a.id) AS total from (
					SELECT 1 AS MONTH
				 UNION SELECT 2 AS MONTH
				 UNION SELECT 3 AS MONTH
				 UNION SELECT 4 AS MONTH
				 UNION SELECT 5 AS MONTH
				 UNION SELECT 6 AS MONTH
				 UNION SELECT 7 AS MONTH
				 UNION SELECT 8 AS MONTH
				 UNION SELECT 9 AS MONTH
				 UNION SELECT 10 AS MONTH
				 UNION SELECT 11 AS MONTH
				 UNION SELECT 12 AS MONTH ) as full_month LEFT JOIN produk_hukum_lists a ON full_month.month = MONTH(a.tgl_penetapan) AND YEAR(a.tgl_penetapan) = YEAR(CURDATE()) LEFT JOIN produk_hukum_categories b ON a.produk_hukum_categories_id = b.id AND b.category_name = "Peraturan Perundang-undangan" GROUP BY full_month.month ORDER BY full_month.month');

        Tracker::hit();

        return view('pages.index', compact('sliders','page_home','why_choose_items','services', 'testimonials','projects','team_members','blogs', 'artikel', 'artikelMenu', 'majalah', 'majalahMenu', 'peraturanTerbaru', 'peraturanTerpopuler', 'produkHukumKategori', 'produkHukumKategoriStatus', 'berita', 'video', 'totalPeraturan', 'instansi'));
    }
    
    public function getJenisByKategori($kategoriId)
    {
        $jenis = ProdukHukumList::join('produk_hukum_types', 'produk_hukum_lists.produk_hukum_types_id', '=', 'produk_hukum_types.id')
                                ->where('produk_hukum_lists.produk_hukum_categories_id', $kategoriId)->pluck('produk_hukum_types.type_name', 'produk_hukum_types.id');
        return response()->json($jenis);
    }
}
