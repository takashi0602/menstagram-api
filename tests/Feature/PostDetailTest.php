<?php

namespace Tests\Feature;

use App\Models\Post;
use Tests\Feature\DataProviders\PostDetailDataProvider;
use Tests\TestCase;

/**
 * 投稿詳細
 *
 * Class PostDetailTest
 * @package Tests\Feature
 */
class PostDetailTest extends TestCase
{
    use PostDetailDataProvider;

    protected $posts;

    /**
     * 初期化処理
     */
    public function setUp(): void
    {
        parent::setUp();
        parent::seeding([\CreatePostsSeeder::class]);
        $this->posts =  Post::all();
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
                        ->json('GET', '/api/v1/post/detail', [
                            'post_id' => 1,
                        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'id',
                'text',
                'images' => [],
                'liked',
                'is_liked',
                'created_at',
                'updated_at',
                'user' => [
                    'id',
                    'user_id',
                    'screen_name',
                    'avatar',
                ],
            ]);
    }

    /**
     * 異常系
     *
     * @test
     * @dataProvider postIdProvider
     * @param $postId
     */
    public function failCase($postId)
    {
        $accessToken = 'sQCeW8BEu0OvPULE1phO79gcenQevsamL2TA9yDruTinCAG1yfbNZn9O2udONJgLHH6psVWihISvCCqW';

        $response = $this
                        ->withHeader('Authorization', "Bearer $accessToken")
                        ->json('GET', '/api/v1/post/detail', [
                            'post_id' => $postId,
                        ]);

        $response
            ->assertStatus(400)
            ->assertJsonStructure([]);
    }
}
