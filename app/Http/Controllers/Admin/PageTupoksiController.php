<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\PageTupoksiItem;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use DB;

class PageTupoksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $page_tupoksi_val = PageTupoksiItem::where('id', 1)->first();

        if($page_tupoksi_val == null) {
            $page_tupoksi = 0;
        } else {
            $page_tupoksi = $page_tupoksi_val;
        }

        return view('admin.web_setting.page_tupoksi', compact('page_tupoksi'));
    }

    public function store(Request $request)
    {
        $pageTupoksi = new PageTupoksiItem();
        $data = $request->only($pageTupoksi->getFillable());

        $request->validate([
            'name' => 'required'
        ]);

        if($request->hasFile('picture')) {
            $request->validate([
                'picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $extPicture = $request->file('picture')->extension();
            $final_name_picture = 'tupoksi-picture.'.$extPicture;
            Storage::putFileAs('public/places', $request->file('picture'), $final_name_picture);
//            $request->file('picture')->move(public_path('uploads/'), $final_name_picture);
            $data['picture'] = $final_name_picture;
        }

        if($request->hasFile('banner')) {
            $request->validate([
                'banner' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            $extBanner = $request->file('banner')->extension();
            $final_name_banner = 'tupoksi-banner.'.$extBanner;
            Storage::putFileAs('public/places', $request->file('banner'), $final_name_banner);
//            $request->file('banner')->move(public_path('uploads/'), $final_name_banner);
            $data['banner'] = $final_name_banner;
        }

        $data['created_by'] = session('id');

        $pageTupoksi->fill($data)->save();
        return redirect()->route('admin.web_setting.page_tupoksi')->with('success', 'Tupoksi is added successfully!');
    }

    public function update(Request $request)
    {

        if($request->hasFile('picture')) {
            $request->validate([
                'picture' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
            unlink(public_path('storage/places/'.$request->current_picture));
            $ext = $request->file('picture')->extension();
            $final_name = 'tupoksi-picture.'.$ext;
            Storage::putFileAs('public/places', $request->file('picture'), $final_name);
//            $request->file('picture')->move(public_path('uploads/'), $final_name);
            $data['picture'] = $final_name;
        } else {
            $data['picture'] = $request->current_picture;
        }

        if($request->hasFile('banner')) {
            $request->validate([
                'banner' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
            unlink(public_path('storage/places/'.$request->current_banner));
            $ext = $request->file('banner')->extension();
            $final_name = 'tupoksi-banner.'.$ext;
            Storage::putFileAs('public/places', $request->file('banner'), $final_name);
//            $request->file('banner')->move(public_path('uploads/'), $final_name);
            $data['banner'] = $final_name;
        } else {
            $data['banner'] = $request->current_banner;
        }

        $data['name'] = $request->input('name');
        $data['content'] = $request->input('content');
        $data['seo_title'] = $request->input('seo_title');
        $data['seo_meta_description'] = $request->input('seo_meta_description');
        $data['updated_by'] = session('id');

        PageTupoksiItem::where('id', 1)->update($data);

        return redirect()->back()->with('success', 'Tupoksi is updated successfully!');

    }
}