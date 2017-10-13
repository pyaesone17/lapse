<?php

Route::get('/', 'LapseController@index')->name('index');
Route::get('/detail/{id?}', 'LapseController@detail')->name('detail');
Route::get('/{id}', 'LapseController@index');