<?php

namespace App\Http\Middleware;

use Closure;

class RedirectIfNotAManager
{
    /**
     * Handle an incoming request.
     * Middleware does stuff before doing stuff
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(! $request->user()->isATeamManager())
        {
            return redirect('articles');
        }

        //this passes the data to the next application layer
        return $next($request);
    }
}
