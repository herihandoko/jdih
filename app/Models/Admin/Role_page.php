<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;

class Role_page extends Model
{
    use LogsActivity;
    
    protected static $logAttributes = [
        'page_route',
        'page_title'];

    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'Role Page';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Have {$eventName} Role Page Data";
    }
    
    public function tapActivity(Activity $activity)
    {
        $activity->causer_id = session('id');
    }
    
    protected $fillable = [
        'page_route',
        'page_title'
    ];

}
