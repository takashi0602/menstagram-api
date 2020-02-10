<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * ユーザーのダミーデータの生成
 */
$factory->define(User::class, function (Faker $faker) {

    $userId = Str::random(10);
    $email = $faker->email;
    $user = User::where('user_id', $userId)->where('email', $email)->first();
    while (collect($user)->isNotEmpty()) {
        $userId = Str::random(10);
        $email = $faker->email;
        $user = User::where('user_id', $userId)->where('email', $email)->first();
    }

    $accessToken = Arr::random([ null, hash('sha256', Str::random(80)), ]);

    return [
        'user_id'                  => $userId,
        'user_name'                => $faker->firstName,
        'email'                    => $email,
        'avatar'                   => asset('avatars/default/000' . mt_rand(1, 7) . '.png'),
        'biography'                => $faker->text(128),
        'password'                 => bcrypt('menstagram'),
        'access_token'             => $accessToken,
        'slurp_count'              => $faker->numberBetween(1, 999999999),
        'follow_count'             => $faker->numberBetween(1, 9999999999),
        'follower_count'           => $faker->numberBetween(1, 9999999999),
        'access_token_deadline_at' => $accessToken ? $faker->dateTimeThisDecade : null,
    ];
});
