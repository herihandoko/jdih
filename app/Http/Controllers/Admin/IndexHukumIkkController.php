<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\IndexIkk;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use DB;

class IndexHukumIkkController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $indexIkk = IndexIkk::where('is_deleted', '=', 0)
                            ->orderBy('ikk_year', 'desc')
                            ->get();

        return view('admin.index_hukum.ikk.index', compact('indexIkk'));
    }

    public function create()
    {
        return view('admin.index_hukum.ikk.create');
    }

    public function store(Request $request)
    {
        if(!empty($request->ikk_name)) {
            foreach ($request->ikk_name as $key => $value) {
                $indexIkk = new IndexIkk();
                
                $indexIkk->ikk_name = $request->ikk_name[$key];
                $indexIkk->ikk_year = $request->ikk_year[$key];
                $indexIkk->ikk_score = $request->ikk_score[$key];
                $indexIkk->created_by = session('id');
                
                if ($request->hasFile('ikk_file') && isset($request->file('ikk_file')[$key]) && $request->file('ikk_file')[$key]->isValid()) {
                    $name_file = $request->ikk_file[$key]->getClientOriginalName();
                    $filename_pdf = pathinfo($name_file, PATHINFO_FILENAME);
                    $extension_file = $request->ikk_file[$key]->extension();
                    $final_name_file = $filename_pdf.'_'.time().'.'.$extension_file;
                    Storage::putFileAs('public/places/index_hukum', $request->ikk_file[$key], $final_name_file);
                    
                    $indexIkk->ikk_file = $final_name_file;
                    
                    $indexIkk->ikk_file_view = $request->ikk_file_view[$key];
                }
                $indexIkk->save();
            }
        }
        
        return redirect()->route('admin.index_hukum.ikk.index')->with('success', 'Indeks Hukum IKK is added successfully!');
    }

    public function edit($id)
    {
        $ikkID = Crypt::decrypt($id);
        $indexIkk = IndexIkk::findOrFail($ikkID);
        
        return view('admin.index_hukum.ikk.edit', compact('indexIkk'));
    }

    public function update(Request $request, $id)
    {
        $indexIkk = IndexIkk::findOrFail($id);
        $data = $request->only($indexIkk->getFillable());
        
        $data['updated_by'] = session('id');
        
        if($request->hasFile('ikk_file')) {
            $request->validate([
                'ikk_file' => 'file|mimes:pdf|max:5120'
            ]);
            
            $name_file = $request->file('ikk_file')->getClientOriginalName();
            $filename_file = pathinfo($name_file, PATHINFO_FILENAME);
            $extension_file = $request->file('ikk_file')->extension();
            $final_name_file = $filename_file.'_'.time().'.'.$extension_file;
            Storage::putFileAs('public/places/index_hukum', $request->file('ikk_file'), $final_name_file);

            $data['ikk_file'] = $final_name_file;
        }

        $indexIkk->fill($data)->save();
        return redirect()->route('admin.index_hukum.ikk.index')->with('success', 'Indeks Hukum IKK is updated successfully!');
    }

    public function destroy($id)
    {
        $indexIkk = IndexIkk::findOrFail($id);
        
        $data['is_deleted'] = 1;
        $data['deleted_by'] = session('id');
        $data['deleted_at'] = date("Y-m-d H:i:s", strtotime('now'));

        $indexIkk->fill($data)->save();
        return Redirect()->back()->with('success', 'Indeks Hukum IKK is deleted successfully!');
    }
}