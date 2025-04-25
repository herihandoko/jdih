<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ProdukHukumLanguage;
use App\Models\Admin\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use DB;

class ProdukHukumLanguageController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $produkHukumLanguage = ProdukHukumLanguage::orderBy('language_name', 'asc')->get();
        return view('admin.produk_hukum.bahasa.index', compact('produkHukumLanguage'));
    }

    public function create()
    {
        return view('admin.produk_hukum.bahasa.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'language_name' => 'required|unique:produk_hukum_languages',
            'language_active' => 'required'
        ],
        [
            'language_name.required' => 'Bahasa harus diisi.',
            'language_name.unique' => 'Bahasa sudah ada. Silakan input Bahasa lainnya.'
        ]);

        $produkHukumLanguage = new ProdukHukumLanguage();

        $data = $request->only($produkHukumLanguage->getFillable());

        $data['created_by'] = session('id');

        $produkHukumLanguage->fill($data)->save();
        return redirect()->route('admin.produk_hukum.bahasa.index')->with('success', 'Bahasa is added successfully!');
    }

    public function edit($id)
    {
        $produkHukumLanguage = ProdukHukumLanguage::findOrFail($id);
        return view('admin.produk_hukum.bahasa.edit', compact('produkHukumLanguage'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'language_name'   =>  [
                'required',
                Rule::unique('produk_hukum_languages')->ignore($id),
            ]
        ],
        [
            'language_name.required' => 'Bahasa harus diisi.'
        ]);

        $produkHukumLanguage = ProdukHukumLanguage::findOrFail($id);
        $data = $request->only($produkHukumLanguage->getFillable());

        $data['updated_by'] = session('id');

        $produkHukumLanguage->fill($data)->save();
        return redirect()->route('admin.produk_hukum.bahasa.index')->with('success', 'Bahasa is updated successfully!');
    }

}