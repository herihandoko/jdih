<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class MajalahHukumList extends Model
{
    protected $fillable = [
        'judul_majalah',
        'penulis_majalah',
        'edisi_majalah',
        'penerbit_majalah',
        'tempatterbit_majalah',
        'tahun_majalah',
        'bahasa_majalah',
        'lokasi_majalah',
        'file_majalah',
        'cover_majalah',
        'kategori_majalah',
        'slug',
        'comp_code',
        'created_by',
        'updated_by'
    ];
}