<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Models\Admin\ProdukHukumList;
use App\Models\Admin\Admin;
use App\Models\Admin\ProdukHukumListPembahasanDate;
use App\Models\Admin\ProdukHukumListDocument;
use App\Models\Admin\ProdukHukumListDocTerkait;
use App\Models\Admin\ProdukHukumListCatatanStat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use DB;

class ProdukHukumListController extends Controller {

    public $successStatus = 200;

    public function __construct() {
        $this->middleware('admin');
    }

    public function index(Request $request) {
        $request->session()->forget('registerJenisDok');
        if (session('comp_code') == null) {
            $compcode = '';
            $produkHukumList = ProdukHukumList::leftJoin('companies', 'produk_hukum_lists.comp_code', '=', 'companies.comp_code')
                    ->join('admins', 'produk_hukum_lists.created_by', '=', 'admins.id')
                    ->where('produk_hukum_lists.is_deleted', 0)
                    ->orderBy('produk_hukum_lists.created_at', 'desc')
                    ->get(['produk_hukum_lists.*', 'companies.comp_name', 'admins.name']);

            return view('admin.produk_hukum.listdata.index', compact('produkHukumList', 'compcode'));
        } else {
            $compcode = session('comp_code');
            $produkHukumList = ProdukHukumList::where('produk_hukum_lists.comp_code', session('comp_code'))
                    ->join('admins', 'produk_hukum_lists.created_by', '=', 'admins.id')
                    ->where('produk_hukum_lists.is_deleted', 0)
                    ->orderBy('produk_hukum_lists.created_at', 'desc')
                    ->get(['produk_hukum_lists.*', 'admins.name']);

            return view('admin.produk_hukum.listdata.index', compact('produkHukumList', 'compcode'));
        }
    }

    public function jenisdokumen(Request $request) {
        $registerJenisDok = $request->session()->get('registerJenisDok');
        $produkHukumCategory = DB::table('produk_hukum_categories')->where('category_active', 1)->orderBy('category_name', 'asc')->get();
        return view('admin.produk_hukum.listdata.jenisdokumen', compact('produkHukumCategory', 'registerJenisDok'));
    }

    public function postjenisdokumen(Request $request) {
        $request->validate([
            'produk_hukum_categories_id' => 'required',
        ]);

        $request->session()->put('registerJenisDok', $request->produk_hukum_categories_id);
        $registerJenisDok = $request->session()->get('registerJenisDok');

        return redirect('admin/produk-hukum/list-data/create');
    }

    public function create(Request $request) {
        $registerJenisDok = $request->session()->get('registerJenisDok');
        $produkJudulPeraturan = DB::table('produk_hukum_lists')
                                    ->select('id', 'judul_peraturan')
                                    ->where('produk_hukum_categories_id', $registerJenisDok)
                                    ->where('is_deleted', 0)
                                    ->orderBy('judul_peraturan', 'asc')
                                    ->get();
        
        $produkHukumType = DB::table('produk_hukum_types')->where('type_active', 1)->orderBy('type_name', 'asc')->get();
        $produkHukumLanguage = DB::table('produk_hukum_languages')->where('language_active', 1)->orderBy('language_name', 'asc')->get();
        $produkHukumUrusanPemerintahan = DB::table('produk_hukum_urusan_pemerintahans')->where('up_active', 1)->orderBy('up_code', 'asc')->get();
        $produkHukumBidangHukum = DB::table('produk_hukum_bidang_hukums')->where('bh_active', 1)->orderBy('bh_code', 'asc')->get();
        $produkHukumCategoryName = DB::table('produk_hukum_categories')->where('id', $registerJenisDok)->first();
        
        return view('admin.produk_hukum.listdata.create', compact('produkJudulPeraturan', 'produkHukumType', 'produkHukumCategoryName', 'registerJenisDok', 'produkHukumUrusanPemerintahan', 'produkHukumBidangHukum', 'produkHukumLanguage'));
    }
    
