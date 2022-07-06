<?php

namespace Source\Middlewares;

use PlugRoute\Http\Request;
use PlugRoute\Middleware\PlugRouteMiddleware;

class Auth implements PlugRouteMiddleware
{

    public function handler(Request $request) : Request
    {   
        return $request;
    }
}