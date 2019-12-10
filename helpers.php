<?php

use Illuminate\Support\Str;
use App\Models\User;

/**
 * アクセストークンの取得
 */
if (!function_exists('access_token')) {
    function access_token() {
        $accessToken = hash('sha256', Str::after(request()->header('Authorization'), 'Bearer '));
        return $accessToken;
    }
}

/**
 * ユーザー情報の取得
 */
if (!function_exists('user')) {
    function user($userId = null) {
        $user = User::query();

        if ($userId) {
            $user->where('user_id', $userId);
        }
        else {
            $user->where('access_token', access_token());
        }

        return $user->first();
    }
}