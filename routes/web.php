<?php

Route::get('/', 'LapseController@index')->name('index');
Route::get('/detail/{id?}', 'LapseController@detail')->name('detail');
Route::delete('/clear', 'LapseController@clear')->name('clear');
Route::delete('/{id}', 'LapseController@destroy')->name('destroy');
Route::get('/{id}', 'LapseController@index');