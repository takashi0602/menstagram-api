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
        $user = User::where('id', user()->id)->first();
        if ($request->has('screen_name')) $user->screen_name = $request->screen_name;
        if ($request->has('biography'))   $user->biography = $request->biography;
        $user->save();
    }
}