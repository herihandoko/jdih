<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\Admin\LayananHukumBimtekHibrid;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class BimtekHibridController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        $data = LayananHukumBimtekHibrid::with('material')->orderby('bimtek_start_date', 'desc');
        
        if($search) {
            $data->where('bimtek_number', 'like', "%$search%")
                    ->orWhere('bimtek_name', 'like', "%$search%")
                    ->orWhere('bimtek_desc', 'like', "%$search%")
                    ->orWhere('bimtek_start_date', 'like', "%$search%")
                    ->orWhere('bimtek_end_date', 'like', "%$search%");
        }
        
        $contentList = $data->paginate(6);
        $contentList->appends(['search' => $search]);
        
        $currentDate = Carbon::now();
        $currentDateFormat = $currentDate->format('Y-m-d');
        
        $realData = LayananHukumBimtekHibrid::get();
        
        return view('pages.bimtek_hibrid', compact('contentList', 'currentDateFormat', 'realData'));
    }
}