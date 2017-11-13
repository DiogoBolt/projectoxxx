<?php

Route::auth();
route::group(['middleware'=>'auth'],function() {
    Route::any('/','DashboardController@index');
    //Families
    Route::get('/families','FamilyController@index');
    Route::get('/families/new','FamilyController@newFamily');
    Route::post('/families/create','FamilyController@createFamily');
    Route::get('/families/edit/{id}','FamilyController@editFamily');
    Route::post('/families/postedit/{id}','FamilyController@postEditFamily');
    Route::get('/families/delete/{id}','FamilyController@deleteFamily');
    Route::any('/categories','DashboardController@categories');
    Route::any('/brands','DashboardController@brands');


});



