<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use DB;

class PageManageController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $pages = Page::orderBy('created_at', 'desc')->get();
        
        return view('admin.page.index', compact('pages'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'page_name' => 'required|unique:pages',
            'page_view' => 'required|unique:pages'
        ],
        [
            'page_name.required' => 'Page Name harus diisi.',
            'page_name.unique' => 'Page Name sudah ada. Silakan input Page Name lainnya.',
            'page_view.required' => 'Page View harus diisi.',
            'page_view.unique' => 'Page View sudah ada. Silakan input Page View lainnya.'
        ]);
        
        $pageCreate = new Page();
        $data = $request->only($pageCreate->getFillable());

        $pageCreate->fill($data)->save();
        
        return response()->json(['code'=>200, 'message'=>'Created page successfully','data' => $data], 200);
    }

    public function update(Request $request)
    {

        $i=0;
        foreach(request('page_id') as $value)
        {
            $arr1[$i] = $value;
            $i++;
        }
        
        $i=0;
        foreach(request('page_name') as $value)
        {
            $arr2[$i] = $value;
            $i++;
        }
        
        $i=0;
        foreach(request('page_view') as $value)
        {
            $arr3[$i] = $value;
            $i++;
        }

        for($i=0; $i<count($arr1); $i++)
        {
            $data = array();
            $data['page_name'] = $arr2[$i];
            $data['page_view'] = $arr3[$i];
            
            DB::table('pages')->where('id', $arr1[$i])->update($data);
        }
        
        return redirect()->route('admin.page.index')->with('success', 'Page is updated successfully!');
    }
}