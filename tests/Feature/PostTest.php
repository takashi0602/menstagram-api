<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Http\UploadedFile;
use Tests\Feature\DataProviders\PostDataProvider;
use Tests\TestCase;

/**
 * 画像投稿
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
        parent::seeding([\CreatePostsSeeder::class]);
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
                        ->withHeader('Authorization', "Bearer $accessToken")
                        ->post('/api/v1/post', [
                            'image1' => $file,
                        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                'post_id',
                'is_ramen',
            ]);

        $this->assertDatabaseHas('posts', [
            'id' => json_decode($response->content())->post_id,
        ]);
    }

    /**
     * 異常系(画像)
     *
     * @test
     * @dataProvider imagesProvider
     * @param $file
     */
    public function failImagesCase($file)
    {
        $accessToken = 'sQCeW8BEu0OvPULE1phO79gcenQevsamL2TA9yDruTinCAG1yfbNZn9O2udONJgLHH6psVWihISvCCqW';

        $response = $this
            ->withHeader('Authorization', "Bearer $accessToken")
            ->post('/api/v1/post', [
                'image1' => $file,
            ]);

        $response
            ->assertStatus(400)
            ->assertJsonStructure([]);
    }
}
