<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\Feature\DataProviders\AuthLoginDataProvider;
use Tests\TestCase;

/**
 * ユーザーのログイン
 *
 * Class AuthLoginTest
 * @package Tests\Feature
 */
class AuthLoginTest extends TestCase
{
    use AuthLoginDataProvider;

    protected $users;

    /**
     * 初期化処理
     */
    public function setUp(): void
    {
        parent::setUp();
        parent::seeding([\CreateUsersSeeder::class]);
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
        $response
            ->assertStatus(400)
            ->assertJsonStructure([]);
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
}
