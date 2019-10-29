<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Str;

/**
 * 認証系API
 *
 * Class AuthController
 * @package App\Http\Controllers\Api\V1
 */
class AuthController extends Controller
{
    /**
     * 登録
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function register()
    {
        $request = request();

        // TODO: バリデーション

        $accessToken = Str::random(80);

        User::create([
            'user_id'       => $request->user_id,
            'screen_name'   => $request->screen_name,
            'email'         => $request->email,
            'password'      => bcrypt($request->password),
            'access_token'  => hash('sha256', $accessToken),
        ]);

        return response(['access_token' => $accessToken], 200);
    }

    /**
     * ログイン
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function login()
    {
        $request = request();

        // TODO: バリデーション

        $accessToken = Str::random(80);

        User::where('user_id', $request->user_id)->update([
            'access_token' => hash('sha256', $accessToken),
        ]);

        return response(['access_token' => $accessToken], 200);
    }

    /**
     * ログアウト
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function logout()
    {
        // TODO: バリデーション

        // TODO: アクセストークンの取得
        User::where('access_token', 'hoge')->update([
            'access_token' => null,
        ]);

        return response('{}', 200);
    }
}
