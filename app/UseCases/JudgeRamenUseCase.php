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
     * @param $images
     * @return array
     */
    public function __invoke($images)
    {
        $client = new \GuzzleHttp\Client();
        $tmp = $client->request('POST', env('MENSTAGRAM_AI_URL') . '/api/v1/ramen/judge', [
            'form_params' => [
                'hoge' => 'hoge'
            ]
        ]);
        \Log::info($tmp->getBody());

        // TODO: 実際にはGuzzleを使用する
        $response = collect([
            Arr::random([true, false]),
            Arr::random([true, false]),
            Arr::random([true, false]),
            Arr::random([true, false]),
        ])->random(collect($images)->count())->all();

        return $response;
    }
}