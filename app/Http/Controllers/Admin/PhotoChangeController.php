<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use DB;

class PhotoChangeController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $admin_data = Admin::where('id',session('id'))->first();
        return view('admin.auth.photo_change', compact('admin_data'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // Unlink old photo
        // unlink(public_path('uploads/'.$request->current_photo));
        
        $admin_data = Admin::where('id',session('id'))->first();           
        $user_photo = explode('-', $request->current_photo);

        $id_user = explode('.', $user_photo[1]);// Uploading new photo
        if($admin_data->id == $id_user[0]){
            $ext = $request->file('photo')->extension();
            $final_name = 'user-'.session('id').'.'.$ext;
            Storage::putFileAs('public/places', $request->file('photo'), $final_name);
//            $request->file('photo')->move(public_path('uploads/'), $final_name);

            $data['photo'] = $final_name;

            Admin::where('id',session('id'))->update($data);

            session(['photo' => $final_name]);

            return redirect()->back()->with('success', 'Photo is updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Photo failed updated!');
        }
    }

}
