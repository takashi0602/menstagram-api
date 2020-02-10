<?php

namespace Tests\Feature\DataProviders;

/**
 * フォロー
 *
 * Trait UserPostFollowDataProvider
 * @package Tests\Feature\DataProviders
 */
trait UserPostFollowDataProvider
{
    /**
     * 異常系(ユーザーID)のテストデータの定義
     *
     * @return array
     */
    public function targetUserIdProvider()
    {
        return [
            'ユーザーIDが抜けているパターン' => [null],
            'ユーザーIDが空文字のパターン' => [''],
            'ユーザーIDがa-zA-Z0-9の範囲に無いパターン' => ['めんすたぐらむ'],
            'ユーザーIDが16文字を超えているパターン' => ['menstagraaaaaaaam'], // 17文字
            'ユーザーIDが存在しないパターン' => ['hoge'],
            // TODO: user_idとtarget_user_idがすでに存在するパターン
            'ユーザーIDとログインユーザーのユーザーIDが同一のパターン' => [$this->users[0]->user_id],
        ];
    }
}