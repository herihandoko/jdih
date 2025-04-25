<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\Admin\IndexIkk;
use Illuminate\Http\Request;
use DB;

class IndexHukumIkkController extends Controller
{
    public function index()
    {
        $contentList = IndexIkk::where('is_deleted', 0)
                        ->orderby('ikk_year', 'desc')
                        ->get();
        
        return view('pages.index_hukum_ikk', compact('contentList'));
    }
}