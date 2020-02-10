<?php

namespace Tests\Feature\DataProviders;

/**
 * スラープ詳細
 *
 * Trait SlurpDetailDataProvider
 * @package Tests\Feature\DataProviders
 */
trait SlurpDetailDataProvider
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