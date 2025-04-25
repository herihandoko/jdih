<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ProdukHukumType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use DB;

class ProdukHukumCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $produkHukumType = ProdukHukumType::orderBy('type_name', 'asc')->get();
        return view('admin.produk_hukum.jenis.index', compact('produkHukumType'));
    }

    public function create()
    {
        return view('admin.produk_hukum.jenis.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'type_name' => 'required|unique:produk_hukum_types',
            'type_active' => 'required'
        ],
        [
            'type_name.required' => 'Jenis Peraturan harus diisi.',
            'type_name.unique' => 'Jenis Peraturan sudah ada. Silakan input Judul Peraturan lainnya.'
        ]);

        $produkHukumType = new ProdukHukumType();
        $data = $request->only($produkHukumType->getFillable());

        $data['created_by'] = session('id');

        $produkHukumType->fill($data)->save();
        return redirect()->route('admin.produk_hukum.jenis.index')->with('success', 'Jenis Peraturan is added successfully!');
    }

    public function edit($id)
    {
        $produkHukumType = ProdukHukumType::findOrFail($id);
        return view('admin.produk_hukum.jenis.edit', compact('produkHukumType'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'type_name'   =>  [
                'required',
                Rule::unique('produk_hukum_types')->ignore($id),
            ]
        ],
        [
            'type_name.required' => 'Jenis Peraturan harus diisi.'
        ]);

        $produkHukumType = ProdukHukumType::findOrFail($id);
        $data = $request->only($produkHukumType->getFillable());

        $data['updated_by'] = session('id');

        $produkHukumType->fill($data)->save();
        return redirect()->route('admin.produk_hukum.jenis.index')->with('success', 'Jenis Peraturan is updated successfully!');
    }

}