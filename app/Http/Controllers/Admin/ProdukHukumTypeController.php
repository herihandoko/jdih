<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ProdukHukumCategory;
use App\Models\Admin\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use DB;

class ProdukHukumTypeController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $produkHukumCategory = ProdukHukumCategory::orderBy('category_name', 'asc')->get();
        return view('admin.produk_hukum.tipe.index', compact('produkHukumCategory'));
    }

    public function create()
    {
        return view('admin.produk_hukum.tipe.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:produk_hukum_categories',
            'category_active' => 'required'
        ],
        [
            'category_name.required' => 'Tipe Dokumen harus diisi.',
            'category_name.unique' => 'Tipe Dokumen sudah ada. Silakan input Tipe Dokumen lainnya.'
        ]);

        $produkHukumCategory = new ProdukHukumCategory();
        $data = $request->only($produkHukumCategory->getFillable());

        $data['created_by'] = session('id');

        $addedProduk = $produkHukumCategory->fill($data)->save();
        if($addedProduk) {
            $menuFront = new Menu();
            $menuFront->menu_name = $request->category_name;
            $menuFront->parent_id = 0;
            $menuFront->menu_status = 'Hide';
            $menuFront->type_doc = $produkHukumCategory->id;
            $menuFront->is_active = $request->category_active;
            $menuFront->editabled = 1;
            $addedMenu = $menuFront->save();
            if($addedMenu) {
                $updateMenuIdProdukHukum = ProdukHukumCategory::findOrFail($produkHukumCategory->id);
                $dataUpdateMenuId['menus_id'] = $menuFront->id;
                $updateMenuIdProdukHukum->fill($dataUpdateMenuId)->save();
                return redirect()->route('admin.produk_hukum.tipe.index')->with('success', 'Tipe Dokumen is added successfully!');
            } else {
                return redirect()->route('admin.produk_hukum.tipe.index')->with('error', 'Tipe Dokumen is failed to add!');
            }
        } else {
            return redirect()->route('admin.produk_hukum.tipe.index')->with('error', 'Tipe Dokumen is failed to add!');
        }
    }

    public function edit($id)
    {
        $produkHukumCategory = ProdukHukumCategory::findOrFail($id);
        return view('admin.produk_hukum.tipe.edit', compact('produkHukumCategory'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'category_name'   =>  [
                'required',
                Rule::unique('produk_hukum_categories')->ignore($id),
            ]
        ],
        [
            'category_name.required' => 'Tipe Dokumen harus diisi.'
        ]);

        $produkHukumCategory = ProdukHukumCategory::findOrFail($id);
        $data = $request->only($produkHukumCategory->getFillable());

        $data['updated_by'] = session('id');

        $updateProdukHukumCat = $produkHukumCategory->fill($data)->save();
        
        if($updateProdukHukumCat) {
            $updateProdukHukumCatName = Menu::findOrFail($produkHukumCategory->menus_id);
            $dataUpdateProdukHukumCatName['menu_name'] = $request->category_name;
            if($request->category_active == 0) {
                $dataUpdateProdukHukumCatName['parent_id'] = 0;
                $dataUpdateProdukHukumCatName['menu_status'] = 'Hide';
            }
            $dataUpdateProdukHukumCatName['is_active'] = $request->category_active;
            $updateProdukHukumCatName->fill($dataUpdateProdukHukumCatName)->save();
            return redirect()->route('admin.produk_hukum.tipe.index')->with('success', 'Tipe Dokumen is updated successfully!');
        } else {
            return redirect()->route('admin.produk_hukum.tipe.index')->with('success', 'Tipe Dokumen is failed to updated!');
        }
    }

}