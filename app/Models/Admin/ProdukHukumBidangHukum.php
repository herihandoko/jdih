<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;

class ProdukHukumBidangHukum extends Model
{
    use LogsActivity;
    
    protected static $logAttributes = [
        'bh_code',
        'bh_name',
        'bh_active'];

    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'Bidang Hukum';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Have {$eventName} Bidang Hukum Data";
    }
    
    public function tapActivity(Activity $activity)
    {
        $activity->causer_id = session('id');
    }
    
    protected $fillable = [
        'bh_code',
        'bh_name',
        'bh_active',
        'created_by',
        'updated_by'
    ];

}