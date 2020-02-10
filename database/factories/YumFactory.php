<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Yum;
use Faker\Generator as Faker;

/**
 * ヤムのダミーデータの生成
 */
$factory->define(Yum::class, function (Faker $faker) {

    $userId = $faker->numberBetween(1, 10);
    $slurpId = $faker->numberBetween(1, 100);
    $yum = Yum::where('user_id', $userId)->where('slurp_id', $slurpId)->first();
    while (collect($yum)->isNotEmpty()) {
        $slurpId = $faker->numberBetween(1, 100);
        $yum = Yum::where('user_id', $userId)->where('slurp_id', $slurpId)->first();
    }

    return [
        'user_id'  => $userId,
        'slurp_id' => $slurpId,
    ];
});
