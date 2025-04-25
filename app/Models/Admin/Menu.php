<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Models\Activity;

class Menu extends Model
{
    use HasFactory, LogsActivity;
    
    protected static $logAttributes = [
        'menu_name',
        'parent_id',
        'slug',
        'menu_status',
        'type_doc',
        'type_ruledoc',
        'page_id',
        'free_link',
        'editabled',
        'is_active',
        'order'];

    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'Menu Manage';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Have {$eventName} Menu Manage Data";
    }
    
    public function tapActivity(Activity $activity)
    {
        $activity->causer_id = session('id');
    }
    
    protected $fillable = [
        'menu_name',
        'parent_id',
        'slug',
        'menu_status',
        'type_doc',
        'type_ruledoc',
        'page_id',
        'free_link',
        'editabled',
        'is_active',
        'order'
    ];

    public function children()
    {

        return $this->hasMany('App\Models\Admin\Menu', 'parent_id', 'id')->orderBy('order', 'asc');
    }

}
