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
    $firstName = $faker->firstName;
    $user = User::where('user_id', $userId)->where('email', $email)->first();
    while (collect($user)->isNotEmpty()) {
        $userId = Str::random(10);
        $email = $faker->email;
        $user = User::where('user_id', $userId)->where('email', $email)->first();
    }

    return [
        'user_id'       => $userId,
        'screen_name'   => $firstName,
        'email'         => $email,
        'avatar'        => 'https://placehold.jp/150x150.png?text='.$firstName,
        'biography'     => Arr::random([ $faker->text(128), ]),
        'password'      => bcrypt('menstagram'),
        'access_token'  => Arr::random([ null, hash('sha256', Str::random(80)), ]),
        'posted'        => $faker->numberBetween(1, 999999999),
        'following'     => $faker->numberBetween(1, 9999999999),
        'followed'      => $faker->numberBetween(1, 9999999999),
    ];
});
