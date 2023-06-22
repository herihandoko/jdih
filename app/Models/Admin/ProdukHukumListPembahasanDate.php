<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;

class ProdukHukumListPembahasanDate extends Model
{
    use LogsActivity;
    
    protected static $logAttributes = [
        'produk_hukum_lists_id',
        'tgl_pembahasan'];

    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'List Pembahasan';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Have {$eventName} List Pembahasan Data";
    }
    
    public function tapActivity(Activity $activity)
    {
        $activity->causer_id = session('id');
    }
    
    protected $fillable = [
        'produk_hukum_lists_id',
        'tgl_pembahasan',
        'created_by',
        'updated_by'
    ];

}