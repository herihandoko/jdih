<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
     protected $table = 'survey';

    protected $fillable = [
        'visitor_name',
        'visitor_sex',
        'visitor_age',
        'visitor_email',
        'visitor_education',
        'visitor_job',
        'visitor_jobother',
        'informasi_radio',
        'informasi_saran',
        'koleksi_radio',
        'koleksi_saran',
        'ragam_radio',
        'ragam_saran',
        'cantum_radio',
        'cantum_saran',
        'menu_radio',
        'menu_saran',
        'tampilan_radio',
        'tampilan_saran',
        'dokumen_radio',
        'dokumen_saran',
        'informasidetail_radio',
        'informasidetail_saran',
        'isi_radio',
        'isi_saran',
        'kecepatan_radio',
        'kecepatan_saran'
    ];

}
