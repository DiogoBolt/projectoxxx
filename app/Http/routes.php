<?php

Route::any('/', 'DashboardController@inicio');
Route::post('/start', 'DashboardController@index');




Route::auth();
route::group(['middleware' => 'auth'], function () {

    //Families


    //Orders

    //Promotions


});



