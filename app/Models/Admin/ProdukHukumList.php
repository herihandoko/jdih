<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;

class ProdukHukumList extends Model
{
    use LogsActivity;
    
    protected static $logAttributes = [
        'produk_hukum_types_id',
        'produk_hukum_categories_id',
        'judul_peraturan',
        'nmr_peraturan',
        'thn_peraturan',
        'singkatan_peraturan',
        'instansi',
        'tgl_pengajuan',
        'tgl_pembahasan',
        'tempat_penetapan',
        'tgl_penetapan',
        'tgl_pengundangan',
        'sumber',
        'subjek',
        'status_akhir',
        'catatan_status',
        'amar',
        'urusan',
        'bidang_hukum',
        'bahasa',
        'teu_badan',
        'pemrakarsa',
        'file_peraturan',
        'abstrak',
        'hasil_uji',
        'view',
        'slug',
        'lokasi',
        'cetakan',
        'deskripsi_fisik',
        'isbn',
        'nmr_indukbuku',
        'comp_code',
        'is_publish',
        'is_deleted'];

    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'Produk Hukum';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Have {$eventName} Produk Hukum Data";
    }
    
    public function tapActivity(Activity $activity)
    {
        $activity->causer_id = session('id');
    }
    
    protected $fillable = [
        'produk_hukum_types_id',
        'produk_hukum_categories_id',
        'judul_peraturan',
        'nmr_peraturan',
        'thn_peraturan',
        'singkatan_peraturan',
        'instansi',
        'tgl_pengajuan',
        'tgl_pembahasan',
        'tempat_penetapan',
        'tgl_penetapan',
        'tgl_pengundangan',
        'sumber',
        'subjek',
        'status_akhir',
        'catatan_status',
        'amar',
        'urusan',
        'bidang_hukum',
        'bahasa',
        'teu_badan',
        'pemrakarsa',
        'file_peraturan',
        'abstrak',
        'hasil_uji',
        'view',
        'slug',
        'lokasi',
        'cetakan',
        'deskripsi_fisik',
        'isbn',
        'nmr_indukbuku',
        'comp_code',
        'is_publish',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_by',
        'deleted_at'
    ];

    public function produk_hukum_types()
    {
        return $this->belongsTo('App\Models\Admin\ProdukHukumType');
    }

    public function produk_hukum_categories()
    {
        return $this->belongsTo('App\Models\Admin\ProdukHukumCategory');
    }
    
    public function produk_hukum_urusan_pemerintahans()
    {
        return $this->belongsTo('App\Models\Admin\ProdukHukumUrusanPemerintahan');
    }
    
    public function produk_hukum_bidang_hukums()
    {
        return $this->belongsTo('App\Models\Admin\ProdukHukumBidangHukum');
    }

}