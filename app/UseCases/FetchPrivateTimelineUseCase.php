<?php

namespace App\UseCases;

use App\Models\Follow;
use App\Models\Yum;
use App\Models\Slurp;

/**
 * プライベートタイムライン
 *
 * Class FetchPrivateTimelineUseCase
 * @package App\UseCases
 */
class FetchPrivateTimelineUseCase
{
    /**
     * @param null $slurpId
     * @param null $type
     * @return Slurp[]|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Support\Collection
     */
    public function __invoke($slurpId = null, $type = null)
    {
        $userId = user()->id;

        $followIds = collect(Follow::where('user_id', $userId)->get())->map(function ($v, $k) {
            return $v->target_user_id;
        })->push($userId);

        $query = Slurp::with(['user:id,user_id,user_name,avatar']);

        if (is_null($slurpId) && is_null($type))                             $query->latest('id');
        else if (!is_null($slurpId) && (is_null($type) || $type === 'new'))  $query->where('id', '>=', $slurpId);
        else if (!is_null($slurpId) && $type === 'old')                      $query->where('id', '<=', $slurpId)->orderBy('id', 'desc');

        $slurps = $query
                    ->whereIn('user_id', $followIds)
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

        if ($type !== 'new') $slurps = $slurps->reverse()->values();

        return $slurps;
    }
}