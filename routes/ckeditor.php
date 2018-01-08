<?php

Route::group(['prefix' => 'laravel-ckeditor', 'middleware' => ['web']], function () {

    // {mode} : basic, standard, full, customized
    Route::get('example/{mode}', 'Douyasi\CKEditor\Http\Controllers\CKEditorController@getExample');

});