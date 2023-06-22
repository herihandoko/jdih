<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;

class ProdukHukumUrusanPemerintahan extends Model
{
    use LogsActivity;
    
    protected static $logAttributes = [
        'up_code',
        'up_name',
        'up_active'];

    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'Urusan Pemerintahan';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Have {$eventName} Urusan Pemerintahan Data";
    }
    
    public function tapActivity(Activity $activity)
    {
        $activity->causer_id = session('id');
    }
    
    protected $fillable = [
        'up_code',
        'up_name',
        'up_active',
        'created_by',
        'updated_by'
    ];

}