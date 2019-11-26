<?php

namespace Tests\Feature\DataProviders;

/**
 * プライベートタイムライン
 *
 * Trait TimelineGlobalDataProvider
 * @package Tests\Feature\DataProviders
 */
trait TimelinePrivateDataProvider
{
    /**
     * 正常系(type)のテストデータの定義
     *
     * @return array
     */
    public function successTypeProvider()
    {
        return [
            'typeがoldのパターン' => ['old'],
            'typeがnewのパターン' => ['new'],
        ];
    }

    /**
     * 異常系(post_id)のテストデータの定義
     *
     * @return array
     */
    public function failPostIdProvider()
    {
        return [
            'post_idが空文字のパターン'   => [''],
            'post_idが存在しないパターン' => [999],
        ];
    }

    /**
     * 異常系(type)のテストデータの定義
     *
     * @return array
     */
    public function failTypeProvider()
    {
        return [
            'typeが存在しないパターン' => ['takashi'],
        ];
    }
}