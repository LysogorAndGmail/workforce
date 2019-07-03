<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class LanguageController extends Controller
{
    public function changeLang($lang)
    {
        if (array_key_exists($lang, Config::get('languages'))) {
            session()->put('app_locale', $lang);
            App::setLocale($lang);
        } else {
            App::setLocale(Config::get('app.fallback_locale'));
        }
    }

    public function sessionLang()
    {
        return response()->json(session('app_locale'));
    }
}
