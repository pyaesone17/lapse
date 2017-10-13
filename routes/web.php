<?php

Route::get('/', 'ErrorController@index')->name('index');
Route::get('/detail/{id?}', 'ErrorController@detail')->name('detail');
Route::get('/{id}', 'ErrorController@index');