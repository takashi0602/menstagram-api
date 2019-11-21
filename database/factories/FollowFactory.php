<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Follow;
use Faker\Generator as Faker;

/**
 * フォローのダミーデータの生成
 */
$factory->define(Follow::class, function (Faker $faker) {

    $userId = $faker->numberBetween(1, 10);
    $targetUserId = $faker->numberBetween(1, 10);
    for (;;) {
        if ($userId !== $targetUserId) break;
        $targetUserId = $faker->numberBetween(1, 10);
    }

    return [
        'user_id'           => $userId,
        'target_user_id'    => $targetUserId,
    ];
});
