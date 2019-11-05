<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;

use App\Http\Requests\TimelineUserRequest;
use App\UseCases\TimelineUserUseCase;


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
    function global(TimelineUserRequest $request, ){
        return [];
    }
}
