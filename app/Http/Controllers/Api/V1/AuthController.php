<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Http\Requests\RegisterUserRequest;
use App\UseCases\RegisterUserUseCase;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

/**
 * 認証系API
 *
 * Class AuthController
 * @package App\Http\Controllers\Api\V1
 */
class AuthController extends Controller
{
    /**
     * ユーザー登録
     *
     * @param RegisterUserRequest $request
     * @param RegisterUserUseCase $usecase
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function register(RegisterUserRequest $request, RegisterUserUseCase $usecase)
    {
        $accessToken = $usecase($request->user_id, $request->screen_name, $request->email, $request->password);
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

        $validator = Validator::make($request->all(), [
            'user_id'=> ['bail', 'required', 'regex:/^[a-zA-Z0-9_]+$/', 'max:16', 'exists:users', ],
            'password'=> ['bail', 'required', 'string', ],
        ]);
        if ($validator->fails()) return response('{}', 400);

        $user = User::where('user_id', $request->user_id)->first();
        if (!Hash::check($request->password, $user->password)) return response('{}', 409);

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
        $request = request();

        $validator = Validator::make($request->all(), [
            'access_token'=> ['bail', 'required', 'string', ],
        ]);
        if ($validator->fails()) return response('{}', 400);

        User::where('access_token', $request->access_token)->update([
            'access_token' => null,
        ]);

        return response('{}', 200);
    }
}
