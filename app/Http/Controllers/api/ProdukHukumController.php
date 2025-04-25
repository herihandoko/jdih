<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use DB;

/**
 * Description of ProdukHukumController
 *
 * @author heryhandoko
 */
class ProdukHukumController extends Controller {

    //put your code here
    public $successStatus = 200;

    public function integrasi() {
        $query = "SELECT
                a.id AS idData,
                YEAR(a.tgl_pengundangan) AS tahun_pengundangan,
                a.tgl_pengundangan AS tanggal_pengundangan, 
                UPPER(b.type_name) AS jenis,
                a.nmr_peraturan AS noPeraturan,
                a.judul_peraturan AS judul,
                UPPER(a.singkatan_peraturan) AS singkatanJenis,
                a.tempat_penetapan AS tempatTerbit,
                a.sumber,
                a.subjek,
                a.status_akhir AS `status`,
                a.bahasa,
                'Hukum Tata Negara' AS bidangHukum,
                a.teu_badan AS teuBadan,
                a.file_peraturan AS fileDownload,
                CONCAT('https://jdih.bantenprov.go.id/storage/places/peraturan/',a.file_peraturan) AS urlDownload,
                CONCAT('https://jdih.bantenprov.go.id/dokumen/',menus.slug,'/') AS urlDetailPeraturan,
                '4' AS operasi,
                '1' AS display
        FROM
                produk_hukum_lists a
                LEFT JOIN produk_hukum_types b ON a.produk_hukum_types_id = b.id
                INNER JOIN menus ON menus.type_ruledoc = a.produk_hukum_types_id
                ORDER BY a.tgl_pengundangan DESC";
        $response = DB::connection('mysql')->select(DB::raw($query));
        
        // Enkripsi ID dan update URL detail
        foreach ($response as $item) {
            $idEncrypt = Crypt::encryptString($item->idData);
            $item->urlDetailPeraturan = $item->urlDetailPeraturan . $idEncrypt;
        }
        
        return response()->json($response, $this->successStatus, ['Content-type' => 'application/json; charset=utf-8'], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

}
