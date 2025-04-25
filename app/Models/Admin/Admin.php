<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;

class Admin extends Model
{
    use LogsActivity;
    
    protected static $logAttributes = [
        'name',
        'username',
        'email',
        'password',
        'token',
        'photo',
        'role_id',
        'comp_code',
        'comp_name',
        'last_login_at',
        'last_login_ip'];

    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'Admin';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Have {$eventName} Admin Data";
    }
    
    public function tapActivity(Activity $activity)
    {
        $activity->causer_id = session('id');
    }
    
    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'token',
        'photo',
        'role_id',
        'comp_code',
        'comp_name',
        'last_login_at',
        'last_login_ip',
        'created_by',
        'updated_by'
    ];

}
