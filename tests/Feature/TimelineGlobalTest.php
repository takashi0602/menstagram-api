<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Arr;
use Tests\Feature\DataProviders\GlobalTimelineDataProvider;
use Tests\TestCase;

/**
 * ユーザーの登録
 *
 * Class GlobalTimelineTest
 * @package Tests\Feature
 */
class TimelineGlobalTest extends TestCase
{
    use GlobalTimelineDataProvider;

    protected $users;

    /**
     * 初期化処理
     */
    public function setUp(): void
    {
        parent::setUp();
        parent::seeding([\CreateUsersSeeder::class, \CreatePostsSeeder::class]);
        $this->users = User::all();
        $this->posts = Post::orderBy('id', 'DESC')->get();
    }

    /**
     * 正常系
     *
     * @test
     */
    public function successCase()
    {
        $response = $this->get('/api/v1/timeline/global');

        $response->assertStatus(200)
            ->assertJsonStructure([
                '*' => [
                    'id',
                    'text',
                    'images' => [
                        '*' => []
                    ],
                    'user' => [
                        'user_id',
                        'screen_name',
                        'avatar'
                    ],
                    'liked',
                    'created_at',
                    'updated_at'
                ]
            ]);
            // assertJsonCount(32) // でレスポンスデータの数を照らし合わせれるけど、本番時初期に数は減るのでやめる
    }

    /**
     * 正常系
     * 「もっと読む」リクエストのときのパターン
     *
     * @test
     */
    public function successCaseRequested()
    {
        $post = Arr::first($this->posts, function ($value, $key) {
            return $value->id !== null;
        });
        $accessToken = 'sQCeW8BEu0OvPULE1phO79gcenQevsamL2TA9yDruTinCAG1yfbNZn9O2udONJgLHH6psVWihISvCCqW';

        $request = [];

        $response = $this
            ->withHeader('Authorization', "Bearer: $accessToken")
            ->get('/api/v1/timeline/global',[
                'post_id' => $post->id
            ]);

        $response->assertStatus(200)
            ->assertJsonStructure([ // Json形式を指定
                '*' => [
                    'id',
                    'text',
                    'images' => [
                        '*' => []
                    ],
                    'user' => [
                        'user_id',
                        'screen_name',
                        'avatar'
                    ],
                    'liked',
                    'created_at',
                    'updated_at'
                ]
            ]);
            // assertJsonCount(32) // でレスポンスデータの数を照らし合わせれるけど、本番時初期に数は減るのでやめる
    }

    /**
     * 異常系(グローバルタイムライン)
     *
     * @test
     * @dataProvider PostIdProvider
     * @param $postId
     */
    public function failUserIdCase($postId)
    {
        $accessToken = 'sQCeW8BEu0OvPULE1phO79gcenQevsamL2TA9yDruTinCAG1yfbNZn9O2udONJgLHH6psVWihISvCCqW';

        $response = $this
            ->withHeader('Authorization', "Bearer: $accessToken")
            ->json('get','/api/v1/timeline/global',[
                'post_id' => $postId
            ]);
        $response->assertStatus(400);
    }
}