    public function select(Request $request)
    {
        
        $registerJenisDok = $request->session()->get('registerJenisDok');
        
        $produkHukumLists = ProdukHukumList::where('judul_peraturan', 'like', '%'.$request->search.'%');
        
        if($registerJenisDok != null) $produkHukumLists->where('produk_hukum_categories_id', $registerJenisDok);
        
        if($registerJenisDok == null) $produkHukumLists->where('produk_hukum_categories_id', $request->catId);
        
        $rows = $produkHukumLists->where('is_deleted', 0)
                ->orderBy('judul_peraturan', 'asc')
                ->paginate();

        return response()->json($rows, 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_peraturan' => 'required|unique:produk_hukum_lists',
            'slug' => 'unique:produk_hukum_lists'
                ],
                [
                    'judul_peraturan.required' => 'Judul Peraturan harus diisi.',
                    'judul_peraturan.unique' => 'Judul Peraturan sudah ada. Silakan input Judul Peraturan lainnya.'
        ]);

        $slug = Str::slug($request->judul_peraturan, '-');

        $produkHukumList = new ProdukHukumList();

        $produkHukumList->slug = $slug;
        $produkHukumList->produk_hukum_types_id = $request->produk_hukum_types_id;
        $produkHukumList->produk_hukum_categories_id = $request->produk_hukum_categories_id;
        $produkHukumList->judul_peraturan = $request->judul_peraturan;
        $produkHukumList->bahasa = $request->bahasa;
        $produkHukumList->nmr_peraturan = $request->nmr_peraturan;
        
        if (!empty($request->thn_peraturan) || $request->thn_peraturan != null) {
            $produkHukumList->thn_peraturan = Carbon::createFromFormat('Y', $request->thn_peraturan)->format('Y');
        }
        
        $produkHukumList->singkatan_peraturan = $request->singkatan_peraturan;
        $produkHukumList->instansi = $request->instansi;
        $produkHukumList->tempat_penetapan = $request->tempat_penetapan;
        $produkHukumList->sumber = $request->sumber;
        $produkHukumList->subjek = $request->subjek;
        $produkHukumList->urusan = $request->urusan;
        $produkHukumList->bidang_hukum = $request->bidang_hukum;
        $produkHukumList->teu_badan = $request->teu_badan;
        $produkHukumList->pemrakarsa = $request->pemrakarsa;
        $produkHukumList->hasil_uji = $request->hasil_uji;
        $produkHukumList->status_akhir = $request->status_akhir;
        $produkHukumList->catatan_status = $request->catatan_status;
        
        if (!empty($request->amar) || $request->amar != null) {
            $produkHukumList->amar = $request->amar;
        }
        
        if (!empty($request->cetakan) || $request->cetakan != null) {
            $produkHukumList->cetakan = $request->cetakan;
        }
        
        if (!empty($request->deskripsi_fisik) || $request->deskripsi_fisik != null) {
            $produkHukumList->deskripsi_fisik = $request->deskripsi_fisik;
        }
        
        if (!empty($request->isbn) || $request->isbn != null) {
            $produkHukumList->isbn = $request->isbn;
        }
        
        if (!empty($request->nmr_indukbuku) || $request->nmr_indukbuku != null) {
            $produkHukumList->nmr_indukbuku = $request->nmr_indukbuku;
        }
        
        if (!empty($request->lokasi) || $request->lokasi != null) {
            $produkHukumList->lokasi = $request->lokasi;
        }
        
        if (!empty($request->is_publish) || $request->is_publish != null) {
            $produkHukumList->is_publish = $request->is_publish;
        }

        if (!empty($request->tgl_pengajuan) || $request->tgl_pengajuan != null) {
            $produkHukumList->tgl_pengajuan = Carbon::createFromFormat('d-m-Y', $request->tgl_pengajuan)->format('Y-m-d');
        }

