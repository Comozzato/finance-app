<?php


Route::prefix('v1/auth')->group(function(){
    Route::post('register', [\App\Http\Controllers\Api\V1\Auth\RegisterController::class, 'register']);
});
