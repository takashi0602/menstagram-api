<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Post;
use Faker\Generator as Faker;

/**
 * 投稿のダミーデータの生成
 */
$factory->define(Post::class, function (Faker $faker) {
    $imagePath = 'http://placehold.it/300x300';

    return [
        'user_id'   => $faker->numberBetween(1, 10),
        'text'      => $faker->text(256),
        'images'    => [ $imagePath, $imagePath, $imagePath, $imagePath, ],
        'liked'     => $faker->numberBetween(1, 999999999),
    ];
});
