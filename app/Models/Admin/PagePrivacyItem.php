<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PagePrivacyItem extends Model
{
    use LogsActivity, HasFactory;
    
    protected static $logAttributes = [
        'name',
        'detail',
        'seo_title',
        'seo_meta_description'];

    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'Privacy';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Have {$eventName} Privacy Data";
    }
    
    public function tapActivity(Activity $activity)
    {
        $activity->causer_id = session('id');
    }
    
    protected $fillable = [
        'name',
        'detail',
        'seo_title',
        'seo_meta_description'
    ];

}