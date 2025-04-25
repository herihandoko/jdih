<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\Admin\Videos;
use Illuminate\Http\Request;
use DB;

class VideoGalleryController extends Controller
{
    public function index()
    {
        $contentList = Videos::where('publish', 1)
                        ->where('is_deleted', 0)
                        ->orderby('created_at', 'desc')
                        ->paginate(9);
        
        return view('pages.video_gallery', compact('contentList'));
    }
}