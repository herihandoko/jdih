<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Admin\ProdukHukumList;
use App\Models\Admin\ProdukHukumType;
use App\Models\Admin\ProdukHukumCategory;
use App\Models\Admin\ProdukHukumListDocument;
use App\Models\Admin\ProdukHukumListDocTerkait;
use App\Models\Admin\ProdukHukumListCatatanStat;
use App\Models\ApiQuery;
use App\Models\Admin\ApiLink;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use DB;

class SearchPeraturanController extends Controller
{
    public function index(Request $request)
    {
        $validated = $request->validate([
            'keyword' => 'nullable|string|max:1000',
            'nomor' => 'nullable|string|max:50',
            'kategori' => 'nullable|integer|exists:produk_hukum_categories,id',
            'tahun' => 'nullable|integer|digits:4',
            'bentuk' => 'nullable|integer|exists:produk_hukum_types,id',
            'status' => 'nullable|string|max:50',
            'instansi' => 'nullable|integer'
        ]);

        if ($this->isAllInputsEmpty($validated)) {
            return redirect()->route('homepage');
        }

        if ($validated['kategori'] && empty($validated['bentuk'])) {
            return redirect()->route('homepage')->with('error', 'Jenis Dokumen belum dipilih!');
        }

        $g_setting = DB::table('general_settings')->where('id', 1)->first();
        $menu = DB::table('menus')->where('slug', $request->slug)->first();

        $keywords = '';
        $param = '';
        $typeHukum = null;

        // Simpan parameter pencarian di session jika request adalah POST
        if ($request->isMethod('post')) {
            $searchParams = $request->except('_token', 'page');
            session(['search_params' => $searchParams]);
        }
        
        if ($request->isMethod('post')) {
            $searchParams = $request->except('_token', 'page');

            // Tambahkan typeHukum ke searchParams jika ada
            if (!empty($searchParams['bentuk'])) {
                $typeHukum = ProdukHukumType::select('id', 'type_name')->where('id', $searchParams['bentuk'])->first();
                $searchParams['type_hukum'] = $typeHukum;
            }

            session(['search_params' => $searchParams]);
        }

        // Ambil parameter pencarian dari session
        $searchParams = session('search_params', []);

        if ($request->keyword) {
            $keywords = $request->keyword;
            $param = 'Keyword';
        }
        if ($request->nomor) {
            $keywords = $request->nomor;
            $param = 'Nomor';
        }
        if ($request->kategori) {
            $categoryDoc = ProdukHukumCategory::select('id', 'category_name')->where('id', $request->kategori)->first();
            $keywords = $categoryDoc;
            $param = 'Kategori';
        }
        if ($request->tahun) {
            $keywords = $request->tahun;
            $param = 'Tahun';
        }
        if ($request->bentuk) {
            $typeHukum = ProdukHukumType::select('id', 'type_name')->where('id', $request->bentuk)->first();
            $keywords = $typeHukum;
            $param = 'Bentuk';
        }
        if ($request->status) {
            $keywords = $request->status;
            $param = 'Status';
        }
        if($request->instansi) {
            $instansiPemerintah = ApiLink::select('id', 'api_name')->where('id', $request->instansi)->first();
            $keywords = $instansiPemerintah;
            $param = 'Instansi';
        }

        // Buat parameter query API secara dinamis
        $apiParams = array_filter([
            'judul' => $searchParams['keyword'] ?? null,
            'noPeraturan' => $searchParams['nomor'] ?? null,
            'tahun_pengundangan' => $searchParams['tahun'] ?? null,
            'jenis' => $typeHukum ? Str::upper($typeHukum->type_name) : null,
            'status' => $searchParams['status'] ?? null,
        ]);
        
        // Menggunakan model ApiQuery untuk mengambil data dari API
        $instansiId = $searchParams['instansi'] ?? null;
        $apiQuery = new ApiQuery();
        $apiResults = collect();
        $produkHukumItems = collect();
//        $apiResults = $apiQuery->fetchResults($apiParams, $instansiId);
//        dd($apiResults);
        
        if ($instansiId != 100) {
            $apiResults = $apiQuery->fetchResults($apiParams, $instansiId);
        }
        
        if ($instansiId == null || $instansiId == 100) {
            $query = ProdukHukumList::query();

            if (!empty($searchParams['keyword'])) {
                $query->where('judul_peraturan', 'like', "%" . $searchParams['keyword'] . "%");
            }
            if (!empty($searchParams['nomor'])) {
                $query->where('nmr_peraturan', 'like', "%" . $searchParams['nomor'] . "%");
            }
            if (!empty($searchParams['kategori'])) {
                $query->where('produk_hukum_categories_id', $searchParams['kategori']);
            }
            if (!empty($searchParams['tahun'])) {
                $query->whereYear('tgl_pengundangan', $searchParams['tahun']);
            }
            if (!empty($searchParams['bentuk'])) {
                $query->where('produk_hukum_types_id', $searchParams['bentuk']);
            }
            if (!empty($searchParams['status'])) {
                $query->where('status_akhir', $searchParams['status']);
            }

            $query->where('is_deleted', 0)
                  ->where('is_publish', 1)
                  ->orderByRaw('COALESCE(tgl_pengundangan, created_at) DESC');

            $produkHukumItems = $query->get();
        }

        // Kombinasi data API dengan data local/db
        $combinedResults = $produkHukumItems->concat($apiResults);

        // Paging hasil data API dengan data local/db
        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        $perPage = 10;
        $currentResults = $combinedResults->slice(($currentPage - 1) * $perPage, $perPage)->all();
        $paginatedResults = new LengthAwarePaginator($currentResults, $combinedResults->count(), $perPage);
        $paginatedResults->setPath($request->url());

        return view('pages.search_peraturan_result', compact('g_setting', 'param', 'menu', 'keywords', 'paginatedResults'));
    }
    
