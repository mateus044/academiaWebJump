<?php

namespace Source\Middlewares;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Pecee\Http\Request;

class Auth 
{

    /**
     * @return string $token
    */
    public function authorization(Request $request) 
    {  

        if(isset($request->getHeaders()['http-authorization'])){
            $token = $request->getHeaders()['http-authorization'];
            $token = str_replace("Bearer",'', $token);
            $token = trim($token);
            $decoded = JWT::decode($token, new Key('example_key', 'HS256'));
            return true;
        } else {
            return false;
        } 


        // if(isset($_SERVER['HTTP_AUTHORIZATION'])){
        //     $token = $_SERVER['HTTP_AUTHORIZATION'];
        //     $token = str_replace("Bearer",'', $token);
        //     $token = trim($token);
        //     $decoded = JWT::decode($token, new Key('example_key', 'HS256'));
        //     return true;
        // } else {
        //     return false;
        // } 
    }
}