<?php

use Pecee\SimpleRouter\SimpleRouter;
use Source\Controllers\AccountHolderController;

$middlewares = [ \Source\Middlewares\JWTAuth::class];

SimpleRouter::group(['middleware' => $middlewares, 'prefix' => '/accountholder'], function () {
    SimpleRouter::post('/transfer',      [AccountHolderController::class, 'transferAccount']);
    SimpleRouter::post('/deposit',       [AccountHolderController::class, 'depositAccount']);
    SimpleRouter::post('/withdraw',      [AccountHolderController::class, 'withdrawAccount']);
    SimpleRouter::post('/createAccount', [AccountHolderController::class, 'createAccount']);
});

SimpleRouter::group(['prefix' => '/'], function () {
    SimpleRouter::post('/storage',   [AccountHolderController::class, 'storageAccount']);
    SimpleRouter::post('/accountholder', [AccountHolderController::class, 'invalidToken']);
});

SimpleRouter::start();