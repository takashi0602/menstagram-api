<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Post;
use Faker\Generator as Faker;

/**
 * 投稿のダミーデータの生成
 */
$factory->define(Post::class, function (Faker $faker) {
    $imagePath = 'https://hangouts.google.com/call/5n6y70XgSH9LF0O9x1KVAEEM';

    return [
        'user_id'   => $faker->numberBetween(1, 10),
        'text'      => $faker->text(256),
        'images'    => [ $imagePath, $imagePath, $imagePath, $imagePath, ],
        'liked'     => $faker->numberBetween(1, 999999999),
    ];
});
