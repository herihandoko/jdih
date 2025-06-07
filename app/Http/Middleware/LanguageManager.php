<?php

namespace App\Http\Middleware;
  
use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
  
class LanguageManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {
            if (Session::has('locale')) {
                $locale = Session::get('locale');
                if (in_array($locale, ['id', 'en', 'ar', 'zh', 'ja', 'ko', 'su'])) {
                    App::setLocale($locale);
                }
            }
        } catch (\Exception $e) {
            report($e);
        }
          
        return $next($request);
    }
}