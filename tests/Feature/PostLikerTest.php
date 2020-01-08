<?php

namespace Tests\Feature;

use Tests\Feature\DataProviders\PostLikerDataProvider;
use Tests\TestCase;

/**
 *
 *
 * Class PostLikerTest
 * @package Tests\Feature
 */
class PostLikerTest extends TestCase
{
    use PostLikerDataProvider;

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
            ->json('GET', '/api/v1/post/liker', [
                'post_id' => 1,
            ]);

        $response
            ->assertStatus(200)
            ->assertJsonStructure([
                '*' => [
                    'user_id',
                    'screen_name',
                    'avatar',
                    'is_following',
                    'is_me',
                ]
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
            ->json('GET', '/api/v1/post/liker', [
                'post_id' => $postId,
            ]);

        $response
            ->assertStatus(400)
            ->assertJsonStructure([]);
    }
}
