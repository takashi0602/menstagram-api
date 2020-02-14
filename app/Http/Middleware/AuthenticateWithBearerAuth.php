<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use App\Models\User;
use Illuminate\Support\Str;

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
        if (!$this->checkAccessTokenFormat($accessToken)) return err_response(['message' => '認証情報の形式が不正です。'], 401);

        $accessToken = hash('sha256', Str::after($accessToken, 'Bearer '));
        if (!$this->existsAccessToken($accessToken)) return err_response(['message' => '存在しない認証情報です。'], 401);

        if (!$this->checkAccessTokenDeadline($accessToken)) {
            $this->resetAccessToken($accessToken);
            return err_response(['message' => '認証情報の期限が切れています。'], 401);
        }

        return $next($request);
    }

    /**
     * アクセストークンのフォーマットが正しいかの検証
     *
     * @param $accessToken
     * @return bool
     */
    private function checkAccessTokenFormat($accessToken)
    {
        if (preg_match('/^Bearer .{80}$/', $accessToken) !== 1) return false;
        return true;
    }

    /**
     * アクセストークンが存在しているかどうか
     *
     * @param $accessToken
     * @return bool
     */
    private function existsAccessToken($accessToken)
    {
        if (User::where('access_token', $accessToken)->first() === null) return false;
        return true;
    }

    /**
     * アクセストークンの期限のチェック(30日でリセット)
     *
     * @param $accessToken
     * @return bool
     */
    private function checkAccessTokenDeadline($accessToken)
    {
        $accessTokenDeadlineAt = User::where('access_token', $accessToken)->first()->access_token_deadline_at;
        $accessTokenDeadlineAt = Carbon::parse($accessTokenDeadlineAt);
        if ($accessTokenDeadlineAt->addDays(30)->lt(Carbon::now())) return false;
        return true;
    }

    /**
     * アクセストークンのリセット
     *
     * @param $accessToken
     */
    private function resetAccessToken($accessToken)
    {
        User::where('access_token', $accessToken)->update([
            'access_token'             => null,
            'access_token_deadline_at' => null,
        ]);
    }
}
