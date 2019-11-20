<?php

Route::post('/post', 'PostController@post')->middleware('auth.bearer');
Route::post('/post/images', 'PostController@images')->middleware('auth.bearer');
Route::post('/post/like', 'PostController@like');
Route::post('/post/unlike', 'PostController@unlike');
Route::get('/post/detail', 'PostController@detail');
Route::get('/post/liker', 'PostController@liker');