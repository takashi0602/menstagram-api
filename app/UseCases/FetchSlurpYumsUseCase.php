<?php

namespace App\UseCases;

use App\Models\Follow;
use App\Models\Yum;

/**
 * ヤムしたユーザー一覧の取得
 *
 * Class FetchSlurpYumsUseCase
 * @package App\UseCases
 */
class FetchSlurpYumsUseCase
{
    /**
     * @param $slurpId
     * @return \Illuminate\Support\Collection
     */
    public function __invoke($slurpId)
    {
        $yums = Yum::where('slurp_id', $slurpId)
                        ->with(['user'])
                        ->orderBy('id', 'desc')
                        ->limit(100)
                        ->get();

        $userIds = [];
        foreach ($yums as $yum) {
            $userIds[] = $yum->user->id;
        }

        $follows = Follow::where('user_id', user()->id)
                            ->whereIn('target_user_id', $userIds)
                            ->get();

        $followIds = collect($follows)->map(function ($v, $k) {
            return $v->target_user_id;
        });

        $response = collect($yums)->map(function ($v, $k) use ($followIds) {
            return [
                'user_id'      => $v['user']['user_id'],
                'user_name'    => $v['user']['user_id'],
                'avatar'       => $v['user']['avatar'],
                'is_following' => collect($followIds)->contains($v['user']['id']) ? true : false,
                'is_me'        => user()->id === $v['user']['id'] ? true : false,
            ];
        });

        return $response;
    }
}