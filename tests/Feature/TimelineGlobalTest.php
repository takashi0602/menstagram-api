<?php

namespace Tests\Feature;

use Tests\Feature\DataProviders\TimelineGlobalDataProvider;
use Tests\TestCase;

/**
 * グローバルタイムライン
 *
 * Class GlobalTimelineTest
 * @package Tests\Feature
 */
class TimelineGlobalTest extends TestCase
{
    use TimelineGlobalDataProvider;

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
     * 正常系(post_idあり)
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
     * 正常系(post_id, typeあり)
     *
     * @test
     * @dataProvider successTypeProvider
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

    /**
     * 異常系(post_id)
     *
     * @test
     * @dataProvider failPostIdProvider
     * @param $postId
     */
    public function failPostIdCase($postId)
    {
        $response = $this->json('GET', '/api/v1/timeline/global', [
            'post_id'   => $postId,
        ]);

        $response
            ->assertStatus(400);
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
        $response = $this->json('GET', '/api/v1/timeline/global', [
            'post_id'   => 50,
            'type'      => $type,
        ]);

        $response
            ->assertStatus(400);
    }
}
