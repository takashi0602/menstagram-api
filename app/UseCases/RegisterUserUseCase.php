<?php

namespace App\UseCases;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

/**
 * ユーザーの登録
 *
 * Class RegisterUserUseCase
 * @package App\UseCases
 */
class RegisterUserUseCase
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
            'user_id'                  => $userId,
            'user_name'                => $screenName,
            'email'                    => $email,
            'password'                 => bcrypt($password),
            'avatar'                   => asset('avatars/default/000' . mt_rand(1, 7) . '.png'),
            'access_token'             => hash('sha256', $accessToken),
            'access_token_deadline_at' => Carbon::now(),
        ]);

        return $accessToken;
    }
}