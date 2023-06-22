<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
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
                a.singkatan_peraturan AS jenis,
                a.nmr_peraturan AS noPeraturan,
                a.judul_peraturan AS judul,
                a.singkatan_peraturan AS singkatanJenis,
                a.tempat_penetapan AS tempatTerbit,
                a.subjek,
                a.status_akhir AS `status`,
                a.bahasa,
                'Hukum Tata Negara' AS bidangHukum,
                a.teu_badan AS teuBadan,
                a.file_peraturan AS fileDownload,
                CONCAT('https://jdih.bantenprov.go.id/storage/places/peraturan/',a.file_peraturan) AS urlDownload,
                CONCAT('https://jdih.bantenprov.go.id/produkhukum/',menus.slug,'/',a.slug) AS urlDetailPeraturan,
                '4' AS operasi,
                '1' AS display
        FROM
                produk_hukum_lists a
                INNER JOIN menus ON menus.type_ruledoc = a.produk_hukum_types_id";
        $response = DB::connection('mysql')->select(DB::raw($query));
        return response()->json($response, $this->successStatus, ['Content-type' => 'application/json; charset=utf-8'], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
    }

}
