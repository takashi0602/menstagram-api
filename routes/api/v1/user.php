<?php

Route::get('/user/profile', 'UserController@profile');
Route::patch('/user/edit', 'UserController@edit');
Route::get('/user/likes', 'UserController@likes');