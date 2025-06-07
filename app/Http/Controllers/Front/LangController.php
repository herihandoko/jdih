<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
  
class LangController extends Controller
{
    public function index()
    {
        return view('lang');
    }
    
    public function change(Request $request)
    {
        try {
            $locale = $request->lang;
            if (!in_array($locale, ['id', 'en', 'ar', 'zh', 'ja', 'ko', 'su'])) {
                $locale = 'id';
            }
            
            Session::put('locale', $locale);
            App::setLocale($locale);
            
            return redirect()->back()->withHeaders([
                'Cache-Control' => 'no-store, no-cache, must-revalidate, post-check=0, pre-check=0',
                'Pragma' => 'no-cache',
            ]);
            
        } catch (\Exception $e) {
            report($e);
            return redirect()->back();
        }
    }
}