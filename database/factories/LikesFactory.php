<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Like;
use Faker\Generator as Faker;

/**
 * いいねのダミーデータの生成
 */
$factory->define(Like::class, function (Faker $faker) {
    return [
        'user_id' => $faker->numberBetween(1, 10),
        'post_id' => $faker->numberBetween(1, 100),
    ];
});
