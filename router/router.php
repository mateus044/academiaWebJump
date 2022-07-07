<?php

$route = \PlugRoute\RouteFactory::create();

$middlewares = [
    \Source\Middlewares\Auth::class
];

$route->group(['prefix' => '/accountholder', 'namespace' => 'Source\\Controllers', 'middlewares'=>$middlewares], function($route){
    $route->post('/storage','\\AccountHolderController@storageAccount');
    $route->post('/transfer','\\AccountHolderController@transferAccount');
    $route->post('/deposit','\\AccountHolderController@depositAccount');
    $route->post('/withdraw','\\AccountHolderController@withdrawAccount');
    $route->post('/createAccount','\\AccountHolderController@createAccount');    
});

$route->group(['prefix' => '/accountholder', 'namespace' => 'Source\\Controllers', 'middlewares'=>$middlewares], function($route){
    $route->post('/login','\\AuthenticationController@login');
    $route->post('/logout','\\AuthenticationController@logout');  
});


$route->notFound(function(){
    echo 'Rota não encontrada.';
});
$route->on();