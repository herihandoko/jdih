<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\Admin\IndexIrh;
use Illuminate\Http\Request;
use DB;

class IndexHukumIrhController extends Controller
{
    public function index()
    {
        $contentList = IndexIrh::where('is_deleted', 0)
                        ->orderby('irh_year', 'desc')
                        ->get();
        
        return view('pages.index_hukum_irh', compact('contentList'));
    }
}