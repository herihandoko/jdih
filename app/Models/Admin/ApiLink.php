<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;

class ApiLink extends Model
{
    use HasFactory, LogsActivity;
    
    protected static $logAttributes = [
        'api_name',
        'api_url',
        'api_active'];

    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'API Link';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Have {$eventName} API Link Data";
    }
    
    public function tapActivity(Activity $activity)
    {
        $activity->causer_id = session('id');
    }
    
    protected $fillable = [
        'api_name',
        'api_url',
        'api_active',
        'created_by',
        'updated_by'
    ];
}
