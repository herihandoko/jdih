<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use DB;

class TupoksiController extends Controller
{
    public function index()
    {
        $tupoksi = DB::table('page_tupoksi_items')->where('id', 1)->first();
        $createdAt = Carbon::parse($tupoksi->created_at);
        $registeredAt = $createdAt->isoFormat('D MMMM Y');
        $updateAt = Carbon::parse($tupoksi->updated_at);
        $updatedAt = $updateAt->isoFormat('D MMMM Y HH:mm:ss');
        return view('pages.tupoksi', compact('tupoksi', 'registeredAt', 'updatedAt'));
    }
}