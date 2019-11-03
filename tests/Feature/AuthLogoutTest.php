<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

/**
 * ユーザーのログアウト
 *
 * Class AuthLogoutTest
 * @package Tests\Feature
 */
class AuthLogoutTest extends TestCase
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
        $accessToken = Arr::first($this->users, function ($value, $key) {
            return $value->access_token !== null;
        })['access_token'];

        $response = $this
                        ->withHeader('Authorization', "Bearer: $accessToken")
                        ->post('/api/v1/auth/logout');

        $response
            ->assertStatus(200)
            ->assertJsonStructure([]);

        // TODO: アクセストークンが消えていることを確認する
    }

    /**
     * 異常系
     *
     * @test
     * @dataProvider accessTokenProvider
     * @param $accessToken
     */
    public function failCase($accessToken)
    {
        $response = $this
            ->withHeader('Authorization', $accessToken)
            ->post('/api/v1/auth/logout');

        $response
            ->assertStatus(401)
            ->assertJsonStructure([]);
    }

    /**
     * 異常系(アクセストークン)のテストデータの定義
     *
     * @return array
     */
    public function accessTokenProvider()
    {
        return [
//            'アクセストークンが無いパターン' => [null],
            'AuthorizationヘッダがBearerではないパターン' => ['takashi'],
            'アクセストークンが短いパターン' => ['Bearer: takashi'],
            'アクセストークンが長いパターン' => ['Bearer: takashitakashitakashitakashitakashitakashitakashitakashitakashitakashi'],
        ];
    }
}
