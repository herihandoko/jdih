<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use DB;

class CompanyController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $company = Company::orderBy('comp_code', 'asc')->get();
        return view('admin.company.index', compact('company'));
    }

    public function create()
    {
        $orderStmt = DB::select("SHOW TABLE STATUS LIKE 'companies'");
        $nextPrimaryKeyId = $orderStmt[0]->Auto_increment;
        $nextPrimaryKeyIds = str_pad($nextPrimaryKeyId, 4, 0, STR_PAD_LEFT);
        return view('admin.company.create', compact('nextPrimaryKeyIds'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'comp_name' => 'required'
        ]);

        $company = new Company();
        $data = $request->only($company->getFillable());

        $data['created_by'] = session('id');

        $company->fill($data)->save();
        return redirect()->route('admin.company.index')->with('success', 'Dinas is added successfully!');
    }

     public function edit($id)
    {
        $company = Company::findOrFail($id);
        return view('admin.company.edit', compact('company'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'comp_name'   =>  [
                'required',
            ]
        ]);

        $company = Company::findOrFail($id);
        $data = $request->only($company->getFillable());

        $data['updated_by'] = session('id');

        $company->fill($data)->save();
        return redirect()->route('admin.company.index')->with('success', 'Dinas is updated successfully!');
    }
    
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $check_admin = DB::table('admins')
            ->where('comp_code', $company->comp_code)
            ->first();
        if($check_admin) {
            return Redirect()->back()->with('error', 'Anda tidak dapat menghapus Dinas ini, karena ada user di bawah Dinas ini.');
        }
        else {
            // Delete the company
            DB::table('companies')->where('id', '=', $id)->delete();
            return Redirect()->back()->with('success', 'Dinas is deleted successfully!');
        }

    }
}