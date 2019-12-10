<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\TimelineGlobalRequest;
use App\Http\Requests\TimelinePrivateRequest;
use App\UseCases\FetchGlobalTimelineUseCase;
use App\UseCases\FetchPrivateTimelineUseCase;

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
     * @param FetchGlobalTimelineUseCase $useCase
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function _global(TimelineGlobalRequest $request, FetchGlobalTimelineUseCase $useCase)
    {
        $response = $useCase($request->post_id, $request->type);
        return response($response, 200);
    }

    /**
     * プライベートタイムライン
     *
     * @param TimelinePrivateRequest $request
     * @param FetchPrivateTimelineUseCase $useCase
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function _private(TimelinePrivateRequest $request, FetchPrivateTimelineUseCase $useCase)
    {
        $response = $useCase($request->post_id, $request->type);
        return response($response, 200);
    }
}
