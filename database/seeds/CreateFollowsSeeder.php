<?php

use Illuminate\Database\Seeder;
use App\Models\Follow;

/**
 * フォローのダミーデータの生成
 *
 * Class CreateFollowsSeeder
 */
class CreateFollowsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Follow::truncate();
        factory(Follow::class, 100)->create();
    }
}
