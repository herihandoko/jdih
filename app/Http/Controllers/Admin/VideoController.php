<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Videos;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use DB;

class VideoController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        if(session('comp_code') == null) {
            $compcode = '';
            $videosList = Videos::leftJoin('companies', 'videos.comp_code', '=', 'companies.comp_code')
                                ->join('admins', 'videos.created_by', '=', 'admins.id')
                                ->where('videos.is_deleted', '=', 0)
                                ->orderBy('videos.created_at', 'desc')
                                ->get(['videos.*', 'companies.comp_name', 'admins.name']);
            return view('admin.video.index', compact('videosList', 'compcode'));
        } else {
            $compcode = session('comp_code');
            $videosList = Videos::join('admins', 'videos.created_by', '=', 'admins.id')
                                ->where('videos.comp_code', session('comp_code'))
                                ->where('videos.is_deleted', '=', 0)
                                ->orderBy('videos.created_at', 'desc')
                                ->get(['videos.*', 'admins.name']);
            
            return view('admin.video.index', compact('videosList', 'compcode'));
        }
    }

    public function create()
    {
        return view('admin.video.create');
    }

    public function store(Request $request)
    {
        if(!empty($request->video_youtube)) {
            foreach ($request->video_youtube as $key => $value) {
                $video = new Videos();
                
                $video->video_youtube = $request->video_youtube[$key];
                $video->video_caption = $request->video_caption[$key];
                $video->video_order = $request->video_order[$key];
                $video->publish = 0;
                $video->comp_code = session('comp_code');
                $video->created_by = session('id');
                $video->save();
            }
        }
        
        return redirect()->route('admin.video.index')->with('success', 'Video is added successfully!');
    }

    public function edit($id)
    {
        $videoID = Crypt::decrypt($id);
        $video = Videos::findOrFail($videoID);
        return view('admin.video.edit', compact('video'));
    }

    public function update(Request $request, $id)
    {
        $video = Videos::findOrFail($id);
        $data = $request->only($video->getFillable());
        
        $data['publish'] = $request->video_status;
        
        if($request->video_status == 1) {
            $data['publish_at'] = date("Y-m-d H:i:s", strtotime('now'));
        }
        
        $data['updated_by'] = session('id');

        $video->fill($data)->save();
        return redirect()->route('admin.video.index')->with('success', 'Video is updated successfully!');
    }

    public function destroy($id)
    {
        $video = Videos::findOrFail($id);
        
        $data['is_deleted'] = 1;
        $data['deleted_by'] = session('id');
        $data['deleted_at'] = date("Y-m-d H:i:s", strtotime('now'));

        $video->fill($data)->save();
        return Redirect()->back()->with('success', 'Video is deleted successfully!');
    }
}