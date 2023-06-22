<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;

class Role_permission extends Model
{
    use LogsActivity;
    
    protected static $logAttributes = [
        'role_id',
        'role_page_id',
        'access_status'];

    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'Role Permission';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Have {$eventName} Role Permission Data";
    }
    
    public function tapActivity(Activity $activity)
    {
        $activity->causer_id = session('id');
    }
    
    protected $fillable = [
        'role_id',
        'role_page_id',
        'access_status'
    ];

}
