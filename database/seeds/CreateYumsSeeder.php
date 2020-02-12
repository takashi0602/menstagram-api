<?php

use Illuminate\Database\Seeder;
use App\Models\Yum;

/**
 * ヤムのダミーデータの生成
 *
 * Class CreateYumsSeeder
 */
class CreateYumsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Yum::truncate();

        Yum::create([
            'user_id'  => 1,
            'slurp_id' => 1,
        ]);

        factory(Yum::class, 100)->create();
    }
}
