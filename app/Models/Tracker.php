<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;
use Carbon\Carbon;

class Tracker extends Model
{

    public $attributes = ['hits' => 0];

    protected $fillable = ['ip', 'visit_date', 'visit_time', 'hits', 'last_activity'];
    protected $table = 'stat_visits';

    public static function boot()
    {
        parent::boot();
        static::creating(function ($tracker) {
            $tracker->visit_time = Carbon::now()->format('H:i:s');
            $tracker->last_activity = Carbon::now();
        });
    }

    public static function hit()
    {
        $tracker = static::firstOrCreate([
            // 'ip' => Request::ip(),
            'ip' => static::getRealClientIp(),
            'visit_date' => Carbon::today()->toDateString(),
        ]);

        $tracker->increment('hits');
        $tracker->last_activity = Carbon::now();
        $tracker->save();
    }

    protected static function getRealClientIp()
    {
        if (!empty($_SERVER['HTTP_CF_CONNECTING_IP'])) {
            // Cloudflare specific
            return $_SERVER['HTTP_CF_CONNECTING_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // General WAF/proxy (often comma-separated list)
            $ipList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
            return trim($ipList[0]); // Take first IP from the list
        } else {
            // Fallback to REMOTE_ADDR
            return $_SERVER['REMOTE_ADDR'];
        }
    }

    public static function getOnlineUsers($minutes = 5)
    {
        return static::where('last_activity', '>=', Carbon::now()->subMinutes($minutes))->count();
    }
}
