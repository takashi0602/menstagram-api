<?php

namespace App\UseCases;

use App\Models\Yum;
use App\Models\Slurp;
use Illuminate\Support\Facades\DB;

/**
 * ヤム
 *
 * Class YumUseCase
 * @package App\UseCases
 */
class YumUseCase
{
    /**
     * @param $slurpId
     * @return bool
     */
    public function __invoke($slurpId)
    {
        $userId = user()->id;

        $yum = Yum::where('user_id', $userId)->where('slurp_id', $slurpId)->get();
        if (collect($yum)->isNotEmpty()) return false;

        DB::transaction(function () use ($userId, $slurpId) {
            Slurp::where('id', $slurpId)->increment('yum_count');

            Yum::create([
                'user_id'  => $userId,
                'slurp_id' => $slurpId,
            ]);
        }, 5);

        return true;
    }
}