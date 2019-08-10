<?php

namespace App\Http\Middleware;

use Closure;

class UserHasMedicalRecord
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
        if (!$request->route('user')->hasMedicalRecord()){
            return $next($request);
        } else {
            return abort(403);
        }
    }
}
