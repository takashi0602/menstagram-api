<?php

Route::get('/timeline/global', 'TimelineController@_global');
Route::get('/timeline/private', 'TimelineController@_private')->middleware('auth.bearer');
