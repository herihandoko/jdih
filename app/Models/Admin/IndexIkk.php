<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;

class IndexIkk extends Model
{
    use LogsActivity;
    
    protected static $logAttributes = [
        'ikk_name',
        'ikk_year',
        'ikk_score',
        'ikk_file',
        'ikk_file_view',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_at',
        'deleted_by'];

    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'Index IKK';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Have {$eventName} Index IKK Data";
    }
    
    public function tapActivity(Activity $activity)
    {
        $activity->causer_id = session('id');
    }
    
    protected $fillable = [
        'ikk_name',
        'ikk_year',
        'ikk_score',
        'ikk_file',
        'ikk_file_view',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];

}