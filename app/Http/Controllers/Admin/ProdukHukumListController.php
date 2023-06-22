<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Crypt;
use App\Models\Admin\ProdukHukumList;
use App\Models\Admin\Admin;
use App\Models\Admin\ProdukHukumListPembahasanDate;
use App\Models\Admin\ProdukHukumListDocument;
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
        $produkJudulPeraturan = DB::table('produk_hukum_lists')->select('id', 'judul_peraturan')->where('produk_hukum_categories_id', $registerJenisDok)->where('is_deleted', 0)->orderBy('judul_peraturan', 'asc')->get();
        $produkHukumType = DB::table('produk_hukum_types')->where('type_active', 1)->orderBy('type_name', 'asc')->get();
        $produkHukumUrusanPemerintahan = DB::table('produk_hukum_urusan_pemerintahans')->where('up_active', 1)->orderBy('up_code', 'asc')->get();
        $produkHukumBidangHukum = DB::table('produk_hukum_bidang_hukums')->where('bh_active', 1)->orderBy('bh_code', 'asc')->get();
        $produkHukumCategoryName = DB::table('produk_hukum_categories')->where('id', $registerJenisDok)->first();
        return view('admin.produk_hukum.listdata.create', compact('produkJudulPeraturan', 'produkHukumType', 'produkHukumCategoryName', 'registerJenisDok', 'produkHukumUrusanPemerintahan', 'produkHukumBidangHukum'));
    }

    public function store(Request $request) {
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
        $data = $request->only($produkHukumList->getFillable());

        $data['slug'] = $slug;

        if (!empty($request->tgl_pengajuan) || $request->tgl_pengajuan != null) {
            $data['tgl_pengajuan'] = Carbon::createFromFormat('d-m-Y', $request->tgl_pengajuan)->format('Y-m-d');
        }

        if (!empty($request->tgl_penetapan) || $request->tgl_penetapan != null) {
            $data['tgl_penetapan'] = Carbon::createFromFormat('d-m-Y', $request->tgl_penetapan)->format('Y-m-d');
        }

        if (!empty($request->tgl_pengundangan) || $request->tgl_pengundangan != null) {
            $data['tgl_pengundangan'] = Carbon::createFromFormat('d-m-Y', $request->tgl_pengundangan)->format('Y-m-d');
        }

        $data['created_by'] = session('id');
        $data['comp_code'] = session('comp_code');

        if ($request->hasFile('file_peraturan')) {
            $request->validate([
                'file_peraturan' => 'required|mimes:pdf,zip|max:256000'
                    ],
                    [
                        'file_peraturan.mimes' => 'Jenis/Ukuran File Peraturan tidak diijinkan'
            ]);

            $name_pdffile = $request->file('file_peraturan')->getClientOriginalName();
            $filename_pdf = pathinfo($name_pdffile, PATHINFO_FILENAME);
            $extension_file = $request->file('file_peraturan')->getClientOriginalExtension();
            $final_name_pdffile = $filename_pdf . '_' . time() . '.' . $extension_file;
            Storage::putFileAs('public/places/peraturan', $request->file('file_peraturan'), $final_name_pdffile);
//            $request->file('file_peraturan')->move(public_path('uploads/peraturan/'), $final_name_pdffile);

            $data['file_peraturan'] = $final_name_pdffile;
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
            $extension_abstrak_file = $request->file('abstrak')->getClientOriginalExtension();
            $final_abstrakname_pdffile = $fileabstrakname_pdf . '_' . time() . '.' . $extension_abstrak_file;
            Storage::putFileAs('public/places/peraturan', $request->file('abstrak'), $final_abstrakname_pdffile);
//            $request->file('abstrak')->move(public_path('uploads/peraturan/'), $final_abstrakname_pdffile);

            $data['abstrak'] = $final_abstrakname_pdffile;
        }

        $produkHukumList->fill($data)->save();

        if ($produkHukumList->id) {
            if (!empty($produkHukumList->tgl_pembahasan)) {
                $tglPembahasanArr = explode(",", $produkHukumList->tgl_pembahasan);
                foreach ($tglPembahasanArr as $key => $value) {
                    $produkHukumListPembahasanDate = new ProdukHukumListPembahasanDate();
                    $data = $request->only($produkHukumListPembahasanDate->getFillable());

                    $data['produk_hukum_lists_id'] = $produkHukumList->id;
                    $data['tgl_pembahasan'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
                    $data['created_by'] = session('id');

                    $produkHukumListPembahasanDate->fill($data)->save();
                }
            }

            if (!empty($request->peraturan_terkait)) {
                $countPeraturanTerkait = count($request->peraturan_terkait);
                for ($i = 0; $i < $countPeraturanTerkait; $i++) {
                    $produkHukumListDocument = new ProdukHukumListDocument();
                    $data = $request->only($produkHukumListDocument->getFillable());

                    $data['produk_hukum_lists_id'] = $produkHukumList->id;
                    $data['peraturan_terkait'] = $request->peraturan_terkait[$i];
                    $data['created_by'] = session('id');

                    $produkHukumListDocument->fill($data)->save();
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
        $produkHukumCategoryName = DB::table('produk_hukum_categories')->where('id', $produkHukumList->produk_hukum_categories_id)->first();
        $produkJudulPeraturan = DB::table('produk_hukum_lists')->where('id', '!=', $produkHukumList->id)->where('produk_hukum_categories_id', '=', $produkHukumCategoryName->id)->where('is_deleted', 0)->orderBy('judul_peraturan', 'asc')->get();
        $produkHukumType = DB::table('produk_hukum_types')->get();
        $produkHukumUrusanPemerintahan = DB::table('produk_hukum_urusan_pemerintahans')->where('up_active', 1)->orderBy('up_code', 'asc')->get();
        $produkHukumBidangHukum = DB::table('produk_hukum_bidang_hukums')->where('bh_active', 1)->orderBy('bh_code', 'asc')->get();
        $produkHukumCategory = DB::table('produk_hukum_categories')->get();
        $produkDokumenTerkait = DB::table('produk_hukum_list_documents')->where('produk_hukum_lists_id', $produkHukumList->id)->get();
        return view('admin.produk_hukum.listdata.edit', compact('produkJudulPeraturan', 'produkHukumList', 'produkHukumCategoryName', 'produkHukumType', 'produkHukumCategory', 'produkDokumenTerkait', 'produkHukumUrusanPemerintahan', 'produkHukumBidangHukum'));
    }

    public function update(Request $request, $id) {
        $produkHukumList = ProdukHukumList::findOrFail($id);
        $data = $request->only($produkHukumList->getFillable());

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

        $slug = Str::slug($request->judul_peraturan, '-');
        $data['slug'] = $slug;

        if (!empty($request->tgl_pengajuan) || $request->tgl_pengajuan != null) {
            $data['tgl_pengajuan'] = Carbon::createFromFormat('d-m-Y', $request->tgl_pengajuan)->format('Y-m-d');
        }

        if (!empty($request->tgl_penetapan) || $request->tgl_penetapan != null) {
            $data['tgl_penetapan'] = Carbon::createFromFormat('d-m-Y', $request->tgl_penetapan)->format('Y-m-d');
        }

        if (!empty($request->tgl_pengundangan) || $request->tgl_pengundangan != null) {
            $data['tgl_pengundangan'] = Carbon::createFromFormat('d-m-Y', $request->tgl_pengundangan)->format('Y-m-d');
        }

        $data['updated_by'] = session('id');

        if ($request->hasFile('file_peraturan')) {
            $request->validate([
                'file_peraturan' => 'required|mimes:pdf,zip|max:256000'
                    ],
                    [
                        'file_peraturan.mimes' => 'Jenis/Ukuran File Peraturan tidak diijinkan'
            ]);

            $name_pdffile = $request->file('file_peraturan')->getClientOriginalName();
            $filename_pdf = pathinfo($name_pdffile, PATHINFO_FILENAME);
            $extension_file = $request->file('file_peraturan')->getClientOriginalExtension();
            $final_name_pdffile = $filename_pdf . '_' . time() . '.' . $extension_file;
            Storage::putFileAs('public/places/peraturan', $request->file('file_peraturan'), $final_name_pdffile);
//            $request->file('file_peraturan')->move(public_path('uploads/peraturan/'), $final_name_pdffile);

            $data['file_peraturan'] = $final_name_pdffile;
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
            $extension_abstrak_file = $request->file('abstrak')->getClientOriginalExtension();
            $final_abstrakname_pdffile = $fileabstrakname_pdf . '_' . time() . '.' . $extension_abstrak_file;
            Storage::putFileAs('public/places/peraturan', $request->file('abstrak'), $final_abstrakname_pdffile);
//            $request->file('abstrak')->move(public_path('uploads/peraturan/'), $final_abstrakname_pdffile);

            $data['abstrak'] = $final_abstrakname_pdffile;
        }

        $produkHukumList->fill($data)->save();

        if ($produkHukumList->id) {

            if (!empty($produkHukumList->tgl_pembahasan)) {
                $tglPembahasanArr = explode(",", $produkHukumList->tgl_pembahasan);
                foreach ($tglPembahasanArr as $key => $value) {
                    $produkHukumListPembahasanDate = new ProdukHukumListPembahasanDate();
                    $data = $request->only($produkHukumListPembahasanDate->getFillable());

                    $data['produk_hukum_lists_id'] = $produkHukumList->id;
                    $data['tgl_pembahasan'] = Carbon::createFromFormat('d-m-Y', $value)->format('Y-m-d');
                    $data['updated_by'] = session('id');

                    $produkHukumListPembahasanDate->fill($data)->save();
                }
            }

            if (!empty($request->peraturan_terkait)) {
                $deleteDocuments = DB::table('produk_hukum_list_documents')->whereIn('produk_hukum_lists_id', array($id))->delete();

                $countPeraturanTerkait = count($request->peraturan_terkait);
                for ($i = 0; $i < $countPeraturanTerkait; $i++) {
                    $produkHukumListDocument = new ProdukHukumListDocument();
                    $data = $request->only($produkHukumListDocument->getFillable());

                    $data['produk_hukum_lists_id'] = $produkHukumList->id;
                    $data['peraturan_terkait'] = $request->peraturan_terkait[$i];
                    $data['updated_by'] = session('id');

                    $produkHukumListDocument->fill($data)->save();
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
