<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;

class ProdukHukumType extends Model
{
    use LogsActivity;
    
    protected static $logAttributes = [
        'type_name',
        'type_active'];

    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'Jenis Peraturan';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Have {$eventName} Jenis Peraturan Data";
    }
    
    public function tapActivity(Activity $activity)
    {
        $activity->causer_id = session('id');
    }
    
    protected $fillable = [
        'type_name',
        'type_active',
        'created_by',
        'updated_by'
    ];

}