<?php

namespace Tests\Feature;

use App\Models\User;
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

    /**
     * 初期化処理
     */
    public function setUp(): void
    {
        parent::setUp();
        Artisan::call('db:seed', ['--class' => \CreateUserSeeder::class]);
        $this->users = User::all();
    }

    /**
     * 正常系
     *
     * @test
     */
    public function successCase()
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
     * 異常系(ベース)
     *
     * @param $user
     * @param $userId
     */
    protected function failBaseCase($user, $userId)
    {
        $response = $this->post('/api/v1/auth/register', $user);
        $response->assertStatus(400);
        $this->assertDatabaseMissing('users', $user);
        $this->users->where('user_id', $userId)->each->delete();
    }

    /**
     * 異常系(ユーザーID)
     *
     * @test
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

        $this->failBaseCase($user, $userId);
    }

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
     * 異常系(スクリーンネーム)
     *
     * @test
     * @dataProvider screenNameProvider
     * @param $screenName
     */
    public function failScreenNameCase($screenName)
    {
        $user = [
            'user_id'       => 'Menstagram_9999',
            'screen_name'   => $screenName,
            'email'         => 'menstagram_9999@menstagram.com',
            'password'      => 'Menstagram_9999',
        ];

        $this->failBaseCase($user, $user['user_id']);
    }

    /**
     * 異常系(スクリーンネーム)のテストデータの定義
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
     * 異常系(メールアドレス)
     *
     * @test
     * @dataProvider emailProvider
     * @param $email
     */
    public function failEmailCase($email)
    {
        $user = [
            'user_id'       => 'Menstagram_9999',
            'screen_name'   => 'Menstagram9999',
            'email'         => $email,
            'password'      => 'Menstagram_9999',
        ];

        $this->failBaseCase($user, $user['user_id']);
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
     * 異常系(パスワード)
     *
     * @test
     * @dataProvider passwordProvider
     * @param $password
     */
    public function failPasswordCase($password)
    {
        $user = [
            'user_id'       => 'Menstagram_9999',
            'screen_name'   => 'Menstagram9999',
            'email'         => 'menstagram_9999@menstagram.com',
            'password'      => $password,
        ];

        $this->failBaseCase($user, $user['user_id']);
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
