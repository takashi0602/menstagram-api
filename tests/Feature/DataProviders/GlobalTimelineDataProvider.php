<?php

namespace Tests\Feature\DataProviders;

/**
 * グローバルタイムライン(異常系)
 *
 * Trait GlobalTimelineDataProvider
 * @package Tests\Feature\DataProviders
 */
trait GlobalTimelineDataProvider
{
    /**
     * 異常系(PostId)のテストデータの定義
     *
     * @return array
     */
    public function PostIdProvider()
    {
        return [
            'PostIdが無いパターン' => [null],
            'PostIdが文字列のパターン' => ['takashi']
        ];
    }
}