<?php

namespace App\UseCases;

use App\Models\User;
use Carbon\Carbon;
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
            'access_token'             => hash('sha256', $accessToken),
            'access_token_deadline_at' => Carbon::now(),
        ]);

        return $accessToken;
    }
}