    private function isAllInputsEmpty(array $inputs)
    {
        return empty($inputs['keyword']) &&
               empty($inputs['nomor']) &&
               empty($inputs['kategori']) &&
               empty($inputs['instansi']) &&
               empty($inputs['tahun']) &&
               empty($inputs['bentuk']) &&
               empty($inputs['status']);
    }

    public function detail(Request $request)
    {
        $g_setting = DB::table('general_settings')->where('id', 1)->first();
        $menuslug = $request->input('menuslug', '');
        
        if($request->input('pagefrom') != 'terkait') {
            $id = decrypt($request->input('id'));
            $keyword = decrypt($request->input('keyword'));
            $nomor = decrypt($request->input('nomor'));
            $kategori = decrypt($request->input('kategori'));
            $instansi = decrypt($request->input('instansi'));
            $bentuk = decrypt($request->input('bentuk'));
            $tahun = decrypt($request->input('tahun'));
            $page = decrypt($request->input('page'));
            $routes = decrypt($request->input('routes'));
            $api_name = decrypt($request->input('api_name'));
        } else {
            $id = $request->input('id');
            $keyword = $request->input('keyword');
            $nomor = $request->input('nomor');
            $kategori = $request->input('kategori');
            $instansi = $request->input('instansi');
            $bentuk = $request->input('bentuk');
            $tahun = $request->input('tahun');
            $page = $request->input('page');
            $routes = $request->input('routes');
            $api_name = $request->input('api_name');
        }
        
        // Jika api_name ada, berarti data dari API, jika tidak ada, data dari database lokal
        if ($api_name !== 'Pemerintah Provinsi Banten') {
            $apiResult = $this->getApiDetail($id, $api_name);
            $produkHukumDetail = new \stdClass(); // Buat objek standar untuk menampung data API
            $produkHukumDetail->id = $apiResult['idData'];
            $produkHukumDetail->jenis = $apiResult['jenis'];
            $produkHukumDetail->judul_peraturan = $apiResult['judul'];
            $produkHukumDetail->no_panggil = $apiResult['noPanggil'];
            $produkHukumDetail->singkatan_jenis = $apiResult['singkatanJenis'];
            $produkHukumDetail->tempat_terbit = $apiResult['tempatTerbit'];
            $produkHukumDetail->penerbit = $apiResult['penerbit'];
            $produkHukumDetail->deskripsi_fisik = $apiResult['deskripsiFisik'];
            $produkHukumDetail->sumber = $apiResult['sumber'];
            $produkHukumDetail->subjek = $apiResult['subjek'];
            $produkHukumDetail->isbn = $apiResult['isbn'];
            $produkHukumDetail->bahasa = $apiResult['bahasa'];
            $produkHukumDetail->bidang_hukum = $apiResult['bidangHukum'];
            $produkHukumDetail->teu_badan = $apiResult['teuBadan'];
            $produkHukumDetail->nomor_induk_buku = $apiResult['nomorIndukBuku'];
            $produkHukumDetail->nomor = $apiResult['noPeraturan'];
            $produkHukumDetail->tahun_pengundangan = $apiResult['tahun_pengundangan'];
            $produkHukumDetail->tanggal_pengundangan = $apiResult['tanggal_pengundangan'];
            $produkHukumDetail->status_akhir = Str::upper($apiResult['status']);
            $produkHukumDetail->file_download = $apiResult['fileDownload'];
            $produkHukumDetail->url_download = $apiResult['urlDownload'];
            $produkHukumDetail->view = null; // Tentukan bagaimana menangani view count untuk data API
            $produkHukumDetail->created_at = null; // Tentukan bagaimana menangani created_at untuk data API
            
            return view('pages.search_peraturan_detail', compact('g_setting', 'produkHukumDetail', 'keyword', 'nomor', 'kategori', 'instansi', 'api_name', 'bentuk', 'tahun', 'page', 'routes', 'menuslug'));
        } else {
            $produkHukumDetail = ProdukHukumList::leftJoin('produk_hukum_urusan_pemerintahans', 'produk_hukum_lists.urusan', '=', 'produk_hukum_urusan_pemerintahans.id')
                                ->leftJoin('produk_hukum_bidang_hukums', 'produk_hukum_lists.bidang_hukum', '=', 'produk_hukum_bidang_hukums.id')
                                ->leftJoin('produk_hukum_categories_views', 'produk_hukum_lists.produk_hukum_categories_id', '=', 'produk_hukum_categories_views.produk_hukum_categories_id')
                                ->where('produk_hukum_lists.id', $id)
                                ->first(['produk_hukum_lists.*', 'produk_hukum_urusan_pemerintahans.up_name', 'produk_hukum_bidang_hukums.bh_name', 'produk_hukum_categories_views.page_view']);

            if (!$produkHukumDetail) {
                return abort(404);
            }

            $produkHukumDocument = ProdukHukumListDocument::join('produk_hukum_lists', 'produk_hukum_list_documents.peraturan_terkait', '=', 'produk_hukum_lists.id')
                                ->whereIn('produk_hukum_list_documents.produk_hukum_lists_id', [$produkHukumDetail->id])
                                ->get();
            
            $dokumenTerkait = ProdukHukumListDocTerkait::join('produk_hukum_lists', 'produk_hukum_list_doc_terkaits.produk_hukum_lists_id', '=', 'produk_hukum_lists.id')
                            ->whereIn('produk_hukum_list_doc_terkaits.produk_hukum_lists_id', [$produkHukumDetail->id])
                            ->get();
        
            $catatanStatus = ProdukHukumListCatatanStat::join('produk_hukum_lists', 'produk_hukum_list_catatan_stats.peraturan_catatan', '=', 'produk_hukum_lists.id')
                            ->select(['produk_hukum_list_catatan_stats.id AS id_catsts', 'produk_hukum_list_catatan_stats.produk_hukum_lists_id', 'produk_hukum_list_catatan_stats.peraturan_catatan', 'produk_hukum_list_catatan_stats.jenis_status', 'produk_hukum_lists.*'])
                            ->whereIn('produk_hukum_list_catatan_stats.produk_hukum_lists_id', [$produkHukumDetail->id])
                            ->get();

            // Update view count
            $produkHukumDetail->increment('view');
            
            return view('pages.search_peraturan_detail', compact('g_setting', 'produkHukumDetail', 'produkHukumDocument', 'keyword', 'nomor', 'kategori', 'instansi', 'api_name', 'bentuk', 'tahun', 'page', 'routes', 'menuslug', 'dokumenTerkait', 'catatanStatus'));
        }
    }
    
