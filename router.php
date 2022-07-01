<?php


$route = \PlugRoute\RouteFactory::create();

$route->group(['prefix' => '/accountholder', 'namespace' => 'Source\\Controllers'], function($route){

    $route->post('/storage','\\AccountHolderController@storageAccount');
    $route->post('/transfer','\\AccountHolderController@transferAccount');
    $route->post('/deposit','\\AccountHolderController@depositAccount');
    $route->post('/withdraw','\\AccountHolderController@withdrawAccount');
    $route->post('/createAccount','\\AccountHolderController@createAccount');
    
});

$route->notFound(function(){
    echo 'Rota não encontrada.';
});
$route->on();