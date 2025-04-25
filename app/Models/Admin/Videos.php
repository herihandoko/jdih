<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;

class Videos extends Model
{
    use LogsActivity;
    
    protected static $logAttributes = [
        'video_youtube',
        'video_caption',
        'video_order',
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
    protected static $logName = 'Video';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Have {$eventName} Video Data";
    }
    
    public function tapActivity(Activity $activity)
    {
        $activity->causer_id = session('id');
    }
    
    protected $fillable = [
        'video_youtube',
        'video_caption',
        'video_order',
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