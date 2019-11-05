<?php

namespace App\UseCases;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * ユーザーの存在チェック
 *
 * Class UseCase
 * @package App\UseCases
 */
class ExistsUserUseCase
{
    /**
     * @param $userId
     * @param $password
     * @return bool
     */
    public function __invoke($userId, $password)
    {
        $user = User::where('user_id', $userId)->first();
        if (!Hash::check($user->password, $password)) return true;
        return false;
    }
}