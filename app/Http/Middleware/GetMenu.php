<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GetMenu {
    public function handle($request, Closure $next) {
        if(session('role_id') == 1) {
            return $next($request);
        } else {
            return redirect()->back();
        }
    }
}

