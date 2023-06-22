<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;

class PageTupoksiItem extends Model
{
    use LogsActivity;
    
    protected static $logAttributes = [
        'name',
        'content',
        'picture',
        'banner',
        'seo_title',
        'seo_meta_description'];

    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'Tupoksi';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Have {$eventName} Tupoksi Data";
    }
    
    public function tapActivity(Activity $activity)
    {
        $activity->causer_id = session('id');
    }
    
    protected $fillable = [
        'name',
        'content',
        'picture',
        'banner',
        'seo_title',
        'seo_meta_description',
        'created_by',
        'updated_by'
    ];

}