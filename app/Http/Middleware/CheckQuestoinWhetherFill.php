<?php

namespace App\Http\Middleware;

use Closure;

class CheckQuestoinWhetherFill
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        dd($response);

        // return $next($request);
    }
}
