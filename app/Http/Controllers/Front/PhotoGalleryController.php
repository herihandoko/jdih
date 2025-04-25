<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\Admin\PhotosList;
use Illuminate\Http\Request;
use DB;

class PhotoGalleryController extends Controller
{
    public function index()
    {
        $contentList = PhotosList::where('is_deleted', 0)
                    ->orderby('created_at', 'desc')
                    ->paginate(9);
        
        return view('pages.photo_gallery', compact('contentList'));
    }
}
