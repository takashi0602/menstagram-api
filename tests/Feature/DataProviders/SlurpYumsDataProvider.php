<?php

namespace Tests\Feature\DataProviders;

/**
 * スラープにヤムしたユーザー一覧
 *
 * Trait PostDetailDataProvider
 * @package Tests\Feature\DataProviders
 */
trait SlurpYumsDataProvider
{
    /**
     * 異常系(スラープID)
     *
     * @return array
     */
    public function slurpIdProvider()
    {
        return [
            'スラープIDが存在しないパターン' => [null],
            'スラープIDが数値ではないパターン' => ['test'],
            'スラープIDが有効ではないパターン' => [999],
        ];
    }
}