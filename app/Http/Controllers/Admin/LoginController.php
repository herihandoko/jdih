<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Hash;

class LoginController extends Controller
{
	public function __construct()
    {
    	$this->middleware(function ($request, $next) {
			if($request->session()->has('admin')) {
				return redirect()->route('admin.dashboard');
			}
			return $next($request);
		});
    }

    public function index()
    {
    	return view('admin.auth.login');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        $check_login = Admin::where('username',$request->username)->first();
        if(!$check_login)
        {
        	return redirect()->back()->with('error', 'Username tidak ditemukan');
        }
        else
        {
        	$saved_password = $check_login->password;
        	$given_password = $request->password;

        	if(\Hash::check($given_password,$saved_password) == false)
        	{
        		return redirect()->back()->with('error', 'Password salah');
        	}
        }

        // Saving data into session
        session(['role' => 'admin']);
        session(['id' => $check_login->id]);
        session(['name' => $check_login->name]);
        session(['username' => $check_login->username]);
        session(['email' => $check_login->email]);
        session(['photo' => $check_login->photo]);
        session(['role_id' => $check_login->role_id]);
        session(['comp_code' => $check_login->comp_code]);

        $adminUpdate = Admin::findOrFail($check_login->id);
        $data['last_login_at'] = Carbon::now()->toDateTimeString();
        $data['last_login_ip'] = $request->ip();

        $adminUpdate->fill($data)->save();

        return redirect()->route('admin.dashboard');
    }
}
