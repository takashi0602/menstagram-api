<?php

namespace Tests\Feature;

use App\Models\Like;
use Tests\Feature\DataProviders\PostUnlikeDataProvider;
use Tests\TestCase;

/**
 * いいねを外す
 *
 * Class PostUnlikeTest
 * @package Tests\Feature
 */
class PostUnlikeTest extends TestCase
{
    use PostUnlikeDataProvider;

    protected $likes;

    /**
     * 初期化処理
     */
    public function setUp(): void
    {
        parent::setUp();
        parent::seeding([\CreatePostsSeeder::class, \CreateLikesSeeder::class]);
        $this->likes = Like::all();
    }

    /**
     * 正常系
     *
     * @test
     */
    public function successCase()
    {
        $accessToken = 'sQCeW8BEu0OvPULE1phO79gcenQevsamL2TA9yDruTinCAG1yfbNZn9O2udONJgLHH6psVWihISvCCqW';
        $userId = 1;
        $postId = 1;

        $this->likes->where('user_id', $userId)->where('post_id', $postId)->each->delete();

        $this
            ->withHeader('Authorization', "Bearer $accessToken")
            ->post('/api/v1/post/like', [
                'post_id' => $postId,
            ]);

        $response = $this
                        ->withHeader('Authorization', "Bearer $accessToken")
                        ->post('/api/v1/post/unlike', [
                            'post_id' => $postId,
                        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([]);

        $this->assertDatabaseMissing('likes', [
            'user_id' => $userId,
            'post_id' => $postId,
        ]);
    }

    /**
     * 異常系(投稿ID)
     *
     * @test
     * @dataProvider postIdProvider
     * @param $postId
     */
    public function failPostIdCase($postId)
    {
        $accessToken = 'sQCeW8BEu0OvPULE1phO79gcenQevsamL2TA9yDruTinCAG1yfbNZn9O2udONJgLHH6psVWihISvCCqW';

        $response = $this
                        ->withHeader('Authorization', "Bearer $accessToken")
                        ->post('/api/v1/post/unlike', [
                            'post_id' => $postId,
                        ]);

        $response
            ->assertStatus(400)
            ->assertJsonStructure([]);
    }

    /**
     * 異常系(いいねされていない投稿のパターン)
     *
     * @test
     */
    public function failNotExistsCase()
    {
        $accessToken = 'sQCeW8BEu0OvPULE1phO79gcenQevsamL2TA9yDruTinCAG1yfbNZn9O2udONJgLHH6psVWihISvCCqW';
        $postId = 1;

        $this->likes->where('user_id', 1)->where('post_id', $postId)->each->delete();

        $response = $this
                        ->withHeader('Authorization', "Bearer $accessToken")
                        ->post('/api/v1/post/unlike', [
                            'post_id' => $postId,
                        ]);

        $response
            ->assertStatus(400)
            ->assertJsonStructure([]);
    }
}
