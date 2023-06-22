<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;

class ProdukHukumCategory extends Model
{
    use LogsActivity;
    
    protected static $logAttributes = [
        'category_name',
        'category_active',
        'menus_id'];

    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'Jenis Dokumen';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Have {$eventName} Jenis Dokumen Data";
    }
    
    public function tapActivity(Activity $activity)
    {
        $activity->causer_id = session('id');
    }
    
    protected $fillable = [
        'category_name',
        'category_active',
        'menus_id',
        'created_by',
        'updated_by'
    ];

}