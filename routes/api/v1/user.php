<?php

Route::get('/user/profile', 'UserController@profile');
Route::patch('/user/edit', 'UserController@edit');
Route::get('/user/likes', 'UserController@likes');
Route::post('/user/follow', 'UserController@follow');
Route::post('/user/unfollow', 'UserController@unfollow');