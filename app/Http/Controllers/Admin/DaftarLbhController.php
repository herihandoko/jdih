<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\LbhList;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use DB;

class DaftarLbhController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        if(session('comp_code') == null) {
            $compcode = '';
            $lbhList = LbhList::leftJoin('companies', 'lbh_lists.comp_code', '=', 'companies.comp_code')
                                ->join('admins', 'lbh_lists.created_by', '=', 'admins.id')
                                ->where('lbh_lists.is_deleted', '=', 0)
                                ->orderBy('lbh_lists.created_at', 'desc')
                                ->get(['lbh_lists.*', 'companies.comp_name', 'admins.name']);
            return view('admin.daftar_lbh.index', compact('lbhList', 'compcode'));
        } else {
            $compcode = session('comp_code');
            $lbhList = LbhList::join('admins', 'lbh_lists.created_by', '=', 'admins.id')
                                ->where('lbh_lists.comp_code', session('comp_code'))
                                ->where('lbh_lists.is_deleted', '=', 0)
                                ->orderBy('lbh_lists.created_at', 'desc')
                                ->get(['lbh_lists.*', 'admins.name']);
            
            return view('admin.daftar_lbh.index', compact('lbhList', 'compcode'));
        }
    }

    public function create()
    {
        return view('admin.daftar_lbh.create');
    }

    public function store(Request $request)
    {
        if(!empty($request->lbh_name)) {
            foreach ($request->lbh_name as $key => $value) {
                $lbhList = new LbhList();
                
                $lbhList->lbh_name = $request->lbh_name[$key];
                $lbhList->lbh_address = $request->lbh_address[$key];
                $lbhList->lbh_desc = $request->lbh_desc[$key];
                $lbhList->lbh_phone = $request->lbh_phone[$key];
                $lbhList->lbh_accreditation = $request->lbh_accreditation[$key];
                $lbhList->lbh_order = $request->lbh_order[$key];
                $lbhList->publish = 0;
                $lbhList->comp_code = session('comp_code');
                $lbhList->created_by = session('id');
                $lbhList->save();
            }
        }
        
        return redirect()->route('admin.daftar_lbh.index')->with('success', 'Daftar LBH is added successfully!');
    }

    public function edit($id)
    {
        $lbhID = Crypt::decrypt($id);
        $lbhList = LbhList::findOrFail($lbhID);
        
        return view('admin.daftar_lbh.edit', compact('lbhList'));
    }

    public function update(Request $request, $id)
    {
        $lbhList = LbhList::findOrFail($id);
        $data = $request->only($lbhList->getFillable());
        
        $data['publish'] = $request->lbh_status;
        
        if($request->lbh_status == 1) {
            $data['publish_at'] = date("Y-m-d H:i:s", strtotime('now'));
        }
        
        $data['updated_by'] = session('id');

        $lbhList->fill($data)->save();
        return redirect()->route('admin.daftar_lbh.index')->with('success', 'Daftar LBH is updated successfully!');
    }

    public function destroy($id)
    {
        $lbhList = LbhList::findOrFail($id);
        
        $data['is_deleted'] = 1;
        $data['deleted_by'] = session('id');
        $data['deleted_at'] = date("Y-m-d H:i:s", strtotime('now'));

        $lbhList->fill($data)->save();
        return Redirect()->back()->with('success', 'Daftar LBH is deleted successfully!');
    }
}