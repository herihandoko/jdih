<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class PersistSearchParams
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->isMethod('post')) {
            session(['search_params' => $request->except('_token')]);
        } elseif ($request->isMethod('get') && session()->has('search_params')) {
            $request->merge(session('search_params'));
        }

        return $next($request);
    }
}