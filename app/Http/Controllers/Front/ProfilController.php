<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use DB;

class ProfilController extends Controller
{
    public function visimisi()
    {
        $visiMisi = DB::table('page_visi_misi_items')->where('id', 1)->first();
        
        if($visiMisi) {
            $createdAt = Carbon::parse($visiMisi->created_at);
            $registeredAt = $createdAt->isoFormat('D MMMM Y');
            $updateAt = Carbon::parse($visiMisi->updated_at);
            $updatedAt = $updateAt->isoFormat('D MMMM Y HH:mm:ss');
        } else {
            return abort(404);
        }
        
        return view('pages.visimisi', compact('visiMisi', 'registeredAt', 'updatedAt'));
    }
    
    public function dasarhukum()
    {
        $dasarHukum = DB::table('page_dasar_hukum_items')->where('id', 1)->first();
        
        if($dasarHukum) {
            $createdAt = Carbon::parse($dasarHukum->created_at);
            $registeredAt = $createdAt->isoFormat('D MMMM Y');
            $updateAt = Carbon::parse($dasarHukum->updated_at);
            $updatedAt = $updateAt->isoFormat('D MMMM Y HH:mm:ss');
        } else {
            return abort(404);
        }
        
        return view('pages.dasarhukum', compact('dasarHukum', 'registeredAt', 'updatedAt'));
    }
    
    public function strukturorganisasi()
    {
        $strukturOrganisasi = DB::table('page_struktur_organisasi_items')->where('id', 1)->first();
        
        if($strukturOrganisasi) {
            $createdAt = Carbon::parse($strukturOrganisasi->created_at);
            $registeredAt = $createdAt->isoFormat('D MMMM Y');
            $updateAt = Carbon::parse($strukturOrganisasi->updated_at);
            $updatedAt = $updateAt->isoFormat('D MMMM Y HH:mm:ss');
        } else {
            return abort(404);
        }
        
        return view('pages.strukturorganisasi', compact('strukturOrganisasi', 'registeredAt', 'updatedAt'));
    }
    
    public function tupoksi()
    {
        $tupoksi = DB::table('page_tupoksi_items')->where('id', 1)->first();
        
        if($tupoksi) {
            $createdAt = Carbon::parse($tupoksi->created_at);
            $registeredAt = $createdAt->isoFormat('D MMMM Y');
            $updateAt = Carbon::parse($tupoksi->updated_at);
            $updatedAt = $updateAt->isoFormat('D MMMM Y HH:mm:ss');
        } else {
            return abort(404);
        }
        
        return view('pages.tupoksi', compact('tupoksi', 'registeredAt', 'updatedAt'));
    }
    
    public function anggotajdih()
    {
        $anggotaJdih = DB::table('footer_columns')->where('is_member', 1)
                        ->orderBy('column_item_order')
                        ->get();
        
        if(!$anggotaJdih) {
            return abort(404);
        }
        
        return view('pages.anggotajdih', compact('anggotaJdih'));
    }
    
    public function sop()
    {
        $sop = DB::table('page_sop_items')->where('id', 1)->first();
        
        if($sop) {
            $createdAt = Carbon::parse($sop->created_at);
            $registeredAt = $createdAt->isoFormat('D MMMM Y');
            $updateAt = Carbon::parse($sop->updated_at);
            $updatedAt = $updateAt->isoFormat('D MMMM Y HH:mm:ss');
        } else {
            return abort(404);
        }
        
        return view('pages.sop', compact('sop', 'registeredAt', 'updatedAt'));
    }
}