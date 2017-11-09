<?php

Route::auth();
route::group(['middleware'=>'auth'],function() {
    Route::any('/','DashboardController@index');

});



