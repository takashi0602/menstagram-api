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

        // 固定ユーザーの生成
        User::create([
            'user_id'       => 'menstagram',
            'screen_name'   => 'Menstagram',
            'email'         => 'system@menstagram.com',
            'password'      => bcrypt('menstagram'),
            'access_token'  => hash('sha256', 'sQCeW8BEu0OvPULE1phO79gcenQevsamL2TA9yDruTinCAG1yfbNZn9O2udONJgLHH6psVWihISvCCqW')
        ]);

        // ランダムにユーザーを生成
        factory(User::class, 10)->create();
    }
}
