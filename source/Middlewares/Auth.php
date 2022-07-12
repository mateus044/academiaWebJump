<?php

namespace Source\Middlewares;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Auth 
{

    /**
     * @return string $token
    */
    public function authorization() 
    {
        if(isset($_SERVER['HTTP_AUTHORIZATION'])){
            $token = $_SERVER['HTTP_AUTHORIZATION'];
            $token = str_replace("Bearer",'', $token);
            $token = trim($token);
            $decoded = JWT::decode($token, new Key('example_key', 'HS256'));
            return $decoded;
        } else {

            throw new Exception('invalid token',406);
        } 
    }
}