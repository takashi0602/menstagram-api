<?php

//
Route::get('/timeline/global', 'TimelineController@global')->middleware('auth.bearer');
