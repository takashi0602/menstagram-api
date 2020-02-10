<?php

namespace App\UseCases;

use App\Models\Yum;
use App\Models\Slurp;
use Illuminate\Support\Facades\DB;

/**
 * ヤムを外す
 *
 * Class UnyumUseCase
 * @package App\UseCases
 */
class UnyumUseCase
{
    /**
     * @param $slurpId
     * @return bool
     */
    public function __invoke($slurpId)
    {
        $userId = user()->id;

        $yum = Yum::where('user_id', $userId)->where('slurp_id', $slurpId)->get();
        if (collect($yum)->isEmpty()) return false;

        DB::transaction(function () use ($userId, $slurpId) {
            Slurp::where('id', $slurpId)->decrement('yum_count');
            Yum::where('user_id', $userId)->where('slurp_id', $slurpId)->delete();
        }, 5);

        return true;
    }
}