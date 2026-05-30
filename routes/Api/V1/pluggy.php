<?php

use App\Http\Controllers\Api\V1\Pluggy\PluggyConnectController;



Route::prefix('v1/pluggy')
    ->name('v1.pluggy.')->group(function () {
        Route::get('create-token', PluggyConnectController::class)->name('pluggy.create-token');

        Route::post('item', function(){return 'success';})->name('pluggy.item');

        Route::post('webhook');
    });
