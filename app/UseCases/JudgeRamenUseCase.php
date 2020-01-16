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