<?php

namespace App\Http\Middleware;

use Closure;

/**
 * Bearer認証
 *
 * Class AuthenticateWithBearerAuth
 * @package App\Http\Middleware
 */
class AuthenticateWithBearerAuth
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
        return $next($request);
    }
}
