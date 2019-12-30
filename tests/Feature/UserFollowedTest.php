<?php

namespace Tests\Feature;

use Tests\Feature\DataProviders\UserFollowedDataProvider;
use Tests\TestCase;

/**
 * フォロワー一覧
 *
 * Class UserFollowedTest
 * @package Tests\Feature
 */
class UserFollowedTest extends TestCase
{
    use UserFollowedDataProvider;

    /**
     * 初期化処理
     */
    public function setUp(): void
    {
        parent::setUp();
        parent::seeding([\CreateUsersSeeder::class, \CreateFollowsSeeder::class]);
    }

    /**
     * 正常系
     *
     * @test
     */
    public function successCase()
    {
        $accessToken = 'sQCeW8BEu0OvPULE1phO79gcenQevsamL2TA9yDruTinCAG1yfbNZn9O2udONJgLHH6psVWihISvCCqW';

        $response = $this
            ->withHeader('Authorization', "Bearer $accessToken")
            ->get('/api/v1/user/followed');

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' => [
                    'user_id',
                    'screen_name',
                    'avatar',
                ]
            ]);
    }

    /**
     * 正常系(ユーザーIDの指定あり)
     *
     * @test
     */
    public function successUserIdCase()
    {
        $accessToken = 'sQCeW8BEu0OvPULE1phO79gcenQevsamL2TA9yDruTinCAG1yfbNZn9O2udONJgLHH6psVWihISvCCqW';

        $response = $this
            ->withHeader('Authorization', "Bearer $accessToken")
            ->json('GET', '/api/v1/user/followed', [
                'user_id' => 'menstagram',
            ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' => [
                    'user_id',
                    'screen_name',
                    'avatar',
                ]
            ]);
    }

    /**
     * 正常系(フォローIDの指定あり)
     *
     * @test
     */
    public function successFollowIdCase()
    {
        $accessToken = 'sQCeW8BEu0OvPULE1phO79gcenQevsamL2TA9yDruTinCAG1yfbNZn9O2udONJgLHH6psVWihISvCCqW';

        $response = $this
            ->withHeader('Authorization', "Bearer $accessToken")
            ->json('GET', '/api/v1/user/followed', [
                'follow_id' => 5,
            ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' => [
                    'user_id',
                    'screen_name',
                    'avatar',
                ]
            ]);
    }

    /**
     * 正常系(フォローID, typeの指定あり)
     *
     * @test
     * @dataProvider successTypeProvider
     * @param $type
     */
    public function successTypeCase($type)
    {
        $accessToken = 'sQCeW8BEu0OvPULE1phO79gcenQevsamL2TA9yDruTinCAG1yfbNZn9O2udONJgLHH6psVWihISvCCqW';

        $response = $this
            ->withHeader('Authorization', "Bearer $accessToken")
            ->json('GET', '/api/v1/user/followed', [
                'follow_id' => 5,
                'type'      => $type,
            ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' => [
                    'user_id',
                    'screen_name',
                    'avatar',
                ]
            ]);
    }

    /**
     * 異常系(ユーザーID)
     *
     * @test
     * @dataProvider failUserIdProvider
     * @param $userId
     */
    public function failUserIdCase($userId)
    {
        $accessToken = 'sQCeW8BEu0OvPULE1phO79gcenQevsamL2TA9yDruTinCAG1yfbNZn9O2udONJgLHH6psVWihISvCCqW';

        $response = $this
            ->withHeader('Authorization', "Bearer $accessToken")
            ->json('GET', '/api/v1/user/followed', [
                'user_id' => $userId,
            ]);

        $response
            ->assertStatus(400)
            ->assertJsonStructure([]);
    }

    /**
     * 異常系(フォローID)
     *
     * @test
     * @dataProvider failFollowIdProvider
     * @param $followId
     */
    public function failFollowIdCase($followId)
    {
        $accessToken = 'sQCeW8BEu0OvPULE1phO79gcenQevsamL2TA9yDruTinCAG1yfbNZn9O2udONJgLHH6psVWihISvCCqW';

        $response = $this
            ->withHeader('Authorization', "Bearer $accessToken")
            ->json('GET', '/api/v1/user/followed', [
                'follow_id' => $followId,
            ]);

        $response
            ->assertStatus(400)
            ->assertJsonStructure([]);
    }

    /**
     * 異常系(type)
     *
     * @test
     * @dataProvider failTypeProvider
     * @param $type
     */
    public function failTypeCase($type)
    {
        $accessToken = 'sQCeW8BEu0OvPULE1phO79gcenQevsamL2TA9yDruTinCAG1yfbNZn9O2udONJgLHH6psVWihISvCCqW';

        $response = $this
            ->withHeader('Authorization', "Bearer $accessToken")
            ->json('GET', '/api/v1/user/followed', [
                'type' => $type,
            ]);

        $response
            ->assertStatus(400)
            ->assertJsonStructure([]);
    }
}
