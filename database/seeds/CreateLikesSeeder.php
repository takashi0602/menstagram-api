<?php

use Illuminate\Database\Seeder;
use App\Models\Like;

/**
 * いいねのダミーデータの生成
 *
 * Class CreateLikesSeeder
 */
class CreateLikesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Like::truncate();

        Like::create([
            'user_id' => 1,
            'post_id' => 1,
        ]);

        factory(Like::class, 100)->create();
    }
}
