<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class IsTeacher
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
        if ($request->user()->isTeacher !== 1) {
            return redirect()->back();
        }
        return $next($request);
    }
}
