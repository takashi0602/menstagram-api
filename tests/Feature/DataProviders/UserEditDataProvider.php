<?php

namespace Tests\Feature\DataProviders;

/**
 * ユーザー編集
 *
 * Trait UserEditDataProvider
 * @package Tests\Feature\DataProviders
 */
trait UserEditDataProvider
{
    /**
     * 正常系(スクリーンネーム)のテストデータの定義
     *
     * @return array
     */
    public function screenNameProvider()
    {
        return [
            'スクリーンネームが抜けているパターン' => [null],
            'スクリーンネームが空文字のパターン' => [''],
            'スクリーンネームが16文字を超えているパターン' => ['menstagraaaaaaaam'], // 17文字
        ];
    }

    /**
     * 正常系(bio)のテストデータの定義
     *
     * @return array
     */
    public function biographyProvider()
    {
        return [
            'bioが抜けているパターン' => [null],
            'bioが空文字のパターン' => [''],
            'bioが16文字を超えているパターン' => ['aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'],
        ];
    }
}