<?php

Route::group(['prefix' => 'v1'], function() {
    Route::apiResource('users', 'api\v1\UserController');
    Route::apiResource('projects', 'api\v1\ProjectController');
    Route::apiResource('tasks', 'api\v1\TaskController');
    Route::apiResource('comments', 'api\v1\CommentController');
});