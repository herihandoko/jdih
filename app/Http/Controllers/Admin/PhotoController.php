<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\PhotosList;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use DB;

class PhotoController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        if(session('comp_code') == null) {
            $compcode = '';
            $photosList = PhotosList::leftJoin('companies', 'photos_lists.comp_code', '=', 'companies.comp_code')
                                ->join('admins', 'photos_lists.created_by', '=', 'admins.id')
                                ->where('photos_lists.is_deleted', '=', 0)
                                ->orderBy('photos_lists.created_at', 'desc')
                                ->get(['photos_lists.*', 'companies.comp_name', 'admins.name']);
            return view('admin.photo.index', compact('photosList', 'compcode'));
        } else {
            $compcode = session('comp_code');
            $photosList = PhotosList::join('admins', 'photos_lists.created_by', '=', 'admins.id')
                                ->where('photos_lists.comp_code', session('comp_code'))
                                ->where('photos_lists.is_deleted', '=', 0)
                                ->orderBy('photos_lists.created_at', 'desc')
                                ->get(['photos_lists.*', 'admins.name']);
            
            return view('admin.photo.index', compact('photosList', 'compcode'));
        }
    }

    public function create()
    {
        return view('admin.photo.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            "photo_name[]" => "image|array|mimes:jpeg,png,jpg,gif|max:2048",
            "photo_name.*[]" => "image|mimes:jpeg,png,jpg,gif|max:2048",
        ]);
        
        if(!empty($request->photo_name)) {
            foreach ($request->photo_name as $key => $value) {
                $photo = new PhotosList();
                
                $name_file = $value->getClientOriginalName();
                $filename_img = pathinfo($name_file, PATHINFO_FILENAME);
                $extension_file = $value->getClientOriginalExtension();
                $final_name_file = $filename_img.'_'.time().'.'.$extension_file;
                Storage::putFileAs('public/places/galeri_foto', $value, $final_name_file);
//                $value->move(public_path('uploads/galeri_foto/'), $final_name_file);
                
                $photo->photo_name = $final_name_file;
                $photo->photo_caption = $request->photo_caption[$key];
                $photo->photo_order = $request->photo_order[$key];
                $photo->comp_code = session('comp_code');
                $photo->created_by = session('id');
                $photo->save();
            }
        }
        
        return redirect()->route('admin.photo.index')->with('success', 'Photo is added successfully!');
    }

    public function edit($id)
    {
        $fotoID = Crypt::decrypt($id);
        $photo = PhotosList::findOrFail($fotoID);
        return view('admin.photo.edit', compact('photo'));
    }

    public function update(Request $request, $id)
    {
        $photo = PhotosList::findOrFail($id);
        $data = $request->only($photo->getFillable());
        
        $data['updated_by'] = session('id');

        if($request->hasFile('photo_name')) {
            $request->validate([
                'photo_name' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
            
            $name_file = $request->file('photo_name')->getClientOriginalName();
            $filename_img = pathinfo($name_file, PATHINFO_FILENAME);
            $extension_file = $request->file('photo_name')->getClientOriginalExtension();
            $final_name_file = $filename_img.'_'.time().'.'.$extension_file;
            Storage::putFileAs('public/places/galeri_foto', $request->file('photo_name'), $final_name_file);
//            $request->file('photo_name')->move(public_path('uploads/galeri_foto/'), $final_name_file);

            $data['photo_berita'] = $final_name_file;
        }

        $photo->fill($data)->save();
        return redirect()->route('admin.photo.index')->with('success', 'Photo is updated successfully!');
    }

    public function destroy($id)
    {
        $photo = PhotosList::findOrFail($id);
        
        $data['is_deleted'] = 1;
        $data['deleted_by'] = session('id');
        $data['deleted_at'] = date("Y-m-d H:i:s", strtotime('now'));

        $photo->fill($data)->save();
        unlink(public_path('public/places/galeri_foto/'.$photo->photo_name));
//        $photo->delete();
        return Redirect()->back()->with('success', 'Photo is deleted successfully!');
    }
}