        if (!empty($request->tgl_penetapan) || $request->tgl_penetapan != null) {
            $produkHukumList->tgl_penetapan = Carbon::createFromFormat('d-m-Y', $request->tgl_penetapan)->format('Y-m-d');
        }

        if (!empty($request->tgl_pengundangan) || $request->tgl_pengundangan != null) {
            $produkHukumList->tgl_pengundangan = Carbon::createFromFormat('d-m-Y', $request->tgl_pengundangan)->format('Y-m-d');
        }

        $produkHukumList->created_by = session('id');
        $produkHukumList->comp_code = session('comp_code');

        if ($request->hasFile('file_peraturan')) {
            $request->validate([
                'file_peraturan' => 'required|mimes:pdf,zip|max:256000'
                    ],
                    [
                        'file_peraturan.mimes' => 'Jenis/Ukuran File Peraturan tidak diijinkan'
            ]);

            $name_pdffile = $request->file('file_peraturan')->getClientOriginalName();
            $filename_pdf = pathinfo($name_pdffile, PATHINFO_FILENAME);
            $extension_file = $request->file('file_peraturan')->extension();
            $final_name_pdffile = $filename_pdf . '_' . time() . '.' . $extension_file;
            Storage::putFileAs('public/places/peraturan', $request->file('file_peraturan'), $final_name_pdffile);
//            $request->file('file_peraturan')->move(public_path('uploads/peraturan/'), $final_name_pdffile);

            $produkHukumList->file_peraturan = $final_name_pdffile;
        }

        if ($request->hasFile('abstrak')) {
            $request->validate([
                'abstrak' => 'required|mimes:pdf,zip|max:256000'
                    ],
                    [
                        'abstrak' => 'Jenis/Ukuran File Abstrak tidak diijinkan'
            ]);

            $abstrak_pdffile = $request->file('abstrak')->getClientOriginalName();
            $fileabstrakname_pdf = pathinfo($abstrak_pdffile, PATHINFO_FILENAME);
            $extension_abstrak_file = $request->file('abstrak')->extension();
            $final_abstrakname_pdffile = $fileabstrakname_pdf . '_' . time() . '.' . $extension_abstrak_file;
            Storage::putFileAs('public/places/peraturan', $request->file('abstrak'), $final_abstrakname_pdffile);
//            $request->file('abstrak')->move(public_path('uploads/peraturan/'), $final_abstrakname_pdffile);

            $produkHukumList->abstrak = $final_abstrakname_pdffile;
        }

        $produkHukumList->save();

