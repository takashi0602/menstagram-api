<?php

Route::post('/post', 'PostController@post');
Route::post('/post/media', 'PostController@media');
Route::post('/post/like', 'PostController@like');
Route::post('/post/unlike', 'PostController@unlike');
Route::get('/post/detail', 'PostController@detail');
Route::get('/post/liker', 'PostController@liker');