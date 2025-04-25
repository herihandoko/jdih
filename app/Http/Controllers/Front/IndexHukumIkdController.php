<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\Admin\IndexIkd;
use Illuminate\Http\Request;
use DB;

class IndexHukumIkdController extends Controller
{
    public function index()
    {
        $contentList = IndexIkd::where('is_deleted', 0)
                        ->orderby('ikd_year', 'desc')
                        ->get();
        
        return view('pages.index_hukum_ikd', compact('contentList'));
    }
}