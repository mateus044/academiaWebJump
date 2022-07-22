<?php

use Pecee\SimpleRouter\SimpleRouter;
use Source\Controllers\AccountHolderController;
use Source\Controllers\AuthenticationController;


$middlewares = [ \Source\Middlewares\JWTAuth::class];
SimpleRouter::group(['middleware' => $middlewares, 'prefix' => '/accountholder'], function () {
    SimpleRouter::post('/transfer',      [AccountHolderController::class, 'transferAccount']);
    SimpleRouter::post('/deposit',       [AccountHolderController::class, 'depositAccount']);
    SimpleRouter::post('/withdraw',      [AccountHolderController::class, 'withdrawAccount']);
    SimpleRouter::post('/createAccount', [AccountHolderController::class, 'createAccount']);
    SimpleRouter::post('/list', [AccountHolderController::class, 'accountHolderList']);
});

SimpleRouter::group(['prefix' => '/'], function () {
    SimpleRouter::post('/storage',   [AccountHolderController::class, 'storageAccount']);
    SimpleRouter::post('/accountholder', [AccountHolderController::class, 'invalidToken']);
    SimpleRouter::post('/login', [AuthenticationController::class, 'login']);
});

SimpleRouter::get('/home', function() {
    return 'Hello world';
});

SimpleRouter::start();