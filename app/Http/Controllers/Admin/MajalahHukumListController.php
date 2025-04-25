<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\MajalahHukumList;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use DB;

class MajalahHukumListController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        if(session('comp_code') == null) {
            $compcode = '';
            $majalahHukumList = MajalahHukumList::join('companies', 'majalah_hukum_lists.comp_code', '=', 'companies.comp_code')
                                ->orderBy('majalah_hukum_lists.created_at', 'desc')
                                ->get(['majalah_hukum_lists.*', 'companies.comp_name']);
            return view('admin.media_hukum.majalahhukum.index', compact('majalahHukumList', 'compcode'));
        } else {
            $compcode = session('comp_code');
            $majalahHukumList = MajalahHukumList::where('comp_code', session('comp_code'))
                                ->orderBy('created_at', 'desc')
                                ->get();
            return view('admin.media_hukum.majalahhukum.index', compact('majalahHukumList', 'compcode'));
        }
    }

    public function create()
    {
        return view('admin.media_hukum.majalahhukum.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul_majalah' => 'required|unique:majalah_hukum_lists',
            'slug' => 'unique:majalah_hukum_lists'
        ]);
        
        $majalahHukumList = new MajalahHukumList();

        if($request->hasFile('cover_majalah')) {
            $request->validate([
                'cover_majalah' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $name_imgfile = $request->file('cover_majalah')->getClientOriginalName();
            $filename_img = pathinfo($name_imgfile, PATHINFO_FILENAME);
            $extension_file = $request->file('cover_majalah')->extension();
            $final_name_imgfile = $filename_img.'_'.time().'.'.$extension_file;
            Storage::putFileAs('public/places/majalah/cover', $request->file('cover_majalah'), $final_name_imgfile);
//            $request->file('cover_majalah')->move(public_path('uploads/majalah/cover/'), $final_name_imgfile);

            $majalahHukumList->cover_majalah = $final_name_imgfile;
        }

        if($request->hasFile('file_majalah')) {
            $request->validate([
                'file_majalah' => 'required|mimes:pdf,zip'
            ]);

            $name_pdffile = $request->file('file_majalah')->getClientOriginalName();
            $filename_pdf = pathinfo($name_pdffile, PATHINFO_FILENAME);
            $extension_file = $request->file('file_majalah')->extension();
            $final_name_pdffile = $filename_pdf.'_'.time().'.'.$extension_file;
            Storage::putFileAs('public/places/majalah', $request->file('file_majalah'), $final_name_pdffile);
//            $request->file('file_majalah')->move(public_path('uploads/majalah/'), $final_name_pdffile);

            $majalahHukumList->file_majalah = $final_name_pdffile;
        }

        $slug = Str::slug($request->judul_majalah, '-');

        $majalahHukumList->slug = $slug;
        $majalahHukumList->comp_code = session('comp_code');
        $majalahHukumList->created_by = session('id');

        $majalahHukumList->save();
        return redirect()->route('admin.media_hukum.majalahhukum.index')->with('success', 'Majalah Hukum is added successfully!');
    }

    public function edit($id)
    {
        $majalahHukumList = MajalahHukumList::findOrFail($id);
        return view('admin.media_hukum.majalahhukum.edit', compact('majalahHukumList'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul_majalah' =>  [
                'required',
                Rule::unique('majalah_hukum_lists')->ignore($id),
            ]
        ]);
        
        $majalahHukumList = MajalahHukumList::findOrFail($id);

        $slug = Str::slug($request->judul_majalah, '-');
        $majalahHukumList->slug = $slug;

        $majalahHukumList->updated_by = session('id');

        if($request->hasFile('cover_majalah')) {
            $request->validate([
                'cover_majalah' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $name_imgfile = $request->file('cover_majalah')->getClientOriginalName();
            $filename_img = pathinfo($name_imgfile, PATHINFO_FILENAME);
            $extension_file = $request->file('cover_majalah')->extension();
            $final_name_imgfile = $filename_img.'_'.time().'.'.$extension_file;
            Storage::putFileAs('public/places/majalah/cover', $request->file('cover_majalah'), $final_name_imgfile);
//            $request->file('cover_majalah')->move(public_path('uploads/majalah/cover/'), $final_name_imgfile);

            $majalahHukumList->cover_majalah = $final_name_imgfile;
        }

        if($request->hasFile('file_majalah')) {
            $request->validate([
                'file_majalah' => 'required|mimes:pdf,zip'
            ]);

            $name_pdffile = $request->file('file_majalah')->getClientOriginalName();
            $filename_pdf = pathinfo($name_pdffile, PATHINFO_FILENAME);
            $extension_file = $request->file('file_majalah')->extension();
            $final_name_pdffile = $filename_pdf.'_'.time().'.'.$extension_file;
            Storage::putFileAs('public/places/majalah', $request->file('file_majalah'), $final_name_pdffile);
//            $request->file('file_majalah')->move(public_path('uploads/majalah/'), $final_name_pdffile);
            
            $majalahHukumList->file_majalah = $final_name_pdffile;
        }

        $majalahHukumList->save();
        return redirect()->route('admin.media_hukum.majalahhukum.index')->with('success', 'Majalah Hukum is updated successfully!');
    }

}