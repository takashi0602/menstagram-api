<?php

namespace App\UseCases;

use App\Models\User;
use Illuminate\Support\Str;

/**
 * ユーザーの登録
 *
 * Class TimelineUseCase
 * @package App\UseCases
 */
class TimelineUseCase
{
    /**
     * @param $userId
     * @param $screenName
     * @param $email
     * @param $password
     * @return string
     */
    public function __invoke($userId, $screenName, $email, $password)
    {
        $accessToken = Str::random(80);

        User::create([
            'user_id'       => $userId,
            'screen_name'   => $screenName,
            'email'         => $email,
            'password'      => bcrypt($password),
            'access_token'  => hash('sha256', $accessToken),
        ]);

        return $accessToken;
    }
}