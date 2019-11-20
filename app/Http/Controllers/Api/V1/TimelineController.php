<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\GlobalTimelineRequest;
use App\UseCases\GlobalTimelineUseCase;

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
     * @param GlobalTimelineRequest $request
     * @param GlobalTimelineUseCase $useCase
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    function global(GlobalTimelineRequest $request, GlobalTimelineUseCase $useCase)
    {
        $response = $useCase($request->post_ids);
        return response($response, 200);
    }
}
