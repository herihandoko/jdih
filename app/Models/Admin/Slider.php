<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;

class Slider extends Model
{
    use LogsActivity;
    
    protected static $logAttributes = [
        'slider_heading',
        'slider_text',
        'slider_button_text',
        'slider_button_url',
        'slider_photo'];

    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'Sliders';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Have {$eventName} Sliders Data";
    }
    
    public function tapActivity(Activity $activity)
    {
        $activity->causer_id = session('id');
    }
    
    protected $fillable = [
        'slider_heading',
        'slider_text',
        'slider_button_text',
        'slider_button_url',
        'slider_photo'
    ];

}
