<?php

if (! function_exists('translateText')) {
    function translateText($value)
    {
        if(!empty($value)) {
            if(app()->getLocale() == 'id') {
                return $value;
            } else {
                return GoogleTranslate::trans($value, app()->getLocale());
            }
        } else {
            return $value;
        }
    }
}