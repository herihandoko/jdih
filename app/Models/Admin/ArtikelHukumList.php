<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class ArtikelHukumList extends Model
{
    protected $fillable = [
        'judul_artikel',
        'content_artikel',
        'penulis_artikel',
        'tahun_artikel',
        'slug',
        'comp_code',
        'publish',
        'publish_at',
        'created_by',
        'updated_by'
    ];
}