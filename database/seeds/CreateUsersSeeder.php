<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use App\Models\User;

/**
 * ユーザーのダミーデータの生成
 *
 * Class CreateUserSeeder
 */
class CreateUsersSeeder extends Seeder
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
            'user_id'                  => 'menstagram',
            'screen_name'              => 'Menstagram',
            'email'                    => 'system@menstagram.com',
            'avatar'                   => 'http://placehold.it/150x150',
            'biography'                => 'menstagram',
            'password'                 => bcrypt('menstagram'),
            'access_token'             => hash('sha256', 'sQCeW8BEu0OvPULE1phO79gcenQevsamL2TA9yDruTinCAG1yfbNZn9O2udONJgLHH6psVWihISvCCqW'),
            'access_token_deadline_at' => Carbon::now(),
        ]);

        // ランダムにユーザーを生成
        factory(User::class, 10)->create();
    }
}
