<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tracker extends Model {

    public $attributes = [ 'hits' => 0 ];

    protected $fillable = [ 'ip', 'visit_date' ];
    protected $table = 'stat_visits';

    public static function boot() {
        parent::boot();
        static::saving( function ($tracker) {
            $tracker->visit_time = date('H:i:s');
            $tracker->hits++;
        } );
    }

    public static function hit() {
        static::firstOrCreate([
                  'ip'   => $_SERVER['REMOTE_ADDR'],
                  'visit_date' => date('Y-m-d'),
              ])->save();
    }

}