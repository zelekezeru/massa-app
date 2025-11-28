<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

Route::post('/lang', function () {
    $locale = request('locale');
    if (in_array($locale, ['en', 'am', 'zh', 'ur', 'sw', 'ar', 'es', 'fr', 'om', 'ti'])) {
        App::setLocale($locale);
        Session::put('locale', $locale);
    }
    return back();
})->name('lang.switch');
