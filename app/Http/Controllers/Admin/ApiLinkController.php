<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ApiLink;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use DB;

class ApiLinkController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $apiLink = ApiLink::orderBy('created_at', 'desc')->get();
        
        return view('admin.apilink.index', compact('apiLink'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'api_name' => 'required|unique:api_links',
            'api_url' => 'required|url',
            'api_active' => 'required|boolean',
        ],
        [
            'api_name.required' => 'API Name harus diisi.',
            'api_name.unique' => 'API Name sudah ada. Silakan input API Name lainnya.',
            'api_url.required' => 'API URL harus diisi.',
            'api_url.url' => 'API URL belum sesuai.',
            'api_active.required' => 'Status harus dipilih.',
        ]);
        
        $apiCreate = new ApiLink();
        $apiCreate->api_name = $request->api_name;
        $apiCreate->api_url = $request->api_url;
        $apiCreate->api_active = $request->api_active;
        $apiCreate->created_by = session('id');
        
        $apiCreate->save();
        
        return response()->json(['code'=>200, 'message'=>'Created API List successfully','data' => $apiCreate], 200);
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'api_id.*' => 'required|exists:api_links,id',
            'api_name.*' => 'required',
            'api_url.*' => 'required|url',
            'api_active.*' => 'required|boolean',
        ]);
        
        foreach ($validatedData['api_id'] as $index => $id) {
            $apiLink = ApiLink::find($id);

            $uniqueNameCheck = ApiLink::where('api_name', $validatedData['api_name'][$index])
                ->where('id', '!=', $id)
                ->exists();

            if ($uniqueNameCheck) {
                return redirect()->back()->withErrors(['api_name' => 'API Name sudah ada. Silakan input API Name lainnya.']);
            }

            $apiLink->api_name = $validatedData['api_name'][$index];
            $apiLink->api_url = $validatedData['api_url'][$index];
            $apiLink->api_active = $validatedData['api_active'][$index];
            
            $apiLink->updated_by = session('id');
            $apiLink->save();
        }
        
        return redirect()->route('admin.apilink.index')->with('success', 'API List is updated successfully!');
    }
}