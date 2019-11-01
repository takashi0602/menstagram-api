<?php

Route::post('/auth/register', 'AuthController@register');
Route::post('/auth/login', 'AuthController@login');
Route::post('/auth/logout', 'AuthController@logout')->middleware('auth.bearer');