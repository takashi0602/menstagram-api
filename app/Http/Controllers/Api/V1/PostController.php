<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostImagesRequest;
use App\Http\Requests\PostRequest;
use App\Models\Post;
use App\UseCases\PostImagesUseCase;
use App\UseCases\PostUseCase;
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
     * @param PostUseCase $postUseCase
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function post(PostRequest $request, TakeAccessTokenUseCase $takeAccessTokenUseCase, PostUseCase $postUseCase)
    {
        $accessToken = $takeAccessTokenUseCase();
        $postUseCase($accessToken, $request);

        return response('{}', 200);
    }

    /**
     * 画像送信
     *
     * @param PostImagesRequest $request
     * @param StoreImagesUseCase $storeImagesUseCase
     * @param TakeAccessTokenUseCase $takeAccessTokenUseCase
     * @param PostImagesUseCase $postImagesUseCase
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function images(PostImagesRequest $request,
                           StoreImagesUseCase $storeImagesUseCase,
                           TakeAccessTokenUseCase $takeAccessTokenUseCase,
                           PostImagesUseCase $postImagesUseCase)
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
        $request = request();

        $response = Post::where('id', $request->post_id)
                            ->where('images', '<>', null)
                            ->with('user:id,user_id,screen_name,avatar')
                            ->first();

        $response = collect($response)->except(['user_id']);

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
