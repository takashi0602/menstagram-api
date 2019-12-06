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
        factory(Like::class, 100)->create();
    }
}
