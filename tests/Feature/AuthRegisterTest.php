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
    protected $users;

    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('db:seed', ['--class' => \CreateUserSeeder::class]);
        $this->users = User::all();
    }

    /**
     * 正常系
     */
    public function testSuccess()
    {
        $user = [
            'user_id'       => 'Menstagram_9999',
            'screen_name'   => 'Menstagram_9999',
            'email'         => 'menstagram_9999@menstagram.com',
            'password'      => 'Menstagram_9999',
        ];

        $response = $this->post('/api/v1/auth/register', $user);

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['access_token']);

        $this->assertDatabaseHas('users', [
            'user_id'       => $user['user_id'],
            'screen_name'   => $user['screen_name'],
            'email'         => $user['email'],
        ]);

        $this->users->where('user_id', $user['user_id'])->each->delete();
    }

    /**
     * 異常系(ユーザーID)
     *
     * @dataProvider userIdProvider
     * @param $userId
     */
    public function testFailUserId($userId)
    {
        $user = [
            'user_id'       => $userId,
            'screen_name'   => 'Menstagram9999',
            'email'         => 'menstagram9999@menstagram.com',
            'password'      => 'Menstagram9999',
        ];

        $response = $this->post('/api/v1/auth/register', $user);

        $response->assertStatus(400);

        $this->assertDatabaseMissing('users', $user);

        $this->users->where('user_id', $userId)->each->delete();
    }

    /**
     * ユーザーIDのテストデータの定義
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
