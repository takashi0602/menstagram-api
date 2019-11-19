<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Http\UploadedFile;
use Tests\Feature\DataProviders\PostImagesDataProvider;
use Tests\TestCase;

/**
 * 画像送信
 *
 * Class PostImagesTest
 * @package Tests\Feature
 */
class PostImagesTest extends TestCase
{
    use PostImagesDataProvider;

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

        $response
            ->assertStatus(200)
            ->assertJsonStructure(['post_id']);

        // TODO: DBに存在するか確認

        // TODO: 画像が存在するか確認
    }

    /**
     * 異常系
     *
     * @test
     * @dataProvider imagesProvider
     * @param $file
     */
    public function failCase($file)
    {
        $accessToken = 'sQCeW8BEu0OvPULE1phO79gcenQevsamL2TA9yDruTinCAG1yfbNZn9O2udONJgLHH6psVWihISvCCqW';

        $response = $this
            ->withHeader('Authorization', "Bearer: $accessToken")
            ->post('/api/v1/post/images', [
                'image1' => $file,
            ]);

        $response
            ->assertStatus(400);
    }
}
