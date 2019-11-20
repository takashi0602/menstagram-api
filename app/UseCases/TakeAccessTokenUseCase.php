<?php

namespace App\UseCases;

use Illuminate\Support\Str;

/**
 * アクセストークンの取得
 *
 * Class GetAccessTokenUseCase
 * @package App\UseCases
 */
class TakeAccessTokenUseCase
{
    /**
     * @return string
     */
    public function __invoke()
    {
        $accessToken = hash('sha256', Str::after(request()->header('Authorization'), 'Bearer '));
        return $accessToken;
    }
}