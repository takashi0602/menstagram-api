<?php

namespace App\UseCases;

use Illuminate\Support\Arr;

/**
 * ラーメン判定
 *
 * Class JudgeRamenUseCase
 * @package App\UseCases
 */
class JudgeRamenUseCase
{
    /**
     * @param $request
     * @return array
     */
    public function __invoke($request)
    {
        $client = new \GuzzleHttp\Client();
        $hoge = $client->request('GET', env('MENSTAGRAM_AI_URL'));
//        \Log::info($hoge->getBody());

        // TODO: 実際にはGuzzleを使用する
        $response = collect([
            Arr::random([true, false]),
            Arr::random([true, false]),
            Arr::random([true, false]),
            Arr::random([true, false]),
        ])->random(collect($request)->count())->all();

        return $response;
    }
}