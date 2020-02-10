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
        $slurp = Slurp::where('user_id', user()->id)->where('id', $request->slurp_id)->where('text', null)->first();
        if (collect($slurp)->isEmpty()) return false;

        $slurp->update([
            'text' => $request->text,
        ]);
        return true;
    }
}