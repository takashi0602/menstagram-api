<?php

namespace Tests\Feature\DataProviders;

/**
 * ユーザーの登録
 *
 * Trait AuthRegisterDataProvider
 * @package Tests\Feature\DataProviders
 */
trait AuthRegisterDataProvider
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
            'ユーザーIDがすでに存在するパターン' => [$this->users[0]->user_id],
        ];
    }

    /**
     * 異常系(ユーザーネーム)のテストデータの定義
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
     * 異常系(メールアドレス)のテストデータの定義
     *
     * @return array
     */
    public function emailProvider()
    {
        return [
            'メールアドレスが抜けているパターン' => [null],
            'メールアドレスの形式で無いパターン' => ['menstagram'],
            'メールアドレスがすでに存在するパターン' => [$this->users[0]->email],
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
        ];
    }
}