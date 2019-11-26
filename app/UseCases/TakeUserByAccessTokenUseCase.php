<?php

namespace App\UseCases;

use App\Models\User;

/**
 * ユーザーの取得
 *
 * Class TakeUserUseCase
 * @package App\UseCases
 */
class TakeUserByAccessTokenUseCase
{
    /**
     * @param $accessToken
     * @return mixed
     */
    public function __invoke($accessToken)
    {
        $user = User::where('access_token', $accessToken)->first();
        return $user;
    }
}