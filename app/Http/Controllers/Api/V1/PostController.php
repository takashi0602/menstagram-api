<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;

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
    public function media()
    {
        // TODO: 画像が１〜４枚か

        // TODO: 画像が大きい場合は圧縮する

        // TODO: postsテーブルに挿入

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
