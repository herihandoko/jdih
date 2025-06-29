<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;
use App\Models\Admin\ProdukHukumList;
use App\Models\Admin\ProdukHukumCategory;
use App\Models\Admin\ProdukHukumType;
use App\Models\Admin\ProdukHukumUrusanPemerintahan;
use App\Models\Admin\ProdukHukumBidangHukum;
use Spatie\Activitylog\Models\Activity;

class DashboardApiController extends Controller
{
    /**
     * Dashboard Overview - Statistik Umum
     */
    public function overview()
    {
        return Cache::remember('dashboard_overview', 3600, function () {
            $totalProdukHukum = ProdukHukumList::where('is_deleted', 0)->count();
            
            $peraturanId = ProdukHukumCategory::where('category_name', 'like', 'Peraturan%')->first();
            $totalPeraturan = $peraturanId ? ProdukHukumList::where('produk_hukum_categories_id', $peraturanId->id)
                ->where('is_deleted', 0)->count() : 0;
            
            $artikelId = ProdukHukumCategory::where('category_name', 'like', 'Artikel%')->first();
            $totalArtikel = $artikelId ? ProdukHukumList::where('produk_hukum_categories_id', $artikelId->id)
                ->where('is_deleted', 0)->count() : 0;
            
            $monografiId = ProdukHukumCategory::where('category_name', 'like', 'Monografi%')->first();
            $totalMonografi = $monografiId ? ProdukHukumList::where('produk_hukum_categories_id', $monografiId->id)
                ->where('is_deleted', 0)->count() : 0;
            
            $putusanId = ProdukHukumCategory::where('category_name', 'like', 'Putusan%')->first();
            $totalPutusan = $putusanId ? ProdukHukumList::where('produk_hukum_categories_id', $putusanId->id)
                ->where('is_deleted', 0)->count() : 0;
            
            $totalViews = ProdukHukumList::where('is_deleted', 0)->sum('view');
            
            $peraturanTahunIni = $peraturanId ? ProdukHukumList::where('produk_hukum_categories_id', $peraturanId->id)
                ->where('is_deleted', 0)
                ->whereYear('thn_peraturan', Carbon::now()->year)
                ->count() : 0;
            
            $peraturanBulanIni = $peraturanId ? ProdukHukumList::where('produk_hukum_categories_id', $peraturanId->id)
                ->where('is_deleted', 0)
                ->whereYear('thn_peraturan', Carbon::now()->year)
                ->whereMonth('thn_peraturan', Carbon::now()->month)
                ->count() : 0;

            return response()->json([
                'success' => true,
                'data' => [
                    'total_produk_hukum' => $totalProdukHukum,
                    'total_peraturan' => $totalPeraturan,
                    'total_artikel' => $totalArtikel,
                    'total_monografi' => $totalMonografi,
                    'total_putusan' => $totalPutusan,
                    'total_views' => $totalViews,
                    'peraturan_tahun_ini' => $peraturanTahunIni,
                    'peraturan_bulan_ini' => $peraturanBulanIni
                ]
            ]);
        });
    }

