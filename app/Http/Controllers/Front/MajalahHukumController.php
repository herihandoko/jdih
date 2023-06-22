<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Admin\MajalahHukumList;
use DB;

class MajalahHukumController extends Controller
{
    public function index()
    {
        $majalahHukumList = MajalahHukumList::orderby('created_at', 'desc')
                        ->paginate(10);

        $tahun = MajalahHukumList::groupBy('tahun_majalah')->pluck('tahun_majalah');
        $penerbit = MajalahHukumList::groupBy('penerbit_majalah')->pluck('penerbit_majalah');

        return view('pages.majalahhukum', compact('majalahHukumList', 'tahun', 'penerbit'));
    }

    public function detail($slug)
    {
        $g_setting = DB::table('general_settings')->where('id', 1)->first();

        $majalahHukumDetail = MajalahHukumList::where('slug', $slug)->first();

        if(!$majalahHukumDetail) {
            return abort(404);
        }
        
        return view('pages.majalahhukum_detail', compact('g_setting', 'majalahHukumDetail'));
    }
}