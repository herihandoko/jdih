<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;

class ProdukHukumListCatatanStat extends Model
{
    use LogsActivity;
    
    protected static $logAttributes = [
        'produk_hukum_lists_id',
        'peraturan_catatan',
        'jenis_status'];

    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'List Catatan Status';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Have {$eventName} List Catatan Status Data";
    }
    
    public function tapActivity(Activity $activity)
    {
        $activity->causer_id = session('id');
    }
    
    protected $fillable = [
        'produk_hukum_lists_id',
        'peraturan_catatan',
        'jenis_status',
        'created_by',
        'updated_by'
    ];

}