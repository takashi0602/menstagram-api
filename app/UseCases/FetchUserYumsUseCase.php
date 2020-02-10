<?php

namespace App\UseCases;

use App\Models\Yum;
use App\Models\Slurp;

/**
 * ヤムした投稿一覧
 *
 * Class FetchUserYumsUseCase
 * @package App\UseCases
 */
class FetchUserYumsUseCase
{
    /**
     * @param null $slurpId
     * @param null $type
     * @return slurp[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function __invoke($slurpId = null, $type = null)
    {
        $userId = user()->id;

        $query = Slurp::with(['user:id,user_id,user_name,avatar']);

        if (is_null($slurpId) && is_null($type))                             $query->latest('id');
        else if (!is_null($slurpId) && (is_null($type) || $type === 'new'))  $query->where('id', '>=', $slurpId);
        else if (!is_null($slurpId) && $type === 'old')                      $query->where('id', '<=', $slurpId);

        $slurps = $query
                    ->whereHas('yums', function ($query) use ($userId) {
                        $query->where('user_id', $userId);
                    })
                    ->limit(10)
                    ->get();

        $slurps = collect($slurps)->map(function ($v, $k) use ($userId) {
            $yum = Yum::where('user_id', $userId)->where('slurp_id', $v->id)->first();
            $isYum = true;
            if (collect($yum)->isEmpty()) $isYum = false;

            return collect($v)
                        ->map(function ($v, $k) {
                            if ($k === 'user') return collect($v)->except(['id']);
                            return $v;
                        })
                        ->put('is_yum', $isYum)
                        ->except(['user_id']);
        });

        if (is_null($slurpId) && is_null($type)) $slurps = $slurps->reverse()->values();

        return $slurps;
    }
}