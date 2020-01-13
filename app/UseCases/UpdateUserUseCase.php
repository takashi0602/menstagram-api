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
        // TODO: 暫定対応
        // TODO: バリデーションで対応するのが理想
        if ($request->has('biography') && !$request->biography) $request->biography = '';

        $user = User::where('id', user()->id)->first();
        if ($request->has('screen_name')) $user->screen_name = $request->screen_name;
        if ($request->has('biography'))   $user->biography = $request->biography;
        $user->save();
    }
}