<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostDetailRequest;
use App\Http\Requests\PostLikeRequest;
use App\Http\Requests\PostLikerRequest;
use App\Http\Requests\PostRequest;
use App\Http\Requests\PostTextRequest;
use App\Http\Requests\PostUnlikeRequest;
use App\UseCases\FetchPostDetailUseCase;
use App\UseCases\FetchPostLikerUseCase;
use App\UseCases\JudgeRamenUseCase;
use App\UseCases\LikeUseCase;
use App\UseCases\PostTextUseCase;
use App\UseCases\PostUseCase;
use App\UseCases\StoreImagesUseCase;
use App\UseCases\UnlikeUseCase;

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
     * @param JudgeRamenUseCase $judgeRamenUseCase
     * @param StoreImagesUseCase $storeImagesUseCase
     * @param PostUseCase $postUseCase
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function post(PostRequest $request,
                         JudgeRamenUseCase $judgeRamenUseCase,
                         StoreImagesUseCase $storeImagesUseCase,
                         PostUseCase $postUseCase)
    {
        $isRamens = $judgeRamenUseCase($request);
//        $filePaths = $storeImagesUseCase($request, $isRamens);
//        $response = $postUseCase($filePaths, $isRamens);
//        return response($response, 200);
        return [];
    }

    /**
     * テキスト投稿
     *
     * @param PostTextRequest $request
     * @param PostTextUseCase $useCase
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function text(PostTextRequest $request, PostTextUseCase $useCase)
    {
        // TODO: バリデーション化したい
        if (!$useCase($request)) return response('{}', 400);
        return response('{}', 200);
    }

    /**
     * いいね
     *
     * @param PostLikeRequest $request
     * @param LikeUseCase $useCase
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function like(PostLikeRequest $request, LikeUseCase $useCase)
    {
        if (!$useCase($request->post_id)) return response('{}', 400);
        return response('{}', 200);
    }

    /**
     * いいねを外す
     *
     * @param PostUnlikeRequest $request
     * @param UnlikeUseCase $useCase
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function unlike(PostUnlikeRequest $request, UnlikeUseCase $useCase)
    {
        if(!$useCase($request->post_id)) return response('{}', 400);
        return response('{}', 200);
    }

    /**
     * 投稿詳細
     *
     * @param PostDetailRequest $request
     * @param FetchPostDetailUseCase $useCase
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function detail(PostDetailRequest $request, FetchPostDetailUseCase $useCase)
    {
        $response = $useCase($request->post_id);
        // TODO: バリデーション化したい
        if (collect($response)->isEmpty()) return response('{}', 400);
        return response($response, 200);
    }

    /**
     * いいねしたユーザー一覧
     *
     * @param PostLikerRequest $request
     * @param FetchPostLikerUseCase $useCase
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function liker(PostLikerRequest $request, FetchPostLikerUseCase $useCase)
    {
        $response = $useCase($request->post_id);
        return response($response, 200);
    }
}
