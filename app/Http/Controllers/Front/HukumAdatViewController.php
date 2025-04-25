<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Admin\HukumAdat;
use App\Models\Admin\HukumAdatRegulasi;
use DB;

class HukumAdatViewController extends Controller
{
    public function index()
    {
        $hukumadatList = HukumAdat::where('is_deleted', 0)->orderby('created_at', 'desc')
            ->paginate(10);


        return view('pages.hukumadat', compact('hukumadatList'));
    }

    public function detail($id)
    {
        $g_setting = DB::table('general_settings')->where('id', 1)->first();

        $hukumadatDetail = HukumAdat::where('id', $id)->first();
        $hukumadatregulasiDetail = HukumAdatRegulasi::where('hukum_adat_id', $id)->where('is_deleted', 0)->get();

        if (!$hukumadatDetail) {
            return abort(404);
        }

        return view('pages.hukumadat_detail', compact('g_setting', 'hukumadatDetail', 'hukumadatregulasiDetail'));
    }
}
