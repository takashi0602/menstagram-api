<?php

namespace Tests\Feature;

use App\Models\Post;
use Tests\TestCase;

/**
 * 画像送信
 *
 * Class PostImagesTest
 * @package Tests\Feature
 */
class PostImagesTest extends TestCase
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

    public function failCase()
    {
        // TODO: 画像が含まれていないパターン

        // TODO: 画像が５枚以上のパターン

        // TODO: 画像サイズが大きすぎるパターン

        // TODO: 画像ではないファイルのパターン
    }
}
