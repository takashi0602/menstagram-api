<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Like;
use Faker\Generator as Faker;

/**
 * いいねのダミーデータの生成
 */
$factory->define(Like::class, function (Faker $faker) {

    $userId = $faker->numberBetween(1, 10);
    $postId = $faker->numberBetween(1, 100);
    $like = Like::where('user_id', $userId)->where('post_id', $postId)->first();
    while (collect($like)->isNotEmpty()) {
        $postId = $faker->numberBetween(1, 100);
        $like = Like::where('user_id', $userId)->where('post_id', $postId)->first();
    }

    return [
        'user_id' => $userId,
        'post_id' => $postId,
    ];
});
