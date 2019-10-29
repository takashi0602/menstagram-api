<?php

Route::post('/user/register', 'AuthController@register');
Route::post('/user/login', 'AuthController@login');
Route::post('/user/logout', 'AuthController@logout');