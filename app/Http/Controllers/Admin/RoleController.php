<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use App\Models\Admin\Role;
use App\Models\Admin\Role_permission;
use App\Models\Admin\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use DB;
use Hash;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function user()
    {
        $admin_users = DB::table('admins')
            ->join('roles', 'admins.role_id', '=', 'roles.id')
            ->leftJoin('companies', 'admins.comp_code', '=', 'companies.comp_code')
            ->select('admins.*', 'roles.role_name', 'companies.comp_name')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('admin.role.user', compact('admin_users'));
    }

    public function user_create()
    {
        $roles = Role::all();
        $company = Company::all();
        return view('admin.role.user_create', compact('roles', 'company'));
    }

    public function user_store(Request $request)
    {
        $admin = new Admin();
        $data = $request->only($admin->getFillable());

        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|unique:admins',
                'password' => 'required',
                're_password' => 'required|same:password'
            ],
            [
                'email.unique' => 'Alamat Email sudah ada. Silakan input Alamat Email lainnya.'
            ],
            [
                'name' => 'Name',
                'email' => 'Email',
                'password' => 'Password',
                're_password' => 'Retype Password'
            ]
        );

        $data['password'] = Hash::make($request->password);
        $data['token'] = '';
        $data['created_by'] = session('id');
        
        if($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ],
            [
                'photo.mimes' => 'Foto tidak diijinkan'
            ]);
            
            $statement = DB::select("SHOW TABLE STATUS LIKE 'admins'");
            $ai_id = $statement[0]->Auto_increment;
            $ext = $request->file('photo')->extension();
            $final_name = 'user-'.$ai_id.'.'.$ext;
            Storage::putFileAs('public/places', $request->file('photo'), $final_name);
//            $request->file('photo')->move(public_path('uploads/'), $final_name);
            
            $data['photo'] = $final_name;
        } else {
            $data['photo'] = "";
        }

        $admin->fill($data)->save();
        return redirect()->route('admin.role.user')->with('success', 'Admin User is added successfully!');
    }


    public function user_edit($id)
    {
        $roles = Role::all();
        $company = Company::all();
        $admin_user = Admin::findOrFail($id);
        return view('admin.role.user_edit', compact('admin_user','roles', 'company'));
    }

    public function user_update(Request $request, $id)
    {
        $admin = Admin::findOrFail($id);
        $data = $request->only($admin->getFillable());

        if($request->hasFile('photo')) {
            $request->validate([
                'name'   =>  [
                    'required'
                ],
                'email'   =>  [
                    Rule::unique('admins')->ignore($id),
                ],
                'photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            unlink(public_path('storage/places/'.$admin->photo));
            $ext = $request->file('photo')->extension();
            $final_name = 'user-'.$id.'.'.$ext;
            Storage::putFileAs('public/places', $request->file('photo'), $final_name);
//            $request->file('photo')->move(public_path('uploads/'), $final_name);
            $data['photo'] = $final_name;
        } else {
            $request->validate([
                'name'   =>  [
                    'required'
                ],
                'email'   =>  [
                    Rule::unique('admins')->ignore($id),
                ]
            ]);
            $data['photo'] = $admin->photo;
        }

        $data['updated_by'] = session('id');

        $admin->fill($data)->save();
        return redirect()->route('admin.role.user')->with('success', 'Admin User is updated successfully!');
    }

    public function user_edit_password($id)
    {
        $admin_user = Admin::findOrFail($id);
        return view('admin.role.user_edit_password', compact('admin_user'));
    }

    public function user_update_password(Request $request, $id)
    {
        $request->validate([
            'password' => 'required',
            're_password' => 'required|same:password',
        ]);

        $data['password'] = Hash::make($request->password);
        Admin::where('id',$id)->update($data);

        return redirect()->route('admin.role.user')->with('success', 'Admin User Password is updated successfully!');
    }

    public function user_destroy($id)
    {
        $admin = Admin::findOrFail($id);
        unlink(public_path('storage/places/'.$admin->photo));
        $admin->delete();
        return Redirect()->back()->with('success', 'Admin User is deleted successfully!');
    }

    public function index()
    {
        $roles = Role::all();
        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function store(Request $request)
    {
        $role = new Role();
        $data = $request->only($role->getFillable());

        $request->validate([
            'role_name' => 'required|unique:roles'
        ]);

        $statement = DB::select("SHOW TABLE STATUS LIKE 'roles'");
        $ai_id = $statement[0]->Auto_increment;

        $role->fill($data)->save();

        $role_pages_data = DB::table('role_pages')->get();
        foreach($role_pages_data as $row)
        {
            echo $row->id;
            DB::table('role_permissions')->insert([
                'role_id' => $ai_id,
                'role_page_id' => $row->id,
                'access_status' => 0
            ]);
        }
        return redirect()->route('admin.role.index')->with('success', 'Role is added successfully!');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return view('admin.role.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
        $data = $request->only($role->getFillable());

        $request->validate([
            'role_name'   =>  [
                'required',
                Rule::unique('roles')->ignore($id),
            ]
        ]);

        $role->fill($data)->save();
        return redirect()->route('admin.role.index')->with('success', 'Role is updated successfully!');
    }

    public function access_setup($id)
    {
        $role = Role::findOrFail($id);

        $role_permissions = DB::table('role_permissions')
            ->where('role_id',$id)
            ->get();

        return view('admin.role.access_setup', compact('role','role_permissions'));
    }

    public function access_setup_update(Request $request, $id)
    {

        foreach($request->role_permission_ids as $val)
        {
            $arr1[] = $val;
        }

        foreach($request->access_status_arr as $val)
        {
            $arr2[] = $val;
        }

        for($i=0;$i<count($arr1);$i++)
        {
            //Role_permission::where('id',$arr1[$i])->update(['access_status'=>$arr2[$i]]);
            DB::table('role_permissions')
                ->where('id', $arr1[$i])
                ->update(['access_status' => $arr2[$i]]);
        }

        return redirect()->route('admin.role.index')->with('success', 'Access Setup is updated successfully!');
    }

    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $check_admin = DB::table('admins')
            ->where('role_id', $role->id)
            ->first();
        if($check_admin) {
            return Redirect()->back()->with('error', 'You can not delete this role, because there is user under this role.');
        }
        else {
            // Delete the role
            DB::table('roles')->where('id', '=', $id)->delete();
            DB::table('role_permissions')->where('role_id', '=', $id)->delete();
            return Redirect()->back()->with('success', 'Role is deleted successfully!');
        }

    }
}
