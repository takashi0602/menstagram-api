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
    public function __invoke()
    {
        User::where('access_token', access_token())->update([
            'access_token' => null,
        ]);
    }
}