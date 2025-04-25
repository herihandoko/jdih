<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ArtikelHukumList;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use DB;

class ArtikelHukumListController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        if(session('comp_code') == null) {
            $compcode = '';
            $artikelHukumList = ArtikelHukumList::join('companies', 'artikel_hukum_lists.comp_code', '=', 'companies.comp_code')
                                ->orderBy('artikel_hukum_lists.created_at', 'desc')
                                ->get(['artikel_hukum_lists.*', 'companies.comp_name']);
            return view('admin.media_hukum.artikelhukum.index', compact('artikelHukumList', 'compcode'));
        } else {
            $compcode = session('comp_code');
            $artikelHukumList = ArtikelHukumList::where('comp_code', session('comp_code'))
                                ->orderBy('created_at', 'desc')
                                ->get();
            return view('admin.media_hukum.artikelhukum.index', compact('artikelHukumList', 'compcode'));
        }
    }

    public function create()
    {
        return view('admin.media_hukum.artikelhukum.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_artikel' => 'required|unique:artikel_hukum_lists',
            'slug' => 'unique:artikel_hukum_lists'
        ]);

        $slug = Str::slug($request->judul_artikel, '-');

        $artikelHukumList = new ArtikelHukumList();

        if($request->publish == 1) {
            $artikelHukumList->publish = 1;
            $artikelHukumList->publish_at = Carbon::now()->toDateTimeString();
        } else {
            $artikelHukumList->publish = 0;
        }

        $artikelHukumList->slug = $slug;
        $artikelHukumList->penulis_artikel = session('name');
        $artikelHukumList->tahun_artikel = Carbon::now()->format('Y');
        $artikelHukumList->comp_code = session('comp_code');
        $artikelHukumList->created_by = session('id');

        $artikelHukumList->save();
        return redirect()->route('admin.media_hukum.artikelhukum.index')->with('success', 'Artikel Hukum is added successfully!');
    }

    public function edit($id)
    {
        $artikelHukumList = ArtikelHukumList::findOrFail($id);
        return view('admin.media_hukum.artikelhukum.edit', compact('artikelHukumList'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_artikel' =>  [
                'required',
                Rule::unique('artikel_hukum_lists')->ignore($id),
            ]
        ]);
        
        $artikelHukumList = ArtikelHukumList::findOrFail($id);

        $slug = Str::slug($request->judul_artikel, '-');

        if($request->publish == 1) {
            $artikelHukumList->publish = 1;
            $artikelHukumList->publish_at = Carbon::now()->toDateTimeString();
        }

        $artikelHukumList->slug = $slug;
        $artikelHukumList->updated_by = session('id');

        $artikelHukumList->save();
        return redirect()->route('admin.media_hukum.artikelhukum.index')->with('success', 'Artikel Hukum is updated successfully!');
    }

}