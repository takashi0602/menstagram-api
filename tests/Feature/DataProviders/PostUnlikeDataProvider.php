<?php

namespace Tests\Feature\DataProviders;

/**
 * いいねを外す
 *
 * Trait PostUnlikeDataProvider
 * @package Tests\Feature\DataProviders
 */
trait PostUnlikeDataProvider
{
    /**
     * 異常系(投稿ID)
     *
     * @return array
     */
    public function postIdProvider()
    {
        return [
            '投稿IDが存在しないパターン'     => [null],
            '投稿IDが数値ではないパターン'   => ['test'],
            '投稿IDが有効ではないパターン'   => [999],
        ];
    }
}