<?php

namespace App\UseCases;

use App\Models\User;
use Illuminate\Support\Str;

/**
 * ユーザーのログイン
 *
 * Class LoginUserUseCase
 * @package App\UseCases
 */
class LoginUserUseCase
{
    /**
     * @param $userId
     * @return string
     */
    public function __invoke($userId)
    {
        $accessToken = Str::random(80);

        User::where('user_id', $userId)->update([
            'access_token' => hash('sha256', $accessToken),
        ]);

        return $accessToken;
    }
}