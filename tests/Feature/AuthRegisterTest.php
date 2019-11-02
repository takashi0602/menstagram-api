<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * ユーザー登録
 *
 * Class AuthRegisterTest
 * @package Tests\Feature
 */
class AuthRegisterTest extends TestCase
{
    public function testSuccess()
    {
        // TODO: ユーザーのデータを定義

        // TODO: ユーザーの登録

        // TODO: ステータスコードが200かどうか

        // TODO: 登録したユーザーのデータがDBに存在するかどうか
    }

    public function testFailUserId()
    {
        // TODO: ユーザーIDが抜けているパターン

        // TODO: ユーザーIDがa-zA-Z0-9の範囲に無いパターン

        // TODO: ユーザーIDが0文字のパターン

        // TODO: ユーザーIDが16文字を超えているパターン

        // TODO: すでにあるユーザーを登録しようとしているパターン
    }

    public function testFailScreenName()
    {
        // TODO: スクリーンネームが無いパターン

        // TODO: スクリーンネームが0文字のパターン

        // TODO: スクリーンネームが16文字を超えているパターン
    }

    public function testFailEmail()
    {
        // TODO: メールアドレスが無いパターン

        // TODO: メールアドレスの形式で無いパターン

        // TODO: すでにあるメールアドレスを登録しようとしているパターン
    }

    public function testFailPassword()
    {
        // TODO: パスワードが無いパターン

        // TODO: パスワードが8文字よりも短いパターン
    }
}
