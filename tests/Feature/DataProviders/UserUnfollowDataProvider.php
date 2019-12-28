<?php

namespace Tests\Feature\DataProviders;

/**
 * アンフォロー
 *
 * Trait UserUnfollowDataProvider
 */
trait UserUnfollowDataProvider
{
    /**
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
            // TODO: user_idとtarget_user_idが存在しないパターン
            'ユーザーIDとログインユーザーのユーザーIDが同一のパターン' => [$this->users[0]->user_id],
        ];
    }
}