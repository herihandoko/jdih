<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Str;
use Carbon\Carbon;

class LayananHukumBimtekHibridMaterial extends Model
{
    use LogsActivity, HasFactory;
    
    protected static $logAttributes = [
        'layanan_hukum_bimtek_hibrid_id',
        'materi_file',
        'is_publish',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_at',
        'deleted_by'];

    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'Materi Layanan Hukum Bimtek Hibrid';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Have {$eventName} Materi Layanan Hukum Bimtek Hibrid Data";
    }
    
    public function tapActivity(Activity $activity)
    {
        $activity->causer_id = session('id');
    }
    
    protected $fillable = [
        'layanan_hukum_bimtek_hibrid_id',
        'materi_file',
        'is_publish',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];
    
    public function bimtekhibrid()
    {
        return $this->belongsTo(LayananHukumBimtekHibrid::class);
    }

}