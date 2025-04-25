<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;

class Page extends Model
{
    use HasFactory, LogsActivity;
    
    protected static $logAttributes = [
        'page_name',
        'page_view'];

    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'Page Manage';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Have {$eventName} Page Manage Data";
    }
    
    public function tapActivity(Activity $activity)
    {
        $activity->causer_id = session('id');
    }
    
    protected $fillable = [
        'page_name',
        'page_view'
    ];
}
