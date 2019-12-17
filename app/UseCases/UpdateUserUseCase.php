<?php

namespace App\UseCases;

use App\Models\User;

/**
 * ユーザー情報の更新
 *
 * Class UpdateUserUseCase
 * @package App\UseCases
 */
class UpdateUserUseCase
{
    /**
     * @param $request
     */
    public function __invoke($request)
    {
        $userId = user()->id;

        User::where('id', $userId)->update([
            'screen_name' => $request->screen_name,
            'biography'   => $request->biography,
        ]);
    }
}