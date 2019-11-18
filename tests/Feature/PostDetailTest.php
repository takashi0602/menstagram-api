<?php

namespace Tests\Feature;

use App\Models\Post;
use Tests\TestCase;

/**
 * 投稿詳細
 *
 * Class PostDetailTest
 * @package Tests\Feature
 */
class PostDetailTest extends TestCase
{
    protected $posts;

    /**
     * 初期化処理
     */
    public function setUp(): void
    {
        parent::setUp();
        parent::seeding(\CreatePostsSeeder::class);
        $this->posts =  Post::all();
    }

    public function successCase()
    {
        //
    }

    public function failCase()
    {
        // TODO: 有効なpost_idではないパターン

        // TODO: post_idが数値ではないパターン

        // TODO: post_idが存在しないパターン
    }
}
