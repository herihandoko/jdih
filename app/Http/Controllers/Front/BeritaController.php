<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\Admin\BeritaList;
use Illuminate\Http\Request;
use DB;

class BeritaController extends Controller
{
    public function index()
    {
        $contentList = BeritaList::join('admins', 'berita_lists.created_by', '=', 'admins.id')
                        ->where('berita_lists.is_deleted', 0)
                        ->where('berita_lists.publish', 1)
                        ->orderby('berita_lists.created_at', 'desc')
                        ->paginate(10);
        
        return view('pages.berita', compact('contentList'));
    }
}