<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use DB;

class StrukturOrganisasiController extends Controller
{
    public function index()
    {
        $strukturOrganisasi = DB::table('page_struktur_organisasi_items')->where('id', 1)->first();
        $createdAt = Carbon::parse($strukturOrganisasi->created_at);
        $registeredAt = $createdAt->isoFormat('D MMMM Y');
        $updateAt = Carbon::parse($strukturOrganisasi->updated_at);
        $updatedAt = $updateAt->isoFormat('D MMMM Y HH:mm:ss');
        return view('pages.strukturorganisasi', compact('strukturOrganisasi', 'registeredAt', 'updatedAt'));
    }
}