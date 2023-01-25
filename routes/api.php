<?php

use Illuminate\Support\Facades\Route;

Route::get('meeting/{id}', 'MeetingController@show')->name('meeting');