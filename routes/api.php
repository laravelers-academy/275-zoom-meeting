<?php

use Illuminate\Support\Facades\Route;

// Account Routes

Route::get('account/{account}', 'AccountController@show')
	->name('account.show');

Route::post('account/create', 'AccountController@create')
	->name('account.create');

Route::put('account/{account}', 'AccountController@update')
	->name('account.update');

Route::delete('account/{account}', 'AccountController@delete')
	->name('account.delete');

// Meeting Routes

Route::get('meeting/{meeting}', 'MeetingController@show')
	->name('meeting.show');

Route::post('meeting/create', 'MeetingController@create')
	->name('meeting.create');

Route::put('meeting/{meeting}', 'MeetingController@update')
	->name('meeting.update');

Route::delete('meeting/{meeting}', 'MeetingController@delete')
	->name('meeting.delete');