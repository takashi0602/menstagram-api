<?php

namespace Tests\Feature\DataProviders;

/**
 * スラープを外す
 *
 * Trait SlurpUnyumDataProvider
 * @package Tests\Feature\DataProviders
 */
trait SlurpUnyumDataProvider
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