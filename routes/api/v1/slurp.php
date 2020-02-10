<?php

Route::post('/slurp', 'PostController@slurp');
Route::post('/slurp/text', 'PostController@text');
Route::post('/slurp/yum', 'PostController@yum');
Route::post('/slurp/unyum', 'PostController@unyum');
Route::get('/slurp/detail', 'PostController@detail');
Route::get('/slurp/yums', 'PostController@yums');