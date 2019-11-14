<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

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
        // TODO: バリデーション
        $request = request();

        // TODO: usecase1 画像を処理する
        $filePaths = collect([]);
        for ($i = 1; $i <= 4; $i++) {
            if (is_null($request->file("image$i"))) continue;
            $extension = $request->file("image$i")->guessClientExtension();
            $fileName = Str::random(16) . ".$extension";
            $storageFilePath = storage_path("app/public/posts/$fileName");
            $image = Image::make($request->file("image$i"));
            if ($image->width() > $image->height()) {
                $image->resize(1024, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($storageFilePath);
            }
            else {
                $image->resize(null, 1024, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save($storageFilePath);
            }
            $publicFilePath = asset("storage/posts/$fileName");
            $filePaths->push($publicFilePath);
        }

        // TODO: アクセストークンの取得
        // TODO: usecaseとして切り出せるかも
//        $accessToken = hash('sha256', Str::after(request()->header('Authorization'), 'Bearer: '));
//
//        $userId = User::where('access_token', $accessToken)->first()->id;
//
//        $postId = Post::create([
//            'user_id'   => $userId,
//            'images'    => $filePaths,
//        ])->id;
//
//        $response = [
//            'post_id' => $postId,
//        ];
//
//        return response($response, 200);
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
