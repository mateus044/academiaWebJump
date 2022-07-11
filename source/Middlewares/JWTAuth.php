<?php

namespace Source\Middlewares;

use PlugHttp\Request;
use PlugRoute\Middleware\PlugRouteMiddleware;

class JWTAuth implements PlugRouteMiddleware
{

    public function handler(Request $request) : Request
    {   
        return $request;
    }
}