<?php

Route::group([
    'prefix' => 'drags',
    'namespace' => 'Controllers'
], function ()
{
    # группа роутев админа
    Route::group([
        'prefix' => 'admin',
        'namespace' => 'Admin',
        'middleware' => 'auth'
    ], function ()
    {
        Route::get('/', 'AdminController@index')->name('drags.admin.index');
    });


    Route::get('/', 'IndexController@index')->name('drags.index');

    Route::post('/update/{id}', 'DragController@update')->name('drags.update');
    Route::post('/delete/{id}', 'DragController@destroy')->name('drags.delete');
    Route::get('/edit/{id}', 'DragController@edit')->name('drags.edit');
    Route::post('/search', 'DragController@search')->name('drags.search');
    Route::post('/store', 'DragController@store')->name('drags.store');

    Route::get('/ingredient/edit/{id}', 'IngredientController@edit')->name('drags.ingredient.edit');
    Route::post('/ingredient/store', 'IngredientController@store')->name('drags.ingredient.store');
    Route::post('/ingredient/update/{id}', 'IngredientController@update')->name('drags.ingredient.update');
    Route::post('/ingredient/delete/{id}', 'IngredientController@destroy')->name('drags.ingredient.delete');

});
