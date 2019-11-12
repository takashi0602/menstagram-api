<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

/**
 * 投稿系API
 *
 * Class PostController
 * @package App\Http\Controllers\Api\V1
 */
class PostController extends Controller
{
    /**
     * 投稿
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function post()
    {
        $response = [
            'can_posted' => true,
        ];

        return response($response, 200);
    }

    /**
     * 画像送信
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function images()
    {
        $request = request();

        $filePaths = [];
        for ($i = 1; $i <= 4; $i++) {
            if ($request->file("image$i")->isFile()) {
                $extension = Str::after($request->file("image$i")->getMimeType(), 'image/');
                $fileName = Str::random(16) . ".$extension";
                // TODO: http://~らへんはenvから取ってくるようにする
                $filePath = asset("public/storage/posts/$fileName");
                array_push($filePaths, $filePath);
                // TODO: 圧縮処理
                $request->file("image$i")->storeAs('public/posts', $fileName);
            }
        }

        \Log::info($filePaths);
        foreach ($filePaths as $path) {
            // TODO: postsテーブルに挿入
        }
        // TODO: post_idを取得

        $response = [
            'post_id' => 1,
        ];

        return response($response, 200);
    }

    /**
     * 投稿に対するいいね
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function like()
    {
        return response([], 200);
    }

    /**
     * 投稿に対するいいねを外す
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function unlike()
    {
        return response([], 200);
    }

    /**
     * 投稿の詳細を見る
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function detail()
    {
        $response = [
            [
                'id' => 1,
                'text' => 'ダミーテキスト',
                'images' => [
                    'https://placehold.jp/500x500.png?text=%E7%94%BB%E5%83%8F1',
                    'https://placehold.jp/500x500.png?text=%E7%94%BB%E5%83%8F2',
                    'https://placehold.jp/500x500.png?text=%E7%94%BB%E5%83%8F3',
                    'https://placehold.jp/500x500.png?text=%E7%94%BB%E5%83%8F4',
                ],
                'liked' => 1,
                'liker' => [
                    [
                        'user_id' => 'ダミーデータさん',
                        'avatar' => 'https://placehold.jp/150x150.png?text=%E3%82%A2%E3%82%A4%E3%82%B3%E3%83%B3',
                    ],
                    [
                        'user_id' => 'ダミーデータさん',
                        'avatar' => 'https://placehold.jp/150x150.png?text=%E3%82%A2%E3%82%A4%E3%82%B3%E3%83%B3',
                    ]
                ],
                'created_at' => 'ダミーデータさん',
                'updated_at' => 'https://placehold.jp/150x150.png?text=%E3%82%A2%E3%82%A4%E3%82%B3%E3%83%B3',
            ],
        ];

        return response($response, 200);
    }

    /**
     * 投稿にいいねしたユーザー一覧を見る
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function liker()
    {
        $response =  [
            [
                'id' =>  1,
                'user' => [
                    'user_id' => 'test_mock',
                    'screen_name' => 'ダミーデータさん',
                    'avater' => 'https://placehold.jp/150x150.png?text=%E3%82%A2%E3%82%A4%E3%82%B3%E3%83%B3',
                ]
            ]
        ];

        return response($response, 200);
    }
}
