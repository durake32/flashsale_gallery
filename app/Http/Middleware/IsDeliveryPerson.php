<?php

namespace App\Http\Middleware;

use Closure;

class IsDeliveryPerson
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
        if(!auth('admin_api')->user()->hasRole('delivery person')){
            return response('Forbbiden.', 403);
        }
        return $next($request);
    }
}
