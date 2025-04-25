<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\PageSopItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use DB;

class PageSopController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $page_sop_val = PageSopItem::where('id', 1)->first();

        if($page_sop_val == null) {
            $page_sop = 0;
        } else {
            $page_sop = $page_sop_val;
        }

        return view('admin.web_setting.page_sop', compact('page_sop'));
    }

    public function store(Request $request)
    {
        $pageSop = new PageSopItem();
        $data = $request->only($pageSop->getFillable());

        if($request->hasFile('file')) {
            $request->validate([
                'file' => 'required|mimes:pdf|max:256000'
                    ],
                    ['file.mimes' => 'Jenis/Ukuran File tidak diijinkan']
            );

            $extFile = $request->file('file')->extension();
            $final_name_file = 'sop-file.'.$extFile;
            Storage::putFileAs('public/places/sop', $request->file('file'), $final_name_file);
            $data['file'] = $final_name_file;
        }

        $data['created_by'] = session('id');

        $pageSop->fill($data)->save();
        return redirect()->route('admin.web_setting.page_sop')->with('success', 'SOP is added successfully!');
    }

    public function update(Request $request)
    {
        if($request->hasFile('file')) {
            $request->validate([
                'file' => 'required|mimes:pdf,zip|max:256000'
                    ],
                    ['file.mimes' => 'Jenis/Ukuran File tidak diijinkan']
            );
            
            $name_file = $request->file('file')->getClientOriginalName();
            $filename_file = pathinfo($name_file, PATHINFO_FILENAME);
            $extension_file = $request->file('file')->extension();
            $final_name_file = $filename_file . '_' . time() . '.' . $extension_file;
            Storage::putFileAs('public/places/sop', $request->file('file'), $final_name_file);

            $data['file'] = $final_name_file;
        } else {
            $data['file'] = $request->current_file;
        }
        
        $data['content'] = $request->input('content');
        $data['updated_by'] = session('id');

        PageSopItem::where('id', 1)->update($data);

        return redirect()->back()->with('success', 'SOP is updated successfully!');

    }
}