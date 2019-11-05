<?php

namespace Tests\Feature\DataProviders;

/**
 * ユーザーのログイン(異常系)
 *
 * Trait AuthLoginDataProvider
 * @package Tests\Feature\DataProviders
 */
trait AuthLoginDataProvider
{
    /**
     * 異常系(ユーザーID)のテストデータの定義
     *
     * @return array
     */
    public function userIdProvider()
    {
        return [
            'ユーザーIDが抜けているパターン' => [null],
            'ユーザーIDが空文字のパターン' => [''],
            'ユーザーIDがa-zA-Z0-9の範囲に無いパターン' => ['めんすたぐらむ'],
            'ユーザーIDが16文字を超えているパターン' => ['menstagraaaaaaaam'], // 17文字
            'ユーザーIDの条件は満たしているが存在しないユーザーIDのパターン' => ['takashi'],
        ];
    }

    /**
     * 異常系(パスワード)のテストデータの定義
     *
     * @return array
     */
    public function passwordProvider()
    {
        return [
            'パスワードが抜けているパターン' => [null],
            'パスワードが8文字よりも短いパターン' => ['mensta'],
            'パスワードを間違えているパターン' => ['takashi'],
        ];
    }
}