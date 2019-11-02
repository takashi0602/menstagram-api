<?php

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

/**
 * ユーザーのダミーデータの生成
 */
$factory->define(User::class, function (Faker $faker) {
    return [
        'user_id'       => Str::random(10),
        'screen_name'   => $faker->firstName,
        'email'         => $faker->email,
        'avatar'        => '',  // TODO: 追加する
        'biography'     => Arr::random([ null, $faker->text(128), ]),
        'password'      => bcrypt('menstagram'),
        'access_token'  => Arr::random([ null, hash('sha256', Str::random(80)), ]),
        'posted'        => $faker->randomNumber(),
        'following'     => $faker->randomNumber(),
        'followed'      => $faker->randomNumber(),
    ];
});
