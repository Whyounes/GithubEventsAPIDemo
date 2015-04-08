<?php

Route::get('/login', ['uses' => 'GoogleLoginController@index', 'as' => 'login']);
Route::get('/loginCallback', ['uses' => 'GoogleLoginController@store', 'as' => 'loginCallback']);

Route::any('/', ['middleware' => 'google_login', 'as' => 'home', 'uses' => 'BigQueryAPIController@topTen']);
