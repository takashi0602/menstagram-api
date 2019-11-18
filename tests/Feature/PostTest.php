<?php

namespace Tests\Feature;

use App\Models\Post;
use Tests\TestCase;

/**
 * 投稿
 *
 * Class PostTest
 * @package Tests\Feature
 */
class PostTest extends TestCase
{
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

    public function successCase()
    {
        //
    }

    public function failPostIdCase()
    {
        // TODO: 有効なpost_idではないパターン

        // TODO: post_idが数値ではないパターン

        // TODO: post_idが存在しないパターン
    }

    public function failTextCase()
    {
        // TODO: 空白のパターン

        // TODO: textが存在しないパターン

        // TODO: 256文字を超えているパターン
    }
}
