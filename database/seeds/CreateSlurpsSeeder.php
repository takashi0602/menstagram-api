<?php

use Illuminate\Database\Seeder;
use App\Models\Slurp;

/**
 * スラープのダミーデータの生成
 *
 * Class CreateSlurpsSeeder
 */
class CreateSlurpsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Slurp::truncate();
        factory(Slurp::class, 100)->create();
    }
}
