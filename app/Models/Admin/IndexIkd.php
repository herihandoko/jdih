<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;

class IndexIkd extends Model
{
    use LogsActivity;
    
    protected static $logAttributes = [
        'ikd_name',
        'ikd_year',
        'ikd_score',
        'ikk_file',
        'ikk_file_view',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_at',
        'deleted_by'];

    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'Index IKD';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Have {$eventName} Index IKD Data";
    }
    
    public function tapActivity(Activity $activity)
    {
        $activity->causer_id = session('id');
    }
    
    protected $fillable = [
        'ikd_name',
        'ikd_year',
        'ikd_score',
        'ikk_file',
        'ikk_file_view',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];

}