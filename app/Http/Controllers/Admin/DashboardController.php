<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $peraturan = DB::select('SELECT DISTINCT a.type_name as nama_peraturan, (select count(produk_hukum_lists.produk_hukum_types_id) from produk_hukum_lists where a.id = produk_hukum_lists.produk_hukum_types_id and produk_hukum_lists.is_deleted = 0 ) as total_peraturan FROM produk_hukum_types a LEFT JOIN produk_hukum_lists b ON a.id = b.produk_hukum_types_id where a.type_active = 1');
        $kategori = DB::select('SELECT DISTINCT a.category_name as nama_kategori, (select count(produk_hukum_lists.produk_hukum_categories_id) from produk_hukum_lists where a.id = produk_hukum_lists.produk_hukum_categories_id and produk_hukum_lists.is_deleted = 0 ) as total_kategori FROM produk_hukum_categories a LEFT JOIN produk_hukum_lists b ON a.id = b.produk_hukum_types_id where a.category_active = 1');
        $peraturanCurrentYear = DB::select('SELECT DISTINCT a.type_name as nama_peraturan, (select count(produk_hukum_lists.produk_hukum_types_id) from produk_hukum_lists where a.id = produk_hukum_lists.produk_hukum_types_id and produk_hukum_lists.is_deleted = 0 and produk_hukum_lists.thn_peraturan = YEAR(CURDATE()) ) as total_peraturan FROM produk_hukum_types a LEFT JOIN produk_hukum_lists b ON a.id = b.produk_hukum_types_id where a.type_active = 1');
        
        $idPeraturan = DB::table('produk_hukum_categories')->where('category_name', 'like', 'Peraturan%')->first();
        $tahun = DB::table('produk_hukum_lists')
                ->where('thn_peraturan', '!=', null)
                ->where('thn_peraturan', '<', Carbon::now()->format('Y'))
                ->where('produk_hukum_categories_id', '=', $idPeraturan->id)
                ->groupBy('thn_peraturan')
                ->orderBy('thn_peraturan', 'desc')
                ->pluck('thn_peraturan');
        
        return view('admin.home', compact('peraturan', 'kategori', 'peraturanCurrentYear', 'tahun'));
    }
    
    public function getyear() {
        $year = $_GET['years'];
        $peraturanLastYear = DB::select('SELECT DISTINCT a.type_name as nama_peraturan, (select count(produk_hukum_lists.produk_hukum_types_id) from produk_hukum_lists where a.id = produk_hukum_lists.produk_hukum_types_id and produk_hukum_lists.is_deleted = 0 and produk_hukum_lists.thn_peraturan = '.$year.' ) as total_peraturan FROM produk_hukum_types a LEFT JOIN produk_hukum_lists b ON a.id = b.produk_hukum_types_id where a.type_active = 1');
        
        return response()->json($peraturanLastYear);
    }
}