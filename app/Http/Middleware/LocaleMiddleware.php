<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;

class LocaleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $locale = null;

        if(Auth::check())
        {
            $locale = $request->user()->locale;
        }

        if($request->has('locale'))
        {
            $locale = $request->get('locale');
        }

        if($locale === null)
        {
            $locale = config('app.fallback_locale');
        }

        App::setLocale($locale);
        
        return $next($request);
    }
}