    /**
     * Statistik per Kategori
     */
    public function kategoriStats()
    {
        return Cache::remember('dashboard_kategori_stats', 3600, function () {
            $kategoriStats = ProdukHukumCategory::where('category_active', 1)
                ->withCount(['produkHukumLists' => function($query) {
                    $query->where('is_deleted', 0);
                }])
                ->get()
                ->map(function($kategori) {
                    $total = ProdukHukumList::where('is_deleted', 0)->count();
                    $persentase = $total > 0 ? round(($kategori->produk_hukum_lists_count / $total) * 100, 1) : 0;
                    
                    return [
                        'nama' => $kategori->category_name,
                        'total' => $kategori->produk_hukum_lists_count,
                        'persentase' => $persentase
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => [
                    'kategori' => $kategoriStats
                ]
            ]);
        });
    }

    /**
     * Trend Bulanan
     */
    public function trendBulanan(Request $request)
    {
        $year = $request->get('year', Carbon::now()->year);
        
        return Cache::remember("dashboard_trend_bulanan_{$year}", 3600, function () use ($year) {
            $trend = [];
            $months = [
                1 => 'Januari', 2 => 'Februari', 3 => 'Maret', 4 => 'April',
                5 => 'Mei', 6 => 'Juni', 7 => 'Juli', 8 => 'Agustus',
                9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Desember'
            ];

            foreach ($months as $month => $monthName) {
                $totalPeraturan = ProdukHukumList::where('is_deleted', 0)
                    ->whereYear('thn_peraturan', $year)
                    ->whereMonth('thn_peraturan', $month)
                    ->count();
                
                $totalViews = ProdukHukumList::where('is_deleted', 0)
                    ->whereYear('thn_peraturan', $year)
                    ->whereMonth('thn_peraturan', $month)
                    ->sum('view');

                $trend[] = [
                    'bulan' => $monthName,
                    'total_peraturan' => $totalPeraturan,
                    'total_views' => $totalViews
                ];
            }

            return response()->json([
                'success' => true,
                'data' => [
                    'tahun' => $year,
                    'trend' => $trend
                ]
            ]);
        });
    }

    /**
     * Perbandingan Tahun
     */
    public function perbandinganTahun(Request $request)
    {
        $tahun1 = $request->get('tahun1', Carbon::now()->subYear()->year);
        $tahun2 = $request->get('tahun2', Carbon::now()->year);
        
        return Cache::remember("dashboard_perbandingan_{$tahun1}_{$tahun2}", 3600, function () use ($tahun1, $tahun2) {
            $dataTahun1 = $this->getDataPerTahun($tahun1);
            $dataTahun2 = $this->getDataPerTahun($tahun2);
            
            $pertumbuhanPeraturan = $dataTahun1['total_peraturan'] > 0 
                ? round((($dataTahun2['total_peraturan'] - $dataTahun1['total_peraturan']) / $dataTahun1['total_peraturan']) * 100, 2)
                : 0;
            
            $pertumbuhanViews = $dataTahun1['total_views'] > 0 
                ? round((($dataTahun2['total_views'] - $dataTahun1['total_views']) / $dataTahun1['total_views']) * 100, 2)
                : 0;

            return response()->json([
                'success' => true,
                'data' => [
                    'perbandingan' => [
                        $tahun1 => $dataTahun1,
                        $tahun2 => $dataTahun2
                    ],
                    'pertumbuhan' => [
                        'peraturan' => $pertumbuhanPeraturan,
                        'views' => $pertumbuhanViews
                    ]
                ]
            ]);
        });
    }

    /**
     * Top Peraturan Terpopuler
     */
    public function topPeraturan(Request $request)
    {
        $limit = $request->get('limit', 10);
        $period = $request->get('period', 'month'); // month, year, all
        
        return Cache::remember("dashboard_top_peraturan_{$limit}_{$period}", 1800, function () use ($limit, $period) {
            $query = ProdukHukumList::with(['produk_hukum_categories', 'produk_hukum_types'])
                ->where('is_deleted', 0)
                ->where('is_publish', 1);

            if ($period === 'month') {
                $query->whereYear('created_at', Carbon::now()->year)
                      ->whereMonth('created_at', Carbon::now()->month);
            } elseif ($period === 'year') {
                $query->whereYear('created_at', Carbon::now()->year);
            }

            $topPeraturan = $query->orderBy('view', 'desc')
                ->limit($limit)
                ->get()
                ->map(function($item) {
                    return [
                        'id' => $item->id,
                        'judul' => $item->judul_peraturan,
                        'views' => $item->view,
                        'kategori' => $item->produk_hukum_categories->category_name ?? '',
                        'jenis' => $item->produk_hukum_types->type_name ?? '',
                        'tahun' => $item->thn_peraturan,
                        'status_akhir' => $item->status_akhir
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => [
                    'top_peraturan' => $topPeraturan,
                    'period' => $period,
                    'limit' => $limit
                ]
            ]);
        });
    }

    /**
     * Statistik per Jenis Peraturan
     */
    public function jenisPeraturan()
    {
        return Cache::remember('dashboard_jenis_peraturan', 3600, function () {
            $jenisPeraturan = ProdukHukumType::where('type_active', 1)
                ->withCount(['produkHukumLists' => function($query) {
                    $query->where('is_deleted', 0);
                }])
                ->get()
                ->map(function($jenis) {
                    $total = ProdukHukumList::where('is_deleted', 0)->count();
                    $persentase = $total > 0 ? round(($jenis->produk_hukum_lists_count / $total) * 100, 1) : 0;
                    
                    return [
                        'nama' => $jenis->type_name,
                        'total' => $jenis->produk_hukum_lists_count,
                        'persentase' => $persentase
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => [
                    'jenis_peraturan' => $jenisPeraturan
                ]
            ]);
        });
    }

    /**
     * Status Publikasi
     */
    public function statusPublikasi()
    {
        return Cache::remember('dashboard_status_publikasi', 1800, function () {
            $published = ProdukHukumList::where('is_deleted', 0)->where('is_publish', 1)->count();
            $draft = ProdukHukumList::where('is_deleted', 0)->where('is_publish', 0)->count();
            $total = $published + $draft;
            
            $persentasePublished = $total > 0 ? round(($published / $total) * 100, 1) : 0;

            return response()->json([
                'success' => true,
                'data' => [
                    'status' => [
                        'published' => $published,
                        'draft' => $draft,
                        'total' => $total
                    ],
                    'persentase_published' => $persentasePublished
                ]
            ]);
        });
    }

    /**
     * Konten per Instansi
     */
    public function kontenInstansi()
    {
        return Cache::remember('dashboard_konten_instansi', 3600, function () {
            $kontenInstansi = ProdukHukumList::where('is_deleted', 0)
                ->select('instansi', 
                    DB::raw('COUNT(*) as total_peraturan'),
                    DB::raw('COUNT(CASE WHEN produk_hukum_categories_id = (SELECT id FROM produk_hukum_categories WHERE category_name LIKE "Artikel%") THEN 1 END) as total_artikel')
                )
                ->groupBy('instansi')
                ->orderBy('total_peraturan', 'desc')
                ->get()
                ->map(function($item) {
                    return [
                        'nama' => $item->instansi ?: 'Tidak Diketahui',
                        'total_peraturan' => $item->total_peraturan,
                        'total_artikel' => $item->total_artikel
                    ];
                });

            return response()->json([
                'success' => true,
                'data' => [
                    'instansi' => $kontenInstansi
                ]
            ]);
        });
    }

    /**
     * Pencarian Lanjutan
     */
    public function search(Request $request)
    {
        $keyword = $request->get('keyword', '');
        $kategori = $request->get('kategori', '');
        $tahun = $request->get('tahun', '');
        $status = $request->get('status', '');
        $limit = $request->get('limit', 20);

        $query = ProdukHukumList::with(['produk_hukum_categories', 'produk_hukum_types'])
            ->where('is_deleted', 0);

        if ($keyword) {
            $query->where('judul_peraturan', 'like', '%' . $keyword . '%');
        }

        if ($kategori) {
            $kategoriId = ProdukHukumCategory::where('category_name', 'like', '%' . $kategori . '%')->first();
            if ($kategoriId) {
                $query->where('produk_hukum_categories_id', $kategoriId->id);
            }
        }

        if ($tahun) {
            $query->where('thn_peraturan', $tahun);
        }

        if ($status) {
            if ($status === 'published') {
                $query->where('is_publish', 1);
            } elseif ($status === 'draft') {
                $query->where('is_publish', 0);
            }
        }

        $totalResults = $query->count();
        $results = $query->orderBy('view', 'desc')
            ->limit($limit)
            ->get()
            ->map(function($item) {
                return [
                    'id' => $item->id,
                    'judul' => $item->judul_peraturan,
                    'kategori' => $item->produk_hukum_categories->category_name ?? '',
                    'jenis' => $item->produk_hukum_types->type_name ?? '',
                    'tahun' => $item->thn_peraturan,
                    'status' => $item->is_publish ? 'published' : 'draft',
                    'views' => $item->view,
                    'instansi' => $item->instansi,
                    'tgl_pengundangan' => $item->tgl_pengundangan
                ];
            });

        return response()->json([
            'success' => true,
            'data' => [
                'total_results' => $totalResults,
                'results' => $results,
                'filters' => [
                    'keyword' => $keyword,
                    'kategori' => $kategori,
                    'tahun' => $tahun,
                    'status' => $status
                ]
            ]
        ]);
    }

    /**
     * Activity Logs
     */
    public function activityLogs(Request $request)
    {
        $period = $request->get('period', 'week');
        $action = $request->get('action', '');
        $limit = $request->get('limit', 50);

        $query = Activity::with('causer')
            ->where('log_name', 'Produk Hukum');

        if ($action) {
            $query->where('description', 'like', '%' . $action . '%');
        }

        if ($period === 'week') {
            $query->where('created_at', '>=', Carbon::now()->subWeek());
        } elseif ($period === 'month') {
            $query->where('created_at', '>=', Carbon::now()->subMonth());
        } elseif ($period === 'year') {
            $query->where('created_at', '>=', Carbon::now()->subYear());
        }

        $activities = $query->orderBy('created_at', 'desc')
            ->limit($limit)
            ->get()
            ->map(function($activity) {
                $eventType = 'unknown';
                if (strpos($activity->description, 'created') !== false) {
                    $eventType = 'created';
                } elseif (strpos($activity->description, 'updated') !== false) {
                    $eventType = 'updated';
                } elseif (strpos($activity->description, 'deleted') !== false) {
                    $eventType = 'deleted';
                }

                return [
                    'user' => $activity->causer->name ?? 'System',
                    'action' => $eventType,
                    'description' => $activity->description,
                    'timestamp' => $activity->created_at->format('Y-m-d H:i:s'),
                    'properties' => $activity->properties,
                    'subject_type' => $activity->subject_type,
                    'subject_id' => $activity->subject_id
                ];
            });

        return response()->json([
            'success' => true,
            'data' => [
                'activities' => $activities,
                'period' => $period,
                'action' => $action
            ]
        ]);
    }

    /**
     * File Upload Stats
     */
    public function fileStats()
    {
        return Cache::remember('dashboard_file_stats', 3600, function () {
            $totalFiles = ProdukHukumList::where('is_deleted', 0)
                ->whereNotNull('file_peraturan')
                ->count();

            $fileTypes = ProdukHukumList::where('is_deleted', 0)
                ->whereNotNull('file_peraturan')
                ->selectRaw('SUBSTRING_INDEX(file_peraturan, ".", -1) as extension, COUNT(*) as count')
                ->groupBy(DB::raw('SUBSTRING_INDEX(file_peraturan, ".", -1)'))
                ->get()
                ->pluck('count', 'extension')
                ->toArray();

            $audioFiles = ProdukHukumList::where('is_deleted', 0)
                ->whereNotNull('mp3_path')
                ->count();

            $fileTypes['mp3'] = $audioFiles;

            return response()->json([
                'success' => true,
                'data' => [
                    'file_stats' => [
                        'total_files' => $totalFiles + $audioFiles,
                        'file_types' => $fileTypes
                    ]
                ]
            ]);
        });
    }

    /**
     * Quick Stats untuk Mobile
     */
    public function quickStats()
    {
        return Cache::remember('dashboard_quick_stats', 900, function () {
            $peraturanId = ProdukHukumCategory::where('category_name', 'like', 'Peraturan%')->first();
            
            $peraturanBaruBulanIni = $peraturanId ? ProdukHukumList::where('produk_hukum_categories_id', $peraturanId->id)
                ->where('is_deleted', 0)
                ->whereYear('created_at', Carbon::now()->year)
                ->whereMonth('created_at', Carbon::now()->month)
                ->count() : 0;

            $totalViewsHariIni = ProdukHukumList::where('is_deleted', 0)
                ->whereDate('updated_at', Carbon::today())
                ->sum('view');

            $pendingApproval = ProdukHukumList::where('is_deleted', 0)
                ->where('is_publish', 0)
                ->count();

            $totalPeraturan = $peraturanId ? ProdukHukumList::where('produk_hukum_categories_id', $peraturanId->id)
                ->where('is_deleted', 0)->count() : 0;

            return response()->json([
                'success' => true,
                'data' => [
                    'quick_stats' => [
                        'total_peraturan' => $totalPeraturan,
                        'peraturan_baru_bulan_ini' => $peraturanBaruBulanIni,
                        'total_views_hari_ini' => $totalViewsHariIni,
                        'pending_approval' => $pendingApproval
                    ]
                ]
            ]);
        });
    }

    /**
     * Helper method untuk mendapatkan data per tahun
     */
    private function getDataPerTahun($year)
    {
        $totalPeraturan = ProdukHukumList::where('is_deleted', 0)
            ->whereYear('thn_peraturan', $year)
            ->count();
        
        $totalViews = ProdukHukumList::where('is_deleted', 0)
            ->whereYear('thn_peraturan', $year)
            ->sum('view');

        return [
            'total_peraturan' => $totalPeraturan,
            'total_views' => $totalViews
        ];
    }
} 