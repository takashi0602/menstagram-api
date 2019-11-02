<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

/**
 * ユーザー登録
 *
 * Class AuthRegisterTest
 * @package Tests\Feature
 */
class AuthRegisterTest extends TestCase
{
    /**
     * 正常系のテスト
     */
    public function testSuccess()
    {
        $user = [
            'user_id'       => 'Menstagram9999',
            'screen_name'   => 'Menstagram9999',
            'email'         => 'menstagram9999@menstagram.com',
            'password'      => 'Menstagram9999',
        ];

        Artisan::call('db:seed', ['--class' => \CreateUserSeeder::class]);

        $response = $this->post('/api/v1/auth/register', $user);

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['access_token']);

        $this->assertDatabaseHas('users', [
            'user_id'       => $user['user_id'],
            'screen_name'   => $user['screen_name'],
            'email'         => $user['email'],
        ]);
    }

//    public function testFailUserId()
//    {
//        // TODO: ユーザーIDが抜けているパターン
//
//        // TODO: ユーザーIDがa-zA-Z0-9の範囲に無いパターン
//
//        // TODO: ユーザーIDが0文字のパターン
//
//        // TODO: ユーザーIDが16文字を超えているパターン
//
//        // TODO: すでにあるユーザーを登録しようとしているパターン
//    }

//    public function testFailScreenName()
//    {
//        // TODO: スクリーンネームが無いパターン
//
//        // TODO: スクリーンネームが0文字のパターン
//
//        // TODO: スクリーンネームが16文字を超えているパターン
//    }

//    public function testFailEmail()
//    {
//        // TODO: メールアドレスが無いパターン
//
//        // TODO: メールアドレスの形式で無いパターン
//
//        // TODO: すでにあるメールアドレスを登録しようとしているパターン
//    }

//    public function testFailPassword()
//    {
//        // TODO: パスワードが無いパターン
//
//        // TODO: パスワードが8文字よりも短いパターン
//    }
}
