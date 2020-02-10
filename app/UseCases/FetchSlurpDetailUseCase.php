<?php

namespace App\UseCases;

use App\Models\Yum;
use App\Models\Slurp;

/**
 * スラープ詳細の取得
 *
 * Class FetchSlurpDetailUseCase
 * @package App\UseCases
 */
class FetchSlurpDetailUseCase
{
    /**
     * @param $slurpId
     * @return \Illuminate\Support\Collection
     */
    public function __invoke($slurpId)
    {
        $userId = user()->id;

        $response = Slurp::where('id', $slurpId)
                            ->where('images', '<>', null)
                            ->with([
                                'user:id,user_id,user_name,avatar',
                                'limitedYums.user',
                            ])
                            ->first();

        $yum = Yum::where('user_id', $userId)->where('slurp_id', $slurpId)->first();
        $isYum = true;
        if (collect($yum)->isEmpty()) $isYum = false;
        $response = collect($response)->put('is_yum', $isYum);

        $response = $response->except(['user_id']);

        $response = $response->put('yums', $response['limited_yums']);
        $response = $response->except(['limited_yums']);

        $response['yums'] = collect($response['yums'])->map(function ($v, $k) {
            return [
                'user_id' => $v['user']['user_id'],
                'avatar'  => $v['user']['avatar'],
            ];
        });

        return $response;
    }
}