<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\LogoutUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\UseCases\LoginUserUseCase;
use App\UseCases\LogoutUserUseCase;
use App\UseCases\RegisterUserUseCase;
use App\UseCases\ExistsUserUseCase;
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
     * ユーザー登録
     *
     * @param RegisterUserRequest $request
     * @param RegisterUserUseCase $useCase
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function register(RegisterUserRequest $request, RegisterUserUseCase $useCase)
    {
        $accessToken = $useCase($request->user_id, $request->screen_name, $request->email, $request->password);
        return response(['access_token' => $accessToken], 200);
    }

    /**
     * ログイン
     *
     * @param LoginUserRequest $request
     * @param ExistsUserUseCase $existsUserUseCase
     * @param LoginUserUseCase $loginUserUseCase
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function login(LoginUserRequest $request, ExistsUserUseCase $existsUserUseCase, LoginUserUseCase $loginUserUseCase)
    {
        if (!$existsUserUseCase($request->user_id, $request->password)) return response('{}', 409);
        $accessToken = $loginUserUseCase($request->user_id);
        return response(['access_token' => $accessToken], 200);
    }

    /**
     * ログアウト
     *
     * @param LogoutUserRequest $request
     * @param LogoutUserUseCase $useCase
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function logout(LogoutUserRequest $request, LogoutUserUseCase $useCase)
    {
        $useCase(Str::after($request->header('Authorization'), 'Bearer: '));
        return response('{}', 200);
    }
}
