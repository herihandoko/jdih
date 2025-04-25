<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\BeritaList;
use App\Models\Admin\BeritaCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use DB;

class BeritaListController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        if(session('comp_code') == null) {
            $compcode = '';
            $beritaList = BeritaList::leftJoin('companies', 'berita_lists.comp_code', '=', 'companies.comp_code')
                                ->join('admins', 'berita_lists.created_by', '=', 'admins.id')
                                ->where('berita_lists.is_deleted', '=', 0)
                                ->orderBy('berita_lists.created_at', 'desc')
                                ->get(['berita_lists.*', 'companies.comp_name', 'admins.name']);
            return view('admin.media_hukum.berita.index', compact('beritaList', 'compcode'));
        } else {
            $compcode = session('comp_code');
            $beritaList = BeritaList::join('admins', 'berita_lists.created_by', '=', 'admins.id')
                                ->where('berita_lists.comp_code', session('comp_code'))
                                ->where('berita_lists.is_deleted', '=', 0)
                                ->orderBy('berita_lists.created_at', 'desc')
                                ->get(['berita_lists.*', 'admins.name']);
            
            return view('admin.media_hukum.berita.index', compact('beritaList', 'compcode'));
        }
    }

    public function create()
    {
        $categoryBerita = BeritaCategory::where('category_active', 1)
                            ->orderBy('category_name', 'asc')
                            ->get();
        return view('admin.media_hukum.berita.create', compact('categoryBerita'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_berita' => 'required|unique:berita_lists',
            'slug' => 'unique:berita_lists'
        ],[
            'judul_berita.required' => 'Judul Berita harus diisi.',
            'judul_berita.unique' => 'Judul Berita sudah ada. Silakan input Judul Berita lainnya.'
        ]);

        $slug = Str::slug($request->judul_berita, '-');

        $beritaList = new BeritaList();

        if($request->type_active == 1) {
            $beritaList->publish = 1;
            $beritaList->publish_at = Carbon::now()->toDateTimeString();
        } else {
            $beritaList->publish = 0;
        }
        
        $beritaList->judul_berita = $request->judul_berita;
        $beritaList->berita_categories_id = $request->berita_categories_id;
        $beritaList->content_berita = $request->content_berita;
        $beritaList->slug = $slug;
        $beritaList->comp_code = session('comp_code');
        $beritaList->created_by = session('id');
        
        if($request->hasFile('photo_berita')) {
            $request->validate([
                'photo_berita' => 'required|mimes:jpeg,png,jpg,gif|max:2048'
            ],
            [
                'photo_berita.mimes' => 'Foto Berita tidak diijinkan'
            ]);

            $name_file = $request->file('photo_berita')->getClientOriginalName();
            $filename_img = pathinfo($name_file, PATHINFO_FILENAME);
            $extension_file = $request->file('photo_berita')->extension();
            $final_name_file = $filename_img.'_'.time().'.'.$extension_file;
            Storage::putFileAs('public/places/berita', $request->file('photo_berita'), $final_name_file);
//            $request->file('photo_berita')->move(public_path('uploads/berita/'), $final_name_file);

            $beritaList->photo_berita = $final_name_file;
        }

        $beritaList->save();
//        return redirect()->back()->with('success', 'Berita is added successfully!');
        return redirect()->route('admin.media_hukum.berita.index')->with('success', 'Berita is added successfully!');
    }

    public function edit($id)
    {
        $beritaID = Crypt::decrypt($id);
        $beritaList = BeritaList::findOrFail($beritaID);
        $beritaCategory = BeritaCategory::where('category_active', 1)
                            ->orderBy('category_name', 'asc')
                            ->get();
        return view('admin.media_hukum.berita.edit', compact('beritaList', 'beritaCategory'));
    }

    public function update(Request $request, $id)
    {
        $beritaList = BeritaList::findOrFail($id);

        $request->validate([
            'judul_berita' =>  [
                'required',
                Rule::unique('berita_lists')->ignore($id),
            ]
        ]);

        $slug = Str::slug($request->judul_berita, '-');

        if($request->type_active == 1) {
            $beritaList->publish = 1;
            $beritaList->publish_at = Carbon::now()->toDateTimeString();
        } else {
            $beritaList->publish = 0;
        }
        
        $beritaList->judul_berita = $request->judul_berita;
        $beritaList->berita_categories_id = $request->berita_categories_id;
        $beritaList->content_berita = $request->content_berita;
        $beritaList->slug = $slug;
        $beritaList->updated_by = session('id');
        
        if($request->hasFile('photo_berita')) {
            $request->validate([
                'photo_berita' => 'required|mimes:jpeg,png,jpg,gif|max:2048'
            ],
            [
                'photo_berita.mimes' => 'Foto Berita tidak diijinkan'
            ]);

            $name_file = $request->file('photo_berita')->getClientOriginalName();
            $filename_img = pathinfo($name_file, PATHINFO_FILENAME);
            $extension_file = $request->file('photo_berita')->extension();
            $final_name_file = $filename_img.'_'.time().'.'.$extension_file;
            Storage::putFileAs('public/places/berita', $request->file('photo_berita'), $final_name_file);
//            $request->file('photo_berita')->move(public_path('uploads/berita/'), $final_name_file);

            $beritaList->photo_berita = $final_name_file;
        }

        $beritaList->save();
//        return redirect()->back()->with('success', 'Berita is updated successfully!');
        return redirect()->route('admin.media_hukum.berita.index')->with('success', 'Berita is updated successfully!');
    }
    
    public function destroy($id)
    {
        $beritaList = BeritaList::findOrFail($id);
        
        $data['is_deleted'] = 1;
        $data['deleted_by'] = session('id');
        $data['deleted_at'] = date("Y-m-d H:i:s", strtotime('now'));

        $beritaList->fill($data)->save();
        return redirect()->back()->with('success', 'Berita is deleted successfully!');
    }
    
    public function category() {
        $beritaCategory = BeritaCategory::orderBy('created_at', 'desc')
                                ->get();
        return view('admin.media_hukum.berita.category', compact('beritaCategory'));
    }
    
    public function categorycreate()
    {
        return view('admin.media_hukum.berita.categorycreate');
    }

    public function categorystore(Request $request)
    {
        $request->validate([
            'category_name' => 'required|unique:berita_categories'
        ],[
            'category_name.required' => 'Nama Kategori harus diisi.',
            'category_name.unique' => 'Nama Kategori sudah ada. Silakan input Nama Kategori lainnya.'
        ]);

        $beritaCategory = new BeritaCategory();
        
        $beritaCategory->category_name = $request->category_name;
        $beritaCategory->category_active = $request->category_active;
        $beritaCategory->created_by = session('id');

        $beritaCategory->save();
        return redirect()->route('admin.media_hukum.berita.category')->with('success', 'Kategori Berita is added successfully!');
    }

    public function categoryedit($id)
    {
        $kategoriID = Crypt::decrypt($id);
        $beritaCategory = BeritaCategory::findOrFail($kategoriID);
        return view('admin.media_hukum.berita.categoryedit', compact('beritaCategory'));
    }

    public function categoryupdate(Request $request, $id)
    {
        $beritaCategory = BeritaCategory::findOrFail($id);

        $request->validate([
            'category_name' =>  [
                'required',
                Rule::unique('berita_categories')->ignore($id),
            ]
        ]);
        
        $beritaCategory->category_name = $request->category_name;
        $beritaCategory->category_active = $request->category_active;
        $beritaCategory->updated_by = session('id');

        $beritaCategory->save();
        return redirect()->route('admin.media_hukum.berita.category')->with('success', 'Kategori Berita is updated successfully!');
    }

}