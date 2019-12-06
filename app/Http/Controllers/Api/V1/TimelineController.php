<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TimelineGlobalRequest;
use App\Http\Requests\TimelinePrivateRequest;
use App\UseCases\FetchGlobalTimelineUseCase;
use App\UseCases\FetchPrivateTimelineUseCase;
use App\UseCases\TakeAccessTokenUseCase;
use App\UseCases\TakeUserByAccessTokenUseCase;

/**
 * タイムラインAPI
 * 
 * Class TimelineController
 * @package App\Http\Controllers\Api\V1
 */
class TimelineController extends Controller
{
    /**
     * グローバルタイムライン
     *
     * @param TimelineGlobalRequest $request
     * @param TakeAccessTokenUseCase $takeAccessTokenUseCase
     * @param TakeUserByAccessTokenUseCase $takeUserByAccessTokenUseCase
     * @param FetchGlobalTimelineUseCase $useCase
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function _global(TimelineGlobalRequest $request,
                            TakeAccessTokenUseCase $takeAccessTokenUseCase,
                            TakeUserByAccessTokenUseCase $takeUserByAccessTokenUseCase,
                            FetchGlobalTimelineUseCase $useCase)
    {
        $accessToken = $takeAccessTokenUseCase();
        $userId = $takeUserByAccessTokenUseCase($accessToken)->id;
        $response = $useCase($userId, $request->post_id, $request->type);
        return response($response, 200);
    }

    /**
     * プライベートタイムライン
     *
     * @param TimelinePrivateRequest $request
     * @param TakeAccessTokenUseCase $takeAccessTokenUseCase
     * @param TakeUserByAccessTokenUseCase $takeUserByAccessTokenUseCase
     * @param FetchPrivateTimelineUseCase $fetchPrivateTimelineUseCase
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function _private(TimelinePrivateRequest $request,
                             TakeAccessTokenUseCase $takeAccessTokenUseCase,
                             TakeUserByAccessTokenUseCase $takeUserByAccessTokenUseCase,
                             FetchPrivateTimelineUseCase $fetchPrivateTimelineUseCase)
    {
        $accessToken = $takeAccessTokenUseCase();
        $userId = $takeUserByAccessTokenUseCase($accessToken)->id;
        $response = $fetchPrivateTimelineUseCase($userId, $request->post_id);
        return response($response, 200);
    }
}
