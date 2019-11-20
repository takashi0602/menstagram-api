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
     * @param 
     */
    function global(GlobalTimelineRequest $request, GlobalTimelineUseCase $useCase){
        return $useCase($request->post_id, 200);
    }
}
