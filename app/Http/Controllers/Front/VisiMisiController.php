<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use DB;

class VisiMisiController extends Controller
{
    public function index()
    {
        $visiMisi = DB::table('page_visi_misi_items')->where('id', 1)->first();
        $createdAt = Carbon::parse($visiMisi->created_at);
        $registeredAt = $createdAt->isoFormat('D MMMM Y');
        $updateAt = Carbon::parse($visiMisi->updated_at);
        $updatedAt = $updateAt->isoFormat('D MMMM Y HH:mm:ss');
        return view('pages.visimisi', compact('visiMisi', 'registeredAt', 'updatedAt'));
    }
}