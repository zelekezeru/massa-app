<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SetLanguage extends Model
{
        public function handle($request, Closure $next)
    {
        $locale = session('locale') 
            ?? auth()->user()->language 
            ?? 'en';

        app()->setLocale($locale);

        return $next($request);
    }

}
