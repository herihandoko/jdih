<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;

class Company extends Model
{
    use LogsActivity;
    
    protected static $logAttributes = [
        'comp_code',
        'comp_name'];

    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'Dinas';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Have {$eventName} Dinas Data";
    }
    
    public function tapActivity(Activity $activity)
    {
        $activity->causer_id = session('id');
    }
    
    protected $fillable = [
        'comp_code',
        'comp_name',
        'created_by',
        'updated_by'
    ];

}