        if ($produkHukumList->id != 0) {
            if (!empty($request->tgl_pembahasan)) {
                $tglPembahasanArr = explode(",", $request->tgl_pembahasan);
                foreach ($tglPembahasanArr as $key => $value) {
                    $produkHukumListPembahasanDate = new ProdukHukumListPembahasanDate();

                    $produkHukumListPembahasanDate->produk_hukum_lists_id = $produkHukumList->id;
                    $produkHukumListPembahasanDate->tgl_pembahasan = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
                    $produkHukumListPembahasanDate->created_by = session('id');

                    $produkHukumListPembahasanDate->save();
                }
            }
            
            if (!empty($request->peraturan_diubah)) {
                $countPeraturanDiubah = count($request->peraturan_diubah);
                for ($i = 0; $i < $countPeraturanDiubah; $i++) {
                    $peraturanDiubah = new ProdukHukumListCatatanStat();

                    $peraturanDiubah->produk_hukum_lists_id = $produkHukumList->id;
                    $peraturanDiubah->peraturan_catatan = $request->peraturan_diubah[$i];
                    $peraturanDiubah->jenis_status = $request->chkDiubah;
                    $peraturanDiubah->created_by = session('id');

                    $peraturanDiubah->save();
                }
            }
            
            if (!empty($request->peraturan_mengubah)) {
                $countPeraturanMengubah = count($request->peraturan_mengubah);
                for ($i = 0; $i < $countPeraturanMengubah; $i++) {
                    $peraturanMengubah = new ProdukHukumListCatatanStat();

                    $peraturanMengubah->produk_hukum_lists_id = $produkHukumList->id;
                    $peraturanMengubah->peraturan_catatan = $request->peraturan_mengubah[$i];
                    $peraturanMengubah->jenis_status = $request->chkMengubah;
                    $peraturanMengubah->created_by = session('id');

                    $peraturanMengubah->save();
                }
            }
            
            if (!empty($request->peraturan_dicabut)) {
                $countPeraturanDicabut = count($request->peraturan_dicabut);
                for ($i = 0; $i < $countPeraturanDicabut; $i++) {
                    $peraturanDicabut = new ProdukHukumListCatatanStat();

                    $peraturanDicabut->produk_hukum_lists_id = $produkHukumList->id;
                    $peraturanDicabut->peraturan_catatan = $request->peraturan_dicabut[$i];
                    $peraturanDicabut->jenis_status = $request->chkDicabut;
                    $peraturanDicabut->created_by = session('id');

                    $peraturanDicabut->save();
                }
            }
            
            if (!empty($request->peraturan_mencabut)) {
                $countPeraturanMencabut = count($request->peraturan_mencabut);
                for ($i = 0; $i < $countPeraturanMencabut; $i++) {
                    $peraturanMencabut = new ProdukHukumListCatatanStat();

                    $peraturanMencabut->produk_hukum_lists_id = $produkHukumList->id;
                    $peraturanMencabut->peraturan_catatan = $request->peraturan_mencabut[$i];
                    $peraturanMencabut->jenis_status = $request->chkMencabut;
                    $peraturanMencabut->created_by = session('id');

                    $peraturanMencabut->save();
                }
            }

            if (!empty($request->peraturan_terkait)) {
                $countPeraturanTerkait = count($request->peraturan_terkait);
                for ($i = 0; $i < $countPeraturanTerkait; $i++) {
                    $produkHukumListDocument = new ProdukHukumListDocument();

                    $produkHukumListDocument->produk_hukum_lists_id = $produkHukumList->id;
                    $produkHukumListDocument->peraturan_terkait = $request->peraturan_terkait[$i];
                    $produkHukumListDocument->created_by = session('id');

                    $produkHukumListDocument->save();
                }
            }
            
            if ($request->hasFile('file_doc_terkait')) {
                $request->validate([
                    'file_doc_terkait.*' => 'required|mimes:pdf|max:256000'
                ],
                [
                    'file_doc_terkait.mimes' => 'Jenis/Ukuran File Dokumen Terkait tidak diijinkan'
                ]);
                
                foreach ($request->file_doc_terkait as $key => $value) {
                    $produkHukumListDocTerkait = new ProdukHukumListDocTerkait();

                    $name_file = $value->getClientOriginalName();
                    $filename_img = pathinfo($name_file, PATHINFO_FILENAME);
                    $extension_file = $value->extension();
                    $final_name_file = $filename_img.'_'.time().'.'.$extension_file;
                    Storage::putFileAs('public/places/peraturan', $value, $final_name_file);

                    $produkHukumListDocTerkait->dokumen_terkait = $final_name_file;
                    $produkHukumListDocTerkait->produk_hukum_lists_id = $produkHukumList->id;
                    $produkHukumListDocTerkait->created_by = session('id');
                    $produkHukumListDocTerkait->save();
                }
            }

            return redirect()->route('admin.produk_hukum.listdata.index')->with('success', 'Produk Hukum is added successfully!');
        } else {
            return redirect()->route('admin.produk_hukum.listdata.index')->with('success', 'Produk Hukum is added successfully!');
        }
    }

    public function edit($id) {
        $produkID = Crypt::decrypt($id);
        $produkHukumList = ProdukHukumList::findOrFail($produkID);
        
        $produkHukumCategoryName = DB::table('produk_hukum_categories')
                                    ->where('id', $produkHukumList->produk_hukum_categories_id)
                                    ->first();
        
        $produkJudulPeraturan = DB::table('produk_hukum_lists')
                                    ->where('id', '!=', $produkHukumList->id)
                                    ->where('produk_hukum_categories_id', '=', $produkHukumCategoryName->id)
                                    ->where('is_deleted', 0)
                                    ->orderBy('judul_peraturan', 'asc')
                                    ->get();
        
        $produkHukumType = DB::table('produk_hukum_types')->get();
        $produkHukumLanguage = DB::table('produk_hukum_languages')->where('language_active', 1)->orderBy('language_name', 'asc')->get();
        $produkHukumUrusanPemerintahan = DB::table('produk_hukum_urusan_pemerintahans')->where('up_active', 1)->orderBy('up_code', 'asc')->get();
        $produkHukumBidangHukum = DB::table('produk_hukum_bidang_hukums')->where('bh_active', 1)->orderBy('bh_code', 'asc')->get();
        $produkHukumCategory = DB::table('produk_hukum_categories')->get();
        $produkPeraturanTerkait = DB::table('produk_hukum_list_documents')->where('produk_hukum_lists_id', $produkHukumList->id)->get();
        $produkDokumenTerkait = DB::table('produk_hukum_list_doc_terkaits')->where('produk_hukum_lists_id', $produkHukumList->id)->get();
        $catatanStatus = DB::table('produk_hukum_list_catatan_stats')->where('produk_hukum_lists_id', $produkHukumList->id)->get();
        
        return view('admin.produk_hukum.listdata.edit', compact('produkJudulPeraturan', 'produkHukumList', 'produkHukumCategoryName', 'produkHukumType', 'produkHukumCategory', 'produkPeraturanTerkait', 'produkDokumenTerkait', 'produkHukumUrusanPemerintahan', 'produkHukumBidangHukum', 'catatanStatus', 'produkHukumLanguage'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_peraturan' => [
                'required',
                Rule::unique('produk_hukum_lists')->ignore($id),
            ]
                ],
                [
                    'judul_peraturan.required' => 'Judul Peraturan harus diisi.',
                    'judul_peraturan.unique' => 'Judul Peraturan sudah ada. Silakan input Judul Peraturan lainnya.'
        ]);
        
        $produkHukumList = ProdukHukumList::findOrFail($id);

        $slug = Str::slug($request->judul_peraturan, '-');
        $produkHukumList->slug = $slug;
        
        $produkHukumList->produk_hukum_types_id = $request->produk_hukum_types_id;
        $produkHukumList->judul_peraturan = $request->judul_peraturan;
        $produkHukumList->bahasa = $request->bahasa;
        $produkHukumList->nmr_peraturan = $request->nmr_peraturan;
        
        if (!empty($request->thn_peraturan) || $request->thn_peraturan != null) {
            $produkHukumList->thn_peraturan = Carbon::createFromFormat('Y', $request->thn_peraturan)->format('Y');
        }
        
        $produkHukumList->singkatan_peraturan = $request->singkatan_peraturan;
        $produkHukumList->instansi = $request->instansi;
        $produkHukumList->tempat_penetapan = $request->tempat_penetapan;
        $produkHukumList->sumber = $request->sumber;
        $produkHukumList->subjek = $request->subjek;
        $produkHukumList->urusan = $request->urusan;
        $produkHukumList->bidang_hukum = $request->bidang_hukum;
        $produkHukumList->teu_badan = $request->teu_badan;
        $produkHukumList->pemrakarsa = $request->pemrakarsa;
        $produkHukumList->hasil_uji = $request->hasil_uji;
        $produkHukumList->status_akhir = $request->status_akhir;
        $produkHukumList->catatan_status = $request->catatan_status;
        
        if (!empty($request->amar) || $request->amar != null) {
            $produkHukumList->amar = $request->amar;
        }
        
        if (!empty($request->cetakan) || $request->cetakan != null) {
            $produkHukumList->cetakan = $request->cetakan;
        }
        
        if (!empty($request->deskripsi_fisik) || $request->deskripsi_fisik != null) {
            $produkHukumList->deskripsi_fisik = $request->deskripsi_fisik;
        }
        
        if (!empty($request->isbn) || $request->isbn != null) {
            $produkHukumList->isbn = $request->isbn;
        }
        
        if (!empty($request->nmr_indukbuku) || $request->nmr_indukbuku != null) {
            $produkHukumList->nmr_indukbuku = $request->nmr_indukbuku;
        }
        
        if (!empty($request->lokasi) || $request->lokasi != null) {
            $produkHukumList->lokasi = $request->lokasi;
        }
        
        if (!empty($request->is_publish) || $request->is_publish != null) {
            $produkHukumList->is_publish = $request->is_publish;
        }

        if (!empty($request->tgl_pengajuan) || $request->tgl_pengajuan != null) {
            $produkHukumList->tgl_pengajuan = Carbon::createFromFormat('d-m-Y', $request->tgl_pengajuan)->format('Y-m-d');
        }

        if (!empty($request->tgl_penetapan) || $request->tgl_penetapan != null) {
            $produkHukumList->tgl_penetapan = Carbon::createFromFormat('d-m-Y', $request->tgl_penetapan)->format('Y-m-d');
        }

        if (!empty($request->tgl_pengundangan) || $request->tgl_pengundangan != null) {
            $produkHukumList->tgl_pengundangan = Carbon::createFromFormat('d-m-Y', $request->tgl_pengundangan)->format('Y-m-d');
        }

        $produkHukumList->updated_by = session('id');

        if ($request->hasFile('file_peraturan')) {
            $request->validate([
                'file_peraturan' => 'required|mimes:pdf,zip|max:256000'
                    ],
                    [
                        'file_peraturan.mimes' => 'Jenis/Ukuran File Peraturan tidak diijinkan'
            ]);

            $name_pdffile = $request->file('file_peraturan')->getClientOriginalName();
            $filename_pdf = pathinfo($name_pdffile, PATHINFO_FILENAME);
            $extension_file = $request->file('file_peraturan')->extension();
            $final_name_pdffile = $filename_pdf . '_' . time() . '.' . $extension_file;
            Storage::putFileAs('public/places/peraturan', $request->file('file_peraturan'), $final_name_pdffile);
//            $request->file('file_peraturan')->move(public_path('uploads/peraturan/'), $final_name_pdffile);

            $produkHukumList->file_peraturan = $final_name_pdffile;
        }

        if ($request->hasFile('abstrak')) {
            $request->validate([
                'abstrak' => 'required|mimes:pdf,zip|max:256000'
                    ],
                    [
                        'abstrak.mimes' => 'Jenis/Ukuran File Abstrak tidak diijinkan'
            ]);

            $abstrak_pdffile = $request->file('abstrak')->getClientOriginalName();
            $fileabstrakname_pdf = pathinfo($abstrak_pdffile, PATHINFO_FILENAME);
            $extension_abstrak_file = $request->file('abstrak')->extension();
            $final_abstrakname_pdffile = $fileabstrakname_pdf . '_' . time() . '.' . $extension_abstrak_file;
            Storage::putFileAs('public/places/peraturan', $request->file('abstrak'), $final_abstrakname_pdffile);
//            $request->file('abstrak')->move(public_path('uploads/peraturan/'), $final_abstrakname_pdffile);

            $produkHukumList->abstrak = $final_abstrakname_pdffile;
        }
        
        $produkHukumList->save();

        if ($produkHukumList->id != 0) {
            if (!empty($request->tgl_pembahasan)) {
                $tglPembahasanArr = explode(",", $request->tgl_pembahasan);
                foreach ($tglPembahasanArr as $key => $value) {
                    $produkHukumListPembahasanDate = new ProdukHukumListPembahasanDate();
//                    $data = $request->only($produkHukumListPembahasanDate->getFillable());

                    $produkHukumListPembahasanDate->produk_hukum_lists_id = $produkHukumList->id;
                    $produkHukumListPembahasanDate->tgl_pembahasan = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
                    $produkHukumListPembahasanDate->updated_by = session('id');

                    $produkHukumListPembahasanDate->save();
                }
            }
            
            $existingDiubah = $request->input('existing_diubah', []);
            ProdukHukumListCatatanStat::where('produk_hukum_lists_id', $produkHukumList->id)->where('jenis_status', 'diubah')->whereNotIn('peraturan_catatan', $existingDiubah)->delete();
            if (!empty($request->peraturan_diubah)) {
                $countPeraturanDiubah = count($request->peraturan_diubah);
                for ($i = 0; $i < $countPeraturanDiubah; $i++) {
                    $peraturanDiubah = new ProdukHukumListCatatanStat();

                    $peraturanDiubah->produk_hukum_lists_id = $produkHukumList->id;
                    $peraturanDiubah->peraturan_catatan = $request->peraturan_diubah[$i];
                    $peraturanDiubah->jenis_status = $request->chkDiubah;
                    $peraturanDiubah->updated_by = session('id');

                    $peraturanDiubah->save();
                }
            }
            
            $existingMengubah = $request->input('existing_mengubah', []);
            ProdukHukumListCatatanStat::where('produk_hukum_lists_id', $produkHukumList->id)->where('jenis_status', 'mengubah')->whereNotIn('peraturan_catatan', $existingMengubah)->delete();
            if (!empty($request->peraturan_mengubah)) {
                $countPeraturanMengubah = count($request->peraturan_mengubah);
                for ($i = 0; $i < $countPeraturanMengubah; $i++) {
                    $peraturanMengubah = new ProdukHukumListCatatanStat();

                    $peraturanMengubah->produk_hukum_lists_id = $produkHukumList->id;
                    $peraturanMengubah->peraturan_catatan = $request->peraturan_mengubah[$i];
                    $peraturanMengubah->jenis_status = $request->chkMengubah;
                    $peraturanMengubah->updated_by = session('id');

                    $peraturanMengubah->save();
                }
            }
            
            $existingDicabut = $request->input('existing_dicabut', []);
            ProdukHukumListCatatanStat::where('produk_hukum_lists_id', $produkHukumList->id)->where('jenis_status', 'disabut')->whereNotIn('peraturan_catatan', $existingDicabut)->delete();
            if (!empty($request->peraturan_dicabut)) {
                $countPeraturanDicabut = count($request->peraturan_dicabut);
                for ($i = 0; $i < $countPeraturanDicabut; $i++) {
                    $peraturanDicabut = new ProdukHukumListCatatanStat();

                    $peraturanDicabut->produk_hukum_lists_id = $produkHukumList->id;
                    $peraturanDicabut->peraturan_catatan = $request->peraturan_dicabut[$i];
                    $peraturanDicabut->jenis_status = $request->chkDicabut;
                    $peraturanDicabut->updated_by = session('id');

                    $peraturanDicabut->save();
                }
            }
            
            $existingMencabut = $request->input('existing_mencabut', []);
            ProdukHukumListCatatanStat::where('produk_hukum_lists_id', $produkHukumList->id)->where('jenis_status', 'mencabut')->whereNotIn('peraturan_catatan', $existingMencabut)->delete();
            if (!empty($request->peraturan_mencabut)) {
                $countPeraturanMencabut = count($request->peraturan_mencabut);
                for ($i = 0; $i < $countPeraturanMencabut; $i++) {
                    $peraturanMencabut = new ProdukHukumListCatatanStat();

                    $peraturanMencabut->produk_hukum_lists_id = $produkHukumList->id;
                    $peraturanMencabut->peraturan_catatan = $request->peraturan_mencabut[$i];
                    $peraturanMencabut->jenis_status = $request->chkMencabut;
                    $peraturanMencabut->updated_by = session('id');

                    $peraturanMencabut->save();
                }
            }
            
            $existingPeraturanTerkait = $request->input('existing_peraturan_terkait', []);
            ProdukHukumListDocument::where('produk_hukum_lists_id', $produkHukumList->id)->whereNotIn('peraturan_terkait', $existingPeraturanTerkait)->delete();
            if (!empty($request->peraturan_terkait)) {
//                $deleteDocuments = DB::table('produk_hukum_list_documents')->whereIn('produk_hukum_lists_id', array($id))->delete();

                $countPeraturanTerkait = count($request->peraturan_terkait);
                for ($i = 0; $i < $countPeraturanTerkait; $i++) {
                    $produkHukumListDocument = new ProdukHukumListDocument();
//                    $data = $request->only($produkHukumListDocument->getFillable());

                    $produkHukumListDocument->produk_hukum_lists_id = $produkHukumList->id;
                    $produkHukumListDocument->peraturan_terkait = $request->peraturan_terkait[$i];
                    $produkHukumListDocument->updated_by = session('id');

                    $produkHukumListDocument->save();
                }
            }
            
            $existingDokumenTerkait = $request->input('existing_dokumen_terkait', []);
            ProdukHukumListDocTerkait::where('produk_hukum_lists_id', $produkHukumList->id)->whereNotIn('dokumen_terkait', $existingDokumenTerkait)->delete();
            if ($request->hasFile('file_doc_terkait')) {
                $request->validate([
                    'file_doc_terkait.*' => 'required|mimes:pdf|max:256000'
                ],
                [
                    'file_doc_terkait.mimes' => 'Jenis/Ukuran File Dokumen Terkait tidak diijinkan'
                ]);
                
                foreach ($request->file_doc_terkait as $key => $value) {
//                    $deleteDocuments = DB::table('produk_hukum_list_doc_terkaits')->whereIn('produk_hukum_lists_id', array($id))->delete();
                    
                    $produkHukumListDocTerkait = new ProdukHukumListDocTerkait();

                    $name_file = $value->getClientOriginalName();
                    $filename_img = pathinfo($name_file, PATHINFO_FILENAME);
                    $extension_file = $value->extension();
                    $final_name_file = $filename_img.'_'.time().'.'.$extension_file;
                    Storage::putFileAs('public/places/peraturan', $value, $final_name_file);

                    $produkHukumListDocTerkait->dokumen_terkait = $final_name_file;
                    $produkHukumListDocTerkait->produk_hukum_lists_id = $produkHukumList->id;
                    $produkHukumListDocTerkait->updated_by = session('id');
                    $produkHukumListDocTerkait->save();
                }
            }

            return redirect()->route('admin.produk_hukum.listdata.index')->with('success', 'Produk Hukum is updated successfully!');
        } else {
            return redirect()->route('admin.produk_hukum.listdata.index')->with('success', 'Produk Hukum is updated successfully!');
        }

        // return redirect()->route('admin.produk_hukum.listdata.index')->with('success', 'Produk Hukum is updated successfully!');
    }

    public function destroy($id) {
        $produkHukumList = ProdukHukumList::findOrFail($id);

        $data['is_deleted'] = 1;
        $data['deleted_by'] = session('id');
        $data['deleted_at'] = date("Y-m-d H:i:s", strtotime('now'));

        $produkHukumList->fill($data)->save();
        return Redirect()->back()->with('success', 'Produk Hukum is deleted successfully!');
    }

}