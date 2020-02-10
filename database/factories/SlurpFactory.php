<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Slurp;
use Faker\Generator as Faker;

/**
 * スラープのダミーデータの生成
 */
$factory->define(Slurp::class, function (Faker $faker) {
    $imagePath = asset('seeds/sample.png');

    return [
        'user_id'   => $faker->numberBetween(1, 10),
        'text'      => $faker->text(256),
        'images'    => [ $imagePath, $imagePath, $imagePath, $imagePath, ],
        'yum_count' => $faker->numberBetween(1, 99999),
    ];
});
