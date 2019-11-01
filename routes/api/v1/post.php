<?php

//
Route::post('/post', function(){
  return [
    "can_post"=> true
  ]
});

Route::post('/post/like', function(){
  return [];
});

Route::post('/post/unlike', function(){
  return [];
});

Route::get('/post/detail', function(){
  return [
    [
      "id"=> 1,
      "text"=> "ダミーテキスト",
      "images"=> [
        "https://placehold.jp/500x500.png?text=%E7%94%BB%E5%83%8F1",
        "https://placehold.jp/500x500.png?text=%E7%94%BB%E5%83%8F2",
        "https://placehold.jp/500x500.png?text=%E7%94%BB%E5%83%8F3",
        "https://placehold.jp/500x500.png?text=%E7%94%BB%E5%83%8F4"
      ],
      "liked"=> 1,
      "liker"=> [
        [
          "user_id"=> "ダミーデータさん",
          "avatar"=> "https://placehold.jp/150x150.png?text=%E3%82%A2%E3%82%A4%E3%82%B3%E3%83%B3"
        ],
        [
          "user_id"=> "ダミーデータさん",
          "avatar"=> "https://placehold.jp/150x150.png?text=%E3%82%A2%E3%82%A4%E3%82%B3%E3%83%B3"
        ]
      ],
      "created_at"=> "ダミーデータさん",
      "updated_at"=> "https://placehold.jp/150x150.png?text=%E3%82%A2%E3%82%A4%E3%82%B3%E3%83%B3"
    ]
  ];
});
Route::get('/post/liker', function(){
  return [
    [
      "id" =>  1,
      "user"=> [
        "user_id"=> "test_mock",
        "screen_name"=> "ダミーデータさん",
        "avater"=> "https://placehold.jp/150x150.png?text=%E3%82%A2%E3%82%A4%E3%82%B3%E3%83%B3"
      ]
    ]
  ];
});