    private function getApiDetail($id, $api_name)
    {
        // Ambil URL API dari database berdasarkan api_name
        $apiLink = ApiLink::where('api_name', $api_name)->first();
        if ($apiLink && $apiLink->api_url) {
            $url = $apiLink->api_url;
            $response = Http::get($url);
            if ($response->successful()) {
                $results = $response->json();
                // Filter hasil berdasarkan idData
                $filtered = collect($results)->firstWhere('idData', $id);
                if ($filtered) {
                    return $filtered;
                }
            }
        }
        return abort(404, 'Data not found in API');
    }

    public function dokumen(Request $request, $slug)
    {
        $g_setting = DB::table('general_settings')->where('id', 1)->first();
        $menu = DB::table('menus')->where('slug', $slug)->first();

        if (!$request->hasAny(['keyword', 'tahun'])) {
            return redirect()->route('front.frontpage', ['slug' => $menu->slug]);
        } else {
            $keywords = $request->keyword ?? $request->tahun ?? '';

            $produkHukumItems = ProdukHukumList::when($request->keyword, function ($query, $keyword) {
                                        return $query->where('judul_peraturan', 'like', "%{$keyword}%");
                                    })
                                    ->when($request->tahun, function ($query, $tahun) {
                                        return $query->where('thn_peraturan', '=', "{$tahun}");
                                    }, function ($query) {
                                        return $query->orderByDesc('created_at');
                                    })
                                    ->where('is_deleted', 0)
                                    ->where('produk_hukum_categories_id', $menu->type_doc)
                                    ->paginate(10);

            $tahun = DB::table('produk_hukum_lists')
                        ->where('thn_peraturan', '!=', null)
                        ->where('produk_hukum_categories_id', $menu->type_doc)
                        ->groupBy('thn_peraturan')
                        ->pluck('thn_peraturan');

            return view('pages.search_dokumen_result', compact('g_setting', 'menu', 'keywords', 'tahun', 'produkHukumItems'));
        }
    }
}