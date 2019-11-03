<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

/**
 * ユーザーのログイン
 *
 * Class AuthLoginTest
 * @package Tests\Feature
 */
class AuthLoginTest extends TestCase
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
            'user_id'       => $this->users[0]->user_id,
            'password'      => 'menstagram',
        ];

        $response = $this->post('/api/v1/auth/login', $user);

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['access_token']);
    }

    /**
     * 異常系(ベース)
     *
     * @param $user
     */
    protected function failBaseCase($user)
    {
        $response = $this->post('/api/v1/auth/login', $user);
        $response->assertStatus(400);
        $this->assertDatabaseMissing('users', $user);
    }

    /**
     * 異常系(ユーザーID)
     *
     * @test
     * @dataProvider userIdProvider
     * @param $userId
     */
    public function failUserIdCase($userId)
    {
        $user = [
            'user_id'   => $userId,
            'password'  => 'menstagram',
        ];

        $this->failBaseCase($user);
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
            'ユーザーIDの条件は満たしているが存在しないユーザーIDのパターン' => ['takashi'],
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
            'user_id'   => $this->users[0]->user_id,
            'password'  => $password,
        ];

        $this->failBaseCase($user);
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
