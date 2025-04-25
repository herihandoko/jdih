<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\IndexIrh;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use DB;

class IndexHukumIrhController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $indexIrh = IndexIrh::where('is_deleted', '=', 0)
                            ->orderBy('irh_year', 'desc')
                            ->get();

        return view('admin.index_hukum.irh.index', compact('indexIrh'));
    }

    public function create()
    {
        return view('admin.index_hukum.irh.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            "irh_file[]" => "file|array|mimes:pdf|max:5120",
            "irh_file.*[]" => "file|mimes:pdf|max:5120",
        ]);
        
        if(!empty($request->irh_name)) {
            foreach ($request->irh_name as $key => $value) {
                $indexIrh = new IndexIrh();
                
                $indexIrh->irh_name = $request->irh_name[$key];
                $indexIrh->irh_year = $request->irh_year[$key];
                $indexIrh->irh_score = $request->irh_score[$key];
                $indexIrh->created_by = session('id');
                
                if ($request->hasFile('irh_file') && isset($request->file('irh_file')[$key]) && $request->file('irh_file')[$key]->isValid()) {
                    $name_file = $request->irh_file[$key]->getClientOriginalName();
                    $filename_pdf = pathinfo($name_file, PATHINFO_FILENAME);
                    $extension_file = $request->irh_file[$key]->extension();
                    $final_name_file = $filename_pdf.'_'.time().'.'.$extension_file;
                    Storage::putFileAs('public/places/index_hukum', $request->irh_file[$key], $final_name_file);
                    
                    $indexIrh->irh_file = $final_name_file;
                    
                    $indexIrh->irh_file_view = $request->irh_file_view[$key];
                }
                $indexIrh->save();
            }
        }
        
        return redirect()->route('admin.index_hukum.irh.index')->with('success', 'Indeks Hukum IRH is added successfully!');
    }

    public function edit($id)
    {
        $irhID = Crypt::decrypt($id);
        $indexIrh = IndexIrh::findOrFail($irhID);
        
        return view('admin.index_hukum.irh.edit', compact('indexIrh'));
    }

    public function update(Request $request, $id)
    {
        $indexIrh = IndexIrh::findOrFail($id);
        $data = $request->only($indexIrh->getFillable());
        
        $data['updated_by'] = session('id');
        
        if($request->hasFile('irh_file')) {
            $request->validate([
                'irh_file' => 'file|mimes:pdf|max:5120'
            ]);
            
            $name_file = $request->file('irh_file')->getClientOriginalName();
            $filename_file = pathinfo($name_file, PATHINFO_FILENAME);
            $extension_file = $request->file('irh_file')->extension();
            $final_name_file = $filename_file.'_'.time().'.'.$extension_file;
            Storage::putFileAs('public/places/index_hukum', $request->file('irh_file'), $final_name_file);

            $data['irh_file'] = $final_name_file;
        }

        $indexIrh->fill($data)->save();
        return redirect()->route('admin.index_hukum.irh.index')->with('success', 'Indeks Hukum IRH is updated successfully!');
    }

    public function destroy($id)
    {
        $indexIrh = IndexIrh::findOrFail($id);
        
        $data['is_deleted'] = 1;
        $data['deleted_by'] = session('id');
        $data['deleted_at'] = date("Y-m-d H:i:s", strtotime('now'));

        $indexIrh->fill($data)->save();
        return Redirect()->back()->with('success', 'Indeks Hukum IRH is deleted successfully!');
    }
}