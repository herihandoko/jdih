<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\IndexIkd;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use DB;

class IndexHukumIkdController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $indexIkd = IndexIkd::where('is_deleted', '=', 0)
                            ->orderBy('ikd_year', 'desc')
                            ->get();

        return view('admin.index_hukum.ikd.index', compact('indexIkd'));
    }

    public function create()
    {
        return view('admin.index_hukum.ikd.create');
    }

    public function store(Request $request)
    {
        if(!empty($request->ikd_name)) {
            foreach ($request->ikd_name as $key => $value) {
                $indexIkd = new IndexIkd();
                
                $indexIkd->ikd_name = $request->ikd_name[$key];
                $indexIkd->ikd_year = $request->ikd_year[$key];
                $indexIkd->ikd_score = $request->ikd_score[$key];
                $indexIkd->created_by = session('id');
                
                if ($request->hasFile('ikd_file') && isset($request->file('ikd_file')[$key]) && $request->file('ikd_file')[$key]->isValid()) {
                    $name_file = $request->ikd_file[$key]->getClientOriginalName();
                    $filename_pdf = pathinfo($name_file, PATHINFO_FILENAME);
                    $extension_file = $request->ikd_file[$key]->extension();
                    $final_name_file = $filename_pdf.'_'.time().'.'.$extension_file;
                    Storage::putFileAs('public/places/index_hukum', $request->ikd_file[$key], $final_name_file);
                    
                    $indexIkd->ikd_file = $final_name_file;
                    
                    $indexIkd->ikd_file_view = $request->ikd_file_view[$key];
                }
                $indexIkd->save();
            }
        }
        
        return redirect()->route('admin.index_hukum.ikd.index')->with('success', 'Indeks Hukum IKD is added successfully!');
    }

    public function edit($id)
    {
        $ikdID = Crypt::decrypt($id);
        $indexIkd = IndexIkd::findOrFail($ikdID);
        
        return view('admin.index_hukum.ikd.edit', compact('indexIkd'));
    }

    public function update(Request $request, $id)
    {
        $indexIkd = IndexIkd::findOrFail($id);
        $data = $request->only($indexIkd->getFillable());
        
        $data['updated_by'] = session('id');
        
        if($request->hasFile('ikd_file')) {
            $request->validate([
                'ikd_file' => 'file|mimes:pdf|max:5120'
            ]);
            
            $name_file = $request->file('ikd_file')->getClientOriginalName();
            $filename_file = pathinfo($name_file, PATHINFO_FILENAME);
            $extension_file = $request->file('ikd_file')->extension();
            $final_name_file = $filename_file.'_'.time().'.'.$extension_file;
            Storage::putFileAs('public/places/index_hukum', $request->file('ikd_file'), $final_name_file);

            $data['ikd_file'] = $final_name_file;
        }

        $indexIkd->fill($data)->save();
        return redirect()->route('admin.index_hukum.ikd.index')->with('success', 'Indeks Hukum IKD is updated successfully!');
    }

    public function destroy($id)
    {
        $indexIkd = IndexIkd::findOrFail($id);
        
        $data['is_deleted'] = 1;
        $data['deleted_by'] = session('id');
        $data['deleted_at'] = date("Y-m-d H:i:s", strtotime('now'));

        $indexIkd->fill($data)->save();
        return Redirect()->back()->with('success', 'Indeks Hukum IKD is deleted successfully!');
    }
}