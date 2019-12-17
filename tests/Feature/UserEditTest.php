<?php

namespace Tests\Feature;

use Tests\Feature\DataProviders\UserEditDataProvider;
use Tests\TestCase;

/**
 * ユーザーの編集
 *
 * Class UserEditTest
 * @package Tests\Feature
 */
class UserEditTest extends TestCase
{
    use UserEditDataProvider;

    /**
     * 初期化処理
     */
    public function setUp(): void
    {
        parent::setUp();
        parent::seeding([\CreateUsersSeeder::class, \CreatePostsSeeder::class]);
    }

    /**
     * 正常系
     *
     * @test
     */
    public function successCase()
    {
        $accessToken = 'sQCeW8BEu0OvPULE1phO79gcenQevsamL2TA9yDruTinCAG1yfbNZn9O2udONJgLHH6psVWihISvCCqW';
        $screenName = 'test';
        $biography = 'test';

        $response = $this
                        ->withHeader('Authorization', "Bearer $accessToken")
                        ->patch('/api/v1/user/edit', [
                            'screen_name' => $screenName,
                            'biography'   => $biography,
                        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([]);

        $this->assertDatabaseHas('users', [
            'screen_name' => $screenName,
            'biography'   => $biography,
        ]);
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
        $accessToken = 'sQCeW8BEu0OvPULE1phO79gcenQevsamL2TA9yDruTinCAG1yfbNZn9O2udONJgLHH6psVWihISvCCqW';

        $response = $this
                        ->withHeader('Authorization', "Bearer $accessToken")
                        ->patch('/api/v1/user/edit', [
                            'screen_name' => $screenName,
                            'biography'   => 'test',
                        ]);

        $response
            ->assertStatus(400)
            ->assertJsonStructure([]);
    }

    /**
     * 異常系(bio)
     *
     * @test
     * @dataProvider biographyProvider
     * @param $biography
     */
    public function failBiographyCase($biography)
    {
        $accessToken = 'sQCeW8BEu0OvPULE1phO79gcenQevsamL2TA9yDruTinCAG1yfbNZn9O2udONJgLHH6psVWihISvCCqW';

        $response = $this
                        ->withHeader('Authorization', "Bearer $accessToken")
                        ->patch('/api/v1/user/edit', [
                            'screen_name' => 'test',
                            'biography'   => $biography,
                        ]);

        $response
            ->assertStatus(400)
            ->assertJsonStructure([]);
    }
}
