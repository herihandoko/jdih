<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BeritaList extends Model
{
    use LogsActivity, HasFactory;
    
    protected static $logAttributes = [
        'berita_categories_id',
        'judul_berita',
        'content_berita',
        'slug',
        'photo_berita',
        'comp_code',
        'publish',
        'publish_at',
        'is_deleted'];

    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'Daftar Berita';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Have {$eventName} Daftar Berita Data";
    }
    
    public function tapActivity(Activity $activity)
    {
        $activity->causer_id = session('id');
    }
    
    protected $fillable = [
        'berita_categories_id',
        'judul_berita',
        'content_berita',
        'slug',
        'photo_berita',
        'comp_code',
        'publish',
        'publish_at',
        'is_deleted',
        'created_by',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];
    
    public function berita_categories()
    {
        return $this->belongsTo('App\Models\Admin\BeritaCategory');
    }
}