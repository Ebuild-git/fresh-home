<?php

namespace App\Helpers;

use Stichoza\GoogleTranslate\GoogleTranslate;

class TranslationHelper
{
    public static function TranslateText($text)
    {
        $locale = app()->getLocale(); 
        
        if($locale == "en"){
            $tr = new GoogleTranslate($locale);
            return $tr->translate($text);
        }else{
            return $text;
        }
        
       
    }
}
