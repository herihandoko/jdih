<?php

namespace App\Models;

class ApiResult
{
    public $idData;
    public $judul;
    public $tahun_pengundangan;
    public $tanggal_pengundangan;
    public $jenis;
    public $noPeraturan;
    public $status;
    public $view;
    public $created_at;
    public $produk_hukum_types;
    public $api_name;
    public $status_akhir;

    public function __construct($data)
    {
        $this->idData = $data['idData'] ?? null;
        $this->judul = $data['judul'] ?? null;
        $this->tahun_pengundangan = $data['tahun_pengundangan'] ?? null;
        $this->tanggal_pengundangan = $data['tanggal_pengundangan'] ?? null;
        $this->jenis = $data['jenis'] ?? null;
        $this->noPeraturan = $data['noPeraturan'] ?? null;
        $this->status = $data['status'] ?? null;
        $this->view = $data['view'] ?? null;
        $this->created_at = $data['created_at'] ?? null;
        $this->produk_hukum_types = $data['produk_hukum_types'] ?? null;
        $this->api_name = $data['api_name'] ?? null;
        $this->status_akhir = $data['status_akhir'] ?? null;
    }
}