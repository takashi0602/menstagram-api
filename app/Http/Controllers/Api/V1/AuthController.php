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
}
