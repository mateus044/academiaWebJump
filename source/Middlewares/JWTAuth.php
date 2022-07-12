<?php

namespace Source\Middlewares;

use Source\Middlewares\Auth;
use PlugHttp\Request;
use PlugRoute\Middleware\PlugRouteMiddleware;
use Source\Utils\FormatExceptionError;
use Source\Utils\MessageValidation;

class JWTAuth implements PlugRouteMiddleware
{
    public function handler(Request $request) 
    {   
        try {
            $auth  = new Auth();
            return $auth->authorization();
        } catch (\Throwable $e) {
           
            $error = FormatExceptionError::exceptionError(MessageValidation::$invalidToken);
            return $error;
        }
    }
}