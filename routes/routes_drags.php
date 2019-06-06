<?php

Route::group([
    'prefix' => 'drags',
    'namespace' => 'Controllers'
], function ()
{
    # группа роутев админа
    Route::group([
        'prefix' => 'admin',
        'namespace' => 'Admin'
    ], function ()
    {
        Route::get('/', 'AdminController@index')->name('drags.admin.index');
    });


    Route::get('/', 'IndexController@index')->name('drags.index');

    Route::get('/edit/{id}', 'DragController@edit')->name('drags.edit');
    Route::post('/update/{id}', 'DragController@update')->name('drags.update');
    Route::post('/search', 'DragController@search')->name('drags.search');
    Route::post('/store', 'DragController@store')->name('drags.store');
    Route::delete('/delete/{id}', 'DragController@destroy')->name('drags.delete');

    Route::post('/ingredient/store', 'IngredientController@store')->name('drags.ingredient.store');
    Route::get('/ingredient/edit/{id}', 'IngredientController@edit')->name('drags.ingredient.edit');
    Route::post('/ingredient/update/{id}', 'IngredientController@update')->name('drags.ingredient.update');
    Route::delete('/ingredient/delete/{id}', 'IngredientController@destroy')->name('drags.ingredient.delete');

});
