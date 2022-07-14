<?php

namespace Source\Controllers;

//use PlugRoute\Http\Request;
use PlugHttp\Response;
use Pecee\Http\Request;
use Source\Repository\AuthenticationRepository\AuthenticationRepository;
use Source\Resource\AuthenticationResource\AuthenticationLoginResource;
use Source\Utils\FromJson;

class AuthenticationController
{

    public function login()
    {   
        $request  = new Request();

        $login    = $request->getInputHandler()->value('login');
        $password = $request->getInputHandler()->value('password');

        is_null($login)    ? $login    = '' : $login    = $login;
        is_null($password) ? $password = '' : $password = $password;     

        $httpResponse = new Response();
        $authenticationRepository = new AuthenticationRepository();
        $response = $authenticationRepository->login($login, $password);

        if(isset($response['code'])){

            $json = FromJson::fromJsonError($response['message'], $response['code']);
            return $httpResponse->setStatusCode($response['code'])->response()->json($json);

        } else {
            
            $error = (new AuthenticationLoginResource())->toArray($response);
            return $httpResponse->setStatusCode(201)->response()->json($error);
        }
    }

    public function logout(Request $request)
    {
        //
    }
}