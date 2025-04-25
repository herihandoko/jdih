<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\Admin\LbhList;
use Illuminate\Http\Request;
use DB;

class DaftarLbhController extends Controller
{
    public function index(Request $request)
    {   
        $query = LbhList::query();

        if ($request->has('sort')) {
            switch ($request->input('sort')) {
                case 'name':
                    $query->orderBy('lbh_name', 'asc');
                    break;
                case 'address':
                    $query->orderBy('lbh_address', 'asc');
                    break;
                case 'accreditation':
                    $query->orderBy('lbh_accreditation', 'asc');
                    break;
                default:
                    break;
            }
        }

        $contentList = $query->where('publish', 1)
                        ->where('is_deleted', 0)
                        ->orderby('created_at', 'desc')
                        ->paginate(9);
        
        return view('pages.daftar_lbh', compact('contentList'));
    }
}