<?php

namespace App\UseCases;

use App\Models\User;

/**
 * ユーザーのログアウト
 *
 * Class LogoutUserUseCase
 * @package App\UseCases
 */
class LogoutUserUseCase
{
    /**
     * @param $userId
     */
    public function __invoke($userId)
    {
        User::where('access_token', $userId)->update([
            'access_token' => null,
        ]);
    }
}