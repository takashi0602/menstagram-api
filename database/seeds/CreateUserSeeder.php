<?php

use Illuminate\Database\Seeder;
use App\Models\User;

/**
 * ユーザーのダミーデータの生成
 *
 * Class CreateUserSeeder
 */
class CreateUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        factory(User::class, 10)->create();
    }
}
