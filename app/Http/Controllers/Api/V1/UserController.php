<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLikesRequest;
use App\Http\Requests\UserProfileRequest;
use App\UseCases\FetchUserLikesUseCase;
use App\UseCases\FetchUserProfileUseCase;

/**
 * ユーザー系API
 *
 * Class UserController
 * @package App\Http\Controllers\Api\V1
 */
class UserController extends Controller
{
    /**
     * ユーザーのプロフィール
     *
     * @param UserProfileRequest $request
     * @param FetchUserProfileUseCase $useCase
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function profile(UserProfileRequest $request, FetchUserProfileUseCase $useCase)
    {
        $userId = $request->user_id ? user($request->user_id)->id : user()->id;
        $user = $useCase($userId);
        return response($user, 200);
    }

    /**
     * いいねした投稿一覧
     *
     * @param UserLikesRequest $request
     * @param FetchUserLikesUseCase $useCase
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function likes(UserLikesRequest $request, FetchUserLikesUseCase $useCase)
    {
        $response = $useCase($request->post_id, $request->type);
        return response($response, 200);
    }
}
