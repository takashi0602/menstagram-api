<?php

namespace Tests\Feature\DataProviders;

/**
 * ヤム
 *
 * Trait SlurpYumDataProvider
 * @package Tests\Feature\DataProviders
 */
trait SlurpYumDataProvider
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