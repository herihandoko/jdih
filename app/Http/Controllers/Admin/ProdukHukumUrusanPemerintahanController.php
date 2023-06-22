<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ProdukHukumUrusanPemerintahan;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Crypt;
use DB;

class ProdukHukumUrusanPemerintahanController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $produkHukumUrusanPemerintahan = ProdukHukumUrusanPemerintahan::orderBy('up_code', 'asc')->get();
        return view('admin.produk_hukum.urusanpemerintahan.index', compact('produkHukumUrusanPemerintahan'));
    }

    public function create()
    {
        return view('admin.produk_hukum.urusanpemerintahan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'up_name' => 'required|unique:produk_hukum_urusan_pemerintahans',
            'up_active' => 'required'
        ],
        [
            'up_name.required' => 'Urusan Pemerintahan harus diisi.',
            'up_name.unique' => 'Urusan Pemerintahan sudah ada. Silakan input Urusan Pemerintahan lainnya.'
        ]);

        $produkHukumUrusanPemerintahan = new ProdukHukumUrusanPemerintahan();
        $data = $request->only($produkHukumUrusanPemerintahan->getFillable());

        $data['created_by'] = session('id');

        $produkHukumUrusanPemerintahan->fill($data)->save();
        return redirect()->route('admin.produk_hukum.up.index')->with('success', 'Urusan Pemerintahan is added successfully!');
    }

    public function edit($id)
    {
        $upID = Crypt::decrypt($id);
        $produkHukumUrusanPemerintahan = ProdukHukumUrusanPemerintahan::findOrFail($upID);
        return view('admin.produk_hukum.urusanpemerintahan.edit', compact('produkHukumUrusanPemerintahan'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'up_name'   =>  [
                'required',
                Rule::unique('produk_hukum_urusan_pemerintahans')->ignore($id),
            ]
        ],
        [
            'up_name.required' => 'Urusan Pemerintahan harus diisi.'
        ]);

        $produkHukumUrusanPemerintahan = ProdukHukumUrusanPemerintahan::findOrFail($id);
        $data = $request->only($produkHukumUrusanPemerintahan->getFillable());

        $data['updated_by'] = session('id');

        $produkHukumUrusanPemerintahan->fill($data)->save();
        return redirect()->route('admin.produk_hukum.up.index')->with('success', 'Urusan Pemerintahan is updated successfully!');
    }

}