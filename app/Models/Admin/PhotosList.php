<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;

class PhotosList extends Model
{
    use LogsActivity;
    
    protected static $logAttributes = [
        'photo_name',
        'photo_caption',
        'photo_order',
        'comp_code',
        'is_deleted'];

    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'Galeri Foto';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Have {$eventName} Galeri Foto Data";
    }
    
    public function tapActivity(Activity $activity)
    {
        $activity->causer_id = session('id');
    }
    
    protected $fillable = [
        'photo_name',
        'photo_caption',
        'photo_order',
        'comp_code',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];

}
