<?php

namespace Tests\Feature\DataProviders;

/**
 * 投稿
 *
 * Trait PostTextDataProvider
 * @package Tests\Feature\DataProviders
 */
trait PostTextDataProvider
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

    /**
     * 異常系(テキスト)
     *
     * @return array
     */
    public function textProvider()
    {
        return [
            'テキストが存在しないパターン'=> [null],
            'テキストが文字列ではないパターン'=> [0],
            'テキストが空白のパターン'=> [''],
            'テキストが256文字を超えるパターン'=> ['testtesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttest'],
        ];
    }
}