<?php

namespace Tests\Feature;

use App\Models\Follow;
use App\Models\User;
use Tests\Feature\DataProviders\UserPostFollowDataProvider;
use Tests\TestCase;

/**
 * フォロー
 *
 * Class UserFollowTest
 * @package Tests\Feature
 */
class UserPostFollowTest extends TestCase
{
    use UserPostFollowDataProvider;

    protected $users;
    protected $follows;

    /**
     * 初期化処理
     */
    public function setUp(): void
    {
        parent::setUp();
        parent::seeding([\CreateUsersSeeder::class, \CreateFollowsSeeder::class]);
        $this->users = User::all();
        $this->follows = Follow::all();
    }

    /**
     * 正常系
     *
     * @test
     */
    public function successCase()
    {
        foreach ($this->follows as $follow) {
            if ($follow->user_id === $this->users[0]->id && $follow->target_user_id === $this->users[1]->id) {
                $this->follows
                        ->where('user_id', $follow->user_id)
                        ->where('target_user_id', $follow->target_user_id)->each->delete();
            }
        }

        $accessToken = 'sQCeW8BEu0OvPULE1phO79gcenQevsamL2TA9yDruTinCAG1yfbNZn9O2udONJgLHH6psVWihISvCCqW';

        $response = $this
                        ->withHeader('Authorization', "Bearer $accessToken")
                        ->post('/api/v1/user/follow', [
                            'target_user_id' => $this->users[1]->user_id,
                        ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([]);

        $this->assertDatabaseHas('follows', [
            'user_id'        => $this->users[0]->id,
            'target_user_id' => $this->users[1]->id,
        ]);
    }

    /**
     * 異常系
     *
     * @test
     * @dataProvider targetUserIdProvider
     * @param $targetUserId
     */
    public function failCase($targetUserId)
    {
        foreach ($this->follows as $follow) {
            if ($follow->user_id === $this->users[0]->id && $follow->target_user_id === $this->users[1]->id) {
                $this->follows
                        ->where('user_id', $follow->user_id)
                        ->where('target_user_id', $follow->target_user_id)->each->delete();
            }
        }

        $accessToken = 'sQCeW8BEu0OvPULE1phO79gcenQevsamL2TA9yDruTinCAG1yfbNZn9O2udONJgLHH6psVWihISvCCqW';

        $response = $this
                        ->withHeader('Authorization', "Bearer $accessToken")
                        ->post('/api/v1/user/follow', [
                            'target_user_id' => $targetUserId,
                        ]);

        $response
            ->assertStatus(400)
            ->assertJsonStructure([]);

        $this->assertDatabaseMissing('follows', [
            'user_id'        => $this->users[0]->id,
            'target_user_id' => $targetUserId,
        ]);
    }
}
