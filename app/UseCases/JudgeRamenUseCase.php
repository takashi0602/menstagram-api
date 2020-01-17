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
            'multipart' => $this->reshapeImages($images),
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

    /**
     * Guzzleのリクエスト用にimagesの形状を変換
     *
     * @param $images
     * @return array
     */
    private function reshapeImages($images)
    {
        $newImages = [];
        for ($i = 0; $i < collect($images)->count(); $i++) {
            $newImages[] = [
                'Content-type' => 'multipart/form-data',
                'name'     => 'image' . ($i + 1),
                'contents' => fopen('https://pbs.twimg.com/profile_images/1010246779252555776/7ECQc35k_400x400.jpg', 'r'),
            ];
        }
        return $newImages;
    }
}