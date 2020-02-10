<?php

namespace App\UseCases;

use App\Models\Slurp;

/**
 * スラープ(テキスト)
 *
 * Class SlurpTextUseCase
 * @package App\UseCases
 */
class SlurpTextUseCase
{
    /**
     * @param $request
     * @return bool
     */
    public function __invoke($request)
    {
        $post = Slurp::where('user_id', user()->id)->where('id', $request->post_id)->where('text', null)->first();
        if (collect($post)->isEmpty()) return false;

        $post->update([
            'text' => $request->text,
        ]);
        return true;
    }
}