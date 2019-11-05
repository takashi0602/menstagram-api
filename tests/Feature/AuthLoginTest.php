<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
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
        Model::unguard();
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Artisan::call('db:seed', ['--class' => \CreateUserSeeder::class]);
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        Model::reguard();
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
