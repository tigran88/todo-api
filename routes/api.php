<?php

Route::group(['prefix' => 'v1'], function() {
    Route::apiResource('users', 'api\v1\UserController');
});