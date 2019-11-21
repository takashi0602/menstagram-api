<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\GlobalTimelineRequest;
use App\UseCases\FetchGlobalTimelineUseCase;

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
     * @param FetchGlobalTimelineUseCase $useCase
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\Response
     */
    public function _global(GlobalTimelineRequest $request, FetchGlobalTimelineUseCase $useCase)
    {
        $response = $useCase($request->post_id);
        return response($response, 200);
    }

    public function _private()
    {
        //
    }
}
