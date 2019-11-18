<?php

use Illuminate\Database\Seeder;
use App\Models\Post;

/**
 * 投稿のダミーデータの生成
 *
 * Class CreatePostSeeder
 */
class CreatePostsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Post::truncate();
        factory(Post::class, 100)->create();
    }
}
