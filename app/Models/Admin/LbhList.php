<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;

class LbhList extends Model
{
    use LogsActivity;
    
    protected static $logAttributes = [
        'lbh_name',
        'lbh_address',
        'lbh_desc',
        'lbh_phone',
        'lbh_accreditation',
        'lbh_order',
        'comp_code',
        'publish',
        'publish_at',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_at',
        'deleted_by'];

    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'LBH List';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Have {$eventName} LBH List Data";
    }
    
    public function tapActivity(Activity $activity)
    {
        $activity->causer_id = session('id');
    }
    
    protected $fillable = [
        'lbh_name',
        'lbh_address',
        'lbh_desc',
        'lbh_phone',
        'lbh_accreditation',
        'lbh_order',
        'comp_code',
        'publish',
        'publish_at',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];

}