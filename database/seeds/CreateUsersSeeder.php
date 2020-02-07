<?php

use App\Models\User;
use Carbon\Carbon;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;

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
     * @param Faker $faker
     */
    public function run(Faker $faker)
    {
        User::truncate();

        // 固定ユーザーの生成
        User::create([
            'user_id'                  => 'menstagram',
            'screen_name'              => 'Menstagram',
            'email'                    => 'system@menstagram.com',
            'avatar'                   => asset('avatars/default/000' . mt_rand(1, 7) . '.png'),
            'biography'                => 'menstagram',
            'password'                 => bcrypt('menstagram'),
            'access_token'             => hash('sha256', 'sQCeW8BEu0OvPULE1phO79gcenQevsamL2TA9yDruTinCAG1yfbNZn9O2udONJgLHH6psVWihISvCCqW'),
            'posted'                   => $faker->numberBetween(1, 999999999),
            'following'                => $faker->numberBetween(1, 9999999999),
            'followed'                 => $faker->numberBetween(1, 9999999999),
            'access_token_deadline_at' => Carbon::now(),
        ]);

        // ランダムにユーザーを生成
        factory(User::class, 10)->create();
    }
}
