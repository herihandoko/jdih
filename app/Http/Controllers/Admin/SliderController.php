<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use DB;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $slider = Slider::orderBy('created_at', 'desc')->get();
        return view('admin.slider.index', compact('slider'));
    }

    public function create()
    {
        return view('admin.slider.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'slider_photo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ],
        [
            'slider_photo.required' => 'Slider Photo tidak boleh kosong.',
            'slider_photo.mimes' => 'Jenis Slider Photo tidak diijinkan',
            'slider_photo.max' => 'Maksimal Slider Photo 2MB.',
        ]
        );

        $statement = DB::select("SHOW TABLE STATUS LIKE 'sliders'");
        $ai_id = $statement[0]->Auto_increment;

        $ext = $request->file('slider_photo')->extension();
        $final_name = 'slider-'.$ai_id.'.'.$ext;
        Storage::putFileAs('public/places', $request->file('slider_photo'), $final_name);
//        $request->file('slider_photo')->move(public_path('uploads'), $final_name);

        $slider = new Slider();
        $data = $request->only($slider->getFillable());

        unset($data['slider_photo']);
        $data['slider_photo'] = $final_name;

        $slider->fill($data)->save();

        return redirect()->route('admin.slider.index')->with('success', 'Slider is added successfully!');
    }

    public function edit($id)
    {
        $slider = Slider::findOrFail($id);
        return view('admin.slider.edit', compact('slider'));
    }

    public function update(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);
        $data = $request->only($slider->getFillable());

        if ($request->hasFile('slider_photo')) {

            $request->validate([
                'slider_photo' => 'image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            unlink(public_path('storage/places/'.$slider->slider_photo));

            // Uploading the file
            $ext = $request->file('slider_photo')->extension();
            $final_name = 'slider-'.$id.'.'.$ext;
            Storage::putFileAs('public/places', $request->file('slider_photo'), $final_name);
//            $request->file('slider_photo')->move(public_path('uploads/'), $final_name);

            unset($data['slider_photo']);
            $data['slider_photo'] = $final_name;
        }

        $slider->fill($data)->save();

        return redirect()->route('admin.slider.index')->with('success', 'Slider is updated successfully!');
    }

    public function destroy($id)
    {
        $slider = Slider::findOrFail($id);
        unlink(public_path('storage/places/'.$slider->slider_photo));
        $slider->delete();

        // Success Message and redirect
        return Redirect()->back()->with('success', 'Slider is deleted successfully!');
    }

}
