<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;

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
        $accessToken = $request->header('Authorization');
        if (preg_match('/^Bearer: .{80}$/', $accessToken) !== 1) return response('{}', 401);
        if (User::where('access_token', $accessToken)->first() === null) return response('{}', 401);

        return $next($request);
    }
}
