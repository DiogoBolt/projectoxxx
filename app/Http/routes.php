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

    //Categories
    Route::get('/categories','CategoryController@index');
    Route::get('/categories/new','CategoryController@newCategory');
    Route::post('/categories/create','CategoryController@createCategory');
    Route::get('/categories/edit/{id}','CategoryController@editCategory');
    Route::post('/categories/postedit/{id}','CategoryController@postEditCategory');
    Route::get('/categories/delete/{id}','CategoryController@deleteCategory');

    Route::any('/brands','DashboardController@brands');


});



