<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class Lang
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

        $lang = $request->session()->get('lang');

        //   $lang = $lang ?? 'en';   // null call thing operator
        if ($lang == null) {
            $lang = 'en';
        }
        App::setlocale($lang);

        return $next($request);
    }
}
