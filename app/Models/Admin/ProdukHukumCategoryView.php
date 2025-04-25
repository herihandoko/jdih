<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;

class ProdukHukumCategoryView extends Model
{
    use HasFactory, LogsActivity;
    
    protected static $logAttributes = [
        'produk_hukum_categories_id',
        'page_view'];

    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'Jenis Dokumen View';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Have {$eventName} Jenis Dokumen View Data";
    }
    
    public function tapActivity(Activity $activity)
    {
        $activity->causer_id = session('id');
    }
    
    protected $fillable = [
        'produk_hukum_categories_id',
        'page_view'
    ];
}