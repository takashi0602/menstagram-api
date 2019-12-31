<?php

Route::get('/user/profile', 'UserController@profile');
Route::get('/user/posts', 'UserController@posts');
Route::patch('/user/edit', 'UserController@edit');
Route::get('/user/likes', 'UserController@likes');
Route::post('/user/follow', 'UserController@follow');
Route::post('/user/unfollow', 'UserController@unfollow');
Route::get('/user/following', 'UserController@following');
Route::get('/user/followed', 'UserController@followed');