<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;

class BeritaCategory extends Model
{
    use LogsActivity;
    
    protected static $logAttributes = [
        'category_name',
        'category_active'];

    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'Kategori Berita';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Have {$eventName} Kategori Berita Data";
    }
    
    public function tapActivity(Activity $activity)
    {
        $activity->causer_id = session('id');
    }
    
    protected $fillable = [
        'category_name',
        'category_active',
        'created_by',
        'updated_by'
    ];
}