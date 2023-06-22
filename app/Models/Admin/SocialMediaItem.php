<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;

class SocialMediaItem extends Model
{
    use LogsActivity;
    
    protected static $logAttributes = [
        'social_url',
        'social_icon',
        'social_order',
        'social_color'];

    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'Social Media';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Have {$eventName} Social Media Data";
    }
    
    public function tapActivity(Activity $activity)
    {
        $activity->causer_id = session('id');
    }
    
    protected $fillable = [
        'social_url',
        'social_icon',
        'social_order',
        'social_color'
    ];

}
