<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ProdukHukumBidangHukum;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Crypt;
use DB;

class ProdukHukumBidangHukumController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $produkHukumBidangHukum = ProdukHukumBidangHukum::orderBy('bh_code', 'asc')->get();
        return view('admin.produk_hukum.bidanghukum.index', compact('produkHukumBidangHukum'));
    }

    public function create()
    {
        return view('admin.produk_hukum.bidanghukum.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'bh_name' => 'required|unique:produk_hukum_bidang_hukums',
            'bh_active' => 'required'
        ],
        [
            'bh_name.required' => 'Bidang Hukum harus diisi.',
            'bh_name.unique' => 'Bidang Hukum sudah ada. Silakan input Bidang Hukum lainnya.'
        ]);

        $produkHukumBidangHukum = new ProdukHukumBidangHukum();
        $data = $request->only($produkHukumBidangHukum->getFillable());

        $data['created_by'] = session('id');

        $produkHukumBidangHukum->fill($data)->save();
        return redirect()->route('admin.produk_hukum.bh.index')->with('success', 'Bidang Hukum is added successfully!');
    }

    public function edit($id)
    {
        $bhID = Crypt::decrypt($id);
        $produkHukumBidangHukum = ProdukHukumBidangHukum::findOrFail($bhID);
        return view('admin.produk_hukum.bidanghukum.edit', compact('produkHukumBidangHukum'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'bh_name'   =>  [
                'required',
                Rule::unique('produk_hukum_bidang_hukums')->ignore($id),
            ]
        ],
        [
            'bh_name.required' => 'Bidang Hukum harus diisi.'
        ]);

        $produkHukumBidangHukum = ProdukHukumBidangHukum::findOrFail($id);
        $data = $request->only($produkHukumBidangHukum->getFillable());

        $data['updated_by'] = session('id');

        $produkHukumBidangHukum->fill($data)->save();
        return redirect()->route('admin.produk_hukum.bh.index')->with('success', 'Bidang Hukum is updated successfully!');
    }

}