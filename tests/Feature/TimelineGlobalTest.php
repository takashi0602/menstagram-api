<?php

namespace Tests\Feature;

use Tests\Feature\DataProviders\TimelineGlobalDataProvider;
use Tests\TestCase;

/**
 * ユーザーの登録
 *
 * Class GlobalTimelineTest
 * @package Tests\Feature
 */
class TimelineGlobalTest extends TestCase
{
    use TimelineGlobalDataProvider;

    protected $users;

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
        $response = $this->get('/api/v1/timeline/global');

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'text',
                    'images' => [
                        '*' => [],
                    ],
                    'user' => [
                        'id',
                        'screen_name',
                        'avatar',
                    ],
                    'liked',
                    'created_at',
                    'updated_at',
                ],
            ]);
    }

    /**
     * 正常系
     *
     * @test
     */
    public function successPostIdCase()
    {
        $response = $this->json('GET', '/api/v1/timeline/global', [
            'post_id' => 50,
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'text',
                    'images' => [
                        '*' => [],
                    ],
                    'user' => [
                        'id',
                        'screen_name',
                        'avatar',
                    ],
                    'liked',
                    'created_at',
                    'updated_at',
                ],
            ]);
    }

    /**
     * 正常系
     *
     * @test
     * @dataProvider typeProvider
     * @param $type
     */
    public function successTypeCase($type)
    {
        $response = $this->json('GET', '/api/v1/timeline/global', [
            'post_id'   => 50,
            'type'      => $type,
        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'text',
                    'images' => [
                        '*' => [],
                    ],
                    'user' => [
                        'id',
                        'screen_name',
                        'avatar',
                    ],
                    'liked',
                    'created_at',
                    'updated_at',
                ],
            ]);
    }
}
