<?php

//
Route::get('/timeline/global', function(){
  return [
    [
      "id": 1,
      "text": "テストテキスト",
      "images": [
        "https://placehold.jp/500x500.png?text=%E7%94%BB%E5%83%8F1",
        "https://placehold.jp/500x500.png?text=%E7%94%BB%E5%83%8F2",
        "https://placehold.jp/500x500.png?text=%E7%94%BB%E5%83%8F3",
        "https://placehold.jp/500x500.png?text=%E7%94%BB%E5%83%8F4"
      ],
      "user": [
        "user_id": "test",
        "screen_name": "テストさん",
        "avatar": "https://placehold.jp/150x150.png?text=%E3%82%A2%E3%82%A4%E3%82%B3%E3%83%B3"
      ],
        "liked": 1,
        "created_at": "XXXX",
        "updated_at": "XXXX"
    ]
  ]
});

Route::get('/timeline/private', function(){
  return [
    [
      "id": 1,
      "text": "テストテキスト",
      "images": [
        "https://placehold.jp/500x500.png?text=%E7%94%BB%E5%83%8F1",
        "https://placehold.jp/500x500.png?text=%E7%94%BB%E5%83%8F2",
        "https://placehold.jp/500x500.png?text=%E7%94%BB%E5%83%8F3",
        "https://placehold.jp/500x500.png?text=%E7%94%BB%E5%83%8F4"
      ],
      "user": [
        "user_id": "test",
        "screen_name": "テストさん",
        "avatar": "https://placehold.jp/150x150.png?text=%E3%82%A2%E3%82%A4%E3%82%B3%E3%83%B3"
      ],
      "liked": 1,
      "created_at": "XXXX",
      "updated_at": "XXXX"
    ]
  ]
});