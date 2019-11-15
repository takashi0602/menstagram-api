<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostImagesRequest;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\Models\User;
use App\UseCases\PostImagesUseCase;
use App\UseCases\StoreImagesUseCase;
use App\UseCases\TakeAccessTokenUseCase;

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
     * @param PostRequest $request
     * @param TakeAccessTokenUseCase $takeAccessTokenUseCase
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function post(PostRequest $request, TakeAccessTokenUseCase $takeAccessTokenUseCase)
    {
        $accessToken = $takeAccessTokenUseCase();
        $userId = User::where('access_token', $accessToken)->first()->id;

        Post::where('user_id', $userId)->where('id', $request->post_id)->update([
            'text' => $request->text,
        ]);

        return response('{}', 200);
    }

    /**
     * 画像送信
     *
     * @param PostImagesRequest $request
     * @param StoreImagesUseCase $storeImagesUseCase
     * @param PostImagesUseCase $postImagesUseCase
     * @param TakeAccessTokenUseCase $takeAccessTokenUseCase
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function images(PostImagesRequest $request,
                           StoreImagesUseCase $storeImagesUseCase,
                           PostImagesUseCase $postImagesUseCase,
                           TakeAccessTokenUseCase $takeAccessTokenUseCase)
    {
        $filePaths = $storeImagesUseCase($request);
        $accessToken = $takeAccessTokenUseCase();
        $response = $postImagesUseCase($accessToken, $filePaths);

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
