<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Carbon\Carbon;

class HukumAdatRegulasi extends Model
{
    use LogsActivity, HasFactory;

    protected static $logAttributes = [
        'hukum_adat_id',
        'materi_type',
        'materi_file',
        'is_publish',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];

    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'Materi Hukum Adat';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Have {$eventName} Materi Hukum Adat";
    }

    public function tapActivity(Activity $activity)
    {
        $activity->causer_id = session('id');
    }

    protected $fillable = [
        'hukum_adat_id',
        'materi_type',
        'materi_file',
        'is_publish',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];

    public function hukumadat()
    {
        return $this->belongsTo(HukumAdat::class);
    }
}
