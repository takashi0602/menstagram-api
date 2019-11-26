<?php

namespace Tests\Feature\DataProviders;

/**
 * グローバルタイムライン
 *
 * Trait TimelineGlobalDataProvider
 * @package Tests\Feature\DataProviders
 */
trait TimelineGlobalDataProvider
{
    /**
     * 正常系(type)のテストデータの定義
     *
     * @return array
     */
    public function typeProvider()
    {
        return [
            'typeがoldのパターン' => ['old'],
            'typeがnewのパターン' => ['new'],
        ];
    }
}