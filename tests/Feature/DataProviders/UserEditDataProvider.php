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
     * 正常系(ユーザーネーム)のテストデータの定義
     *
     * @return array
     */
    public function userNameProvider()
    {
        return [
            'ユーザーネームが抜けているパターン' => [null],
            'ユーザーネームが空文字のパターン' => [''],
            'ユーザーネームが16文字を超えているパターン' => ['menstagraaaaaaaam'], // 17文字
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
            'bioが16文字を超えているパターン' => ['aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'],
        ];
    }
}