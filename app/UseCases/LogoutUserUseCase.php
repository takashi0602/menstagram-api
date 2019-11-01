<?php

namespace App\UseCases;

use App\Models\User;

/**
 * ログアウト
 *
 * Class LogoutUserUseCase
 * @package App\UseCases
 */
class LogoutUserUseCase
{
    /**
     * @param $accessToken
     */
    public function __invoke($accessToken)
    {
        User::where('access_token', $accessToken)->update([
            'access_token' => null,
        ]);
    }
}