<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Arr;
// use Tests\Feature\DataProviders\GlobalTimelineDataProvider;
use Tests\TestCase;

/**
 * ユーザーの登録
 *
 * Class GlobalTimelineTest
 * @package Tests\Feature
 */
class GlobalTimelineTest extends TestCase
{
    // use GlobalTimelineDataProvider;

    protected $users;

    /**
     * 初期化処理
     */
    public function setUp(): void
    {
        parent::setUp();
        parent::seeding(\CreateUserSeeder::class);
        $this->users = User::all();
        parent::seeding(\CreatePostSeeder::class);
        $this->posts = Post::all();
    }

    /**
     * 正常系
     *
     * @test
     */
    public function successCase()
    {
        $user = Arr::first($this->users, function ($value, $key) {
            return $value->access_token !== null;
        });
        $post = Arr::last($this->posts, function ($value, $key) {
            return $value->id !== null;
        });
        $accessToken = 'sQCeW8BEu0OvPULE1phO79gcenQevsamL2TA9yDruTinCAG1yfbNZn9O2udONJgLHH6psVWihISvCCqW';

        $request = [];

        $response = $this
            ->withHeader('Authorization', "Bearer: $accessToken")
            ->get('/api/v1/timeline/global');

        $response->assertStatus(200)
            ->assertJson([
                'id'                => $post->id,
                // 'text'              => $post->text,
                // 'images'            => ['http://placehold.it/300x300'],
                // 'user'              => [
                //     'user_id'       => 'TestUser',
                //     'screen_name'   => 'test',
                //     'avatar'        => 'image_path'
                // ],
                // 'liked'             => 123,
                // 'created_at'        => '2019-11-11T11:11:11.000000Z',
                // 'updated_at'        => '2019-11-11T11:11:11.000000Z',
            ]);


        // $this->assertDatabaseHas('posts', [
        //     'user_id'       => $user['user_id'],
        //     'screen_name'   => $user['screen_name'],
        //     'email'         => $user['email'],
        // ]);
    }

    /**
     * 異常系(ベース)
     *
     * @param $user
     * @param $userId
     */
    // protected function failBaseCase($user, $userId)
    // {
    //     $response = $this->post('/api/v1/auth/register', $user);
    //     $response->assertStatus(400);
    //     $this->assertDatabaseMissing('users', $user);
    //     $this->users->where('user_id', $userId)->each->delete();
    // }

    // /**
    //  * 異常系(ユーザーID)
    //  *
    //  * @test
    //  * @dataProvider userIdProvider
    //  * @param $userId
    //  */
    // public function failUserIdCase($userId)
    // {
    //     $user = [
    //         'user_id'       => $userId,
    //         'screen_name'   => 'Menstagram9999',
    //         'email'         => 'menstagram9999@menstagram.com',
    //         'password'      => 'Menstagram9999',
    //     ];

    //     $this->failBaseCase($user, $userId);
    // }

    // /**
    //  * 異常系(スクリーンネーム)
    //  *
    //  * @test
    //  * @dataProvider screenNameProvider
    //  * @param $screenName
    //  */
    // public function failScreenNameCase($screenName)
    // {
    //     $user = [
    //         'user_id'       => 'Menstagram_9999',
    //         'screen_name'   => $screenName,
    //         'email'         => 'menstagram_9999@menstagram.com',
    //         'password'      => 'Menstagram_9999',
    //     ];

    //     $this->failBaseCase($user, $user['user_id']);
    // }

    // /**
    //  * 異常系(メールアドレス)
    //  *
    //  * @test
    //  * @dataProvider emailProvider
    //  * @param $email
    //  */
    // public function failEmailCase($email)
    // {
    //     $user = [
    //         'user_id'       => 'Menstagram_9999',
    //         'screen_name'   => 'Menstagram9999',
    //         'email'         => $email,
    //         'password'      => 'Menstagram_9999',
    //     ];

    //     $this->failBaseCase($user, $user['user_id']);
    // }

    // /**
    //  * 異常系(パスワード)
    //  *
    //  * @test
    //  * @dataProvider passwordProvider
    //  * @param $password
    //  */
    // public function failPasswordCase($password)
    // {
    //     $user = [
    //         'user_id'       => 'Menstagram_9999',
    //         'screen_name'   => 'Menstagram9999',
    //         'email'         => 'menstagram_9999@menstagram.com',
    //         'password'      => $password,
    //     ];

    //     $this->failBaseCase($user, $user['user_id']);
    // }
}
