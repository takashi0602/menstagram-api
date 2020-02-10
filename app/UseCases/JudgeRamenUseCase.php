<?php

namespace App\UseCases;

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
        return $this->fetchJudgeRamenResponse($images);
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
            $tmp = tmpfile();
            fwrite($tmp, $images[$i]);
            fseek($tmp, 0);
            $newImages[] = [
                'Content-type' => 'multipart/form-data',
                'name'         => 'image' . ($i + 1),
                'contents'     => fopen(stream_get_meta_data($tmp)['uri'], 'r'),
            ];
        }
        return $newImages;
    }

    /**
     * ラーメン判定結果の取得
     *
     * @param $images
     * @return array
     */
    private function fetchJudgeRamenResponse($images)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->request('POST', env('MENSTAGRAM_AI_URL') . '/api/v1/ramen/judge', [
            'multipart' => $this->reshapeImages($images),
        ])->getBody();
        return (array)json_decode($response);
    }
}