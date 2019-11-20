<?php

Route::get('/timeline/global', 'TimelineController@global');
Route::get('/timeline/private', 'TimelineController@private')->middleware('auth.bearer');
