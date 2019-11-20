<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Http\UploadedFile;
use Tests\Feature\DataProviders\PostDataProvider;
use Tests\TestCase;

/**
 * 投稿
 *
 * Class PostTest
 * @package Tests\Feature
 */
class PostTest extends TestCase
{
    use PostDataProvider;

    protected $posts;

    /**
     * 初期化処理
     */
    public function setUp(): void
    {
        parent::setUp();
        parent::seeding(\CreatePostsSeeder::class);
        $this->posts = Post::all();
    }

    /**
     * 正常系
     *
     * @test
     */
    public function successCase()
    {
        $accessToken = 'sQCeW8BEu0OvPULE1phO79gcenQevsamL2TA9yDruTinCAG1yfbNZn9O2udONJgLHH6psVWihISvCCqW';

        $file = UploadedFile::fake()->image('test.jpg', 100, 100);

        $response = $this
                    ->withHeader('Authorization', "Bearer: $accessToken")
                    ->post('/api/v1/post/images', [
                        'image1' => $file,
                    ]);

        $postId = json_decode($response->content())->post_id;

        $response = $this
                        ->withHeader('Authorization', "Bearer: $accessToken")
                        ->post('/api/v1/post', [
                            'post_id'   => $postId,
                            'text'      => 'test',
                        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([]);
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
                        ->withHeader('Authorization', "Bearer: $accessToken")
                        ->post('/api/v1/post', [
                            'post_id'   => $postId,
                            'text'      => 'test',
                        ]);

        $response
            ->assertStatus(400)
            ->assertJsonStructure([]);
    }

    /**
     * 異常系(テキスト)
     *
     * @test
     * @dataProvider textProvider
     * @param $text
     */
    public function failTextCase($text)
    {
        $accessToken = 'sQCeW8BEu0OvPULE1phO79gcenQevsamL2TA9yDruTinCAG1yfbNZn9O2udONJgLHH6psVWihISvCCqW';

        $file = UploadedFile::fake()->image('test.jpg', 100, 100);

        $response = $this
                        ->withHeader('Authorization', "Bearer: $accessToken")
                        ->post('/api/v1/post/images', [
                            'image1' => $file,
                        ]);

        $postId = json_decode($response->content())->post_id;

        $response = $this
                        ->withHeader('Authorization', "Bearer: $accessToken")
                        ->post('/api/v1/post', [
                            'post_id'   => $postId,
                            'text'      => $text,
                        ]);

        $response
            ->assertStatus(400)
            ->assertJsonStructure([]);
    }
}
