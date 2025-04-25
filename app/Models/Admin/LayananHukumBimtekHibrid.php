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

class LayananHukumBimtekHibrid extends Model
{
    use LogsActivity, HasFactory;
    
    protected static function boot()
    {
        parent::boot();

        self::creating(function ($model) {
            $randomCode = strtoupper(Str::random(4));
            $currentDate = Carbon::now();
        
            $currentYear = $currentDate->format('y');
            $currentMonth = $currentDate->format('m');
            $currentYearString = strval($currentYear);
            $currentMonthString = strval($currentMonth);
            $prefFormatted = $currentYearString . $currentMonthString;
            
            $prefix = 'BIMTEK/BIRHUK/'.$prefFormatted.$randomCode;
            $model->bimtek_number = IdGenerator::generate([
                'table' => 'layanan_hukum_bimtek_hibrids',
                'field' => 'bimtek_number',
                'length' => 22,
                'prefix' => $prefix,
            ]);
        });
    }
    
    protected static $logAttributes = [
        'bimtek_number',
        'bimtek_name',
        'bimtek_link_zoom',
        'bimtek_link_register',
        'bimtek_start_date',
        'bimtek_end_date',
        'bimtek_link_doc',
        'bimtek_desc',
        'created_by',
        'updated_by',
        'deleted_at',
        'deleted_by'];

    protected static $recordEvents = ['created', 'updated', 'deleted'];
    protected static $logOnlyDirty = true;
    protected static $logName = 'Layanan Hukum Bimtek Hibrid';

    public function getDescriptionForEvent(string $eventName): string
    {
        return "Have {$eventName} Layanan Hukum Bimtek Hibrid Data";
    }
    
    public function tapActivity(Activity $activity)
    {
        $activity->causer_id = session('id');
    }
    
    protected $fillable = [
        'bimtek_number',
        'bimtek_name',
        'bimtek_link_zoom',
        'bimtek_link_register',
        'bimtek_start_date',
        'bimtek_end_date',
        'bimtek_link_doc',
        'bimtek_desc',
        'created_by',
        'updated_by',
        'deleted_at',
        'deleted_by'
    ];
    
    public function material()
    {
        return $this->hasMany(LayananHukumBimtekHibridMaterial::class);
    }

}