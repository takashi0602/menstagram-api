<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserLikesRequest;
use App\UseCases\FetchUserLikesUseCase;
use App\UseCases\TakeAccessTokenUseCase;
use App\UseCases\TakeUserByAccessTokenUseCase;

/**
 * ユーザー系API
 *
 * Class UserController
 * @package App\Http\Controllers\Api\V1
 */
class UserController extends Controller
{
    /**
     * いいねした投稿一覧
     *
     * @param UserLikesRequest $request
     * @param TakeAccessTokenUseCase $takeAccessTokenUseCase
     * @param TakeUserByAccessTokenUseCase $takeUserByAccessTokenUseCase
     * @param FetchUserLikesUseCase $fetchUserLikesUseCase
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function likes(UserLikesRequest $request,
                          TakeAccessTokenUseCase $takeAccessTokenUseCase,
                          TakeUserByAccessTokenUseCase $takeUserByAccessTokenUseCase,
                          FetchUserLikesUseCase $fetchUserLikesUseCase)
    {
        $accessToken = $takeAccessTokenUseCase();
        $userId = $takeUserByAccessTokenUseCase($accessToken)->id;
        $response = $fetchUserLikesUseCase($userId, $request->post_id, $request->type);
        return response($response, 200);
    }
}
