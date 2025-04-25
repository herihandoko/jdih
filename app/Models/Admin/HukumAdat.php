<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Carbon\Carbon;

class HukumAdat extends Model
{
    use LogsActivity, HasFactory;



    protected static $logAttributes = [
        'hukumadat_name',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];

    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'Hukum Adat';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Have {$eventName} Hukum Adat";
    }

    public function tapActivity(Activity $activity)
    {
        $activity->causer_id = session('id');
    }

    protected $fillable = [
        'hukumadat_name',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];

    public function hukumadatregulasi()
    {
        return $this->hasMany(HukumAdatRegulasi::class);
    }
}
