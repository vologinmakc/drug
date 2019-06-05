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

    Route::post('/store', 'DragController@store')->name('drags.store');
    Route::post('/search', 'DragController@search')->name('drags.search');

    Route::post('/ingredient/store', 'IngredientController@store')->name('drags.ingredient.store');

});
