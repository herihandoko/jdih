<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Http\Request;
use App;
  
class TranslateController extends Controller
{ 
    public static function translateText(String $value) {
        if(app()->getLocale() == 'id') {
            return $value;
        } else {
            return GoogleTranslate::trans($value, app()->getLocale());
        }
    }
}