<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class IsAdmin
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
        if ($request->user()->isAdmin !== 1) {
            Log::warning('A user tried to access admin panel: ID - ' . $request->user()->id . ' Username: ' . $request->user()->name);
            return redirect()->back()->with('danger', 'Bu işlemi gerçekleştirebilmek için yönetici olmanız gerekmektedir!');
        }
        return $next($request);
    }
}
