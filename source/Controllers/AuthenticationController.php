<?php

namespace Source\Controllers;

use PlugRoute\Http\Request;
use PlugHttp\Response;
use Source\Repository\AuthenticationRepository\AuthenticationRepository;
use Source\Resource\AuthenticationResource\AuthenticationLoginResource;
use Source\Utils\FromJson;

class AuthenticationController
{

    private $authenticationRepository;

    public function __construct(AuthenticationRepository $authenticationRepository) 
    {
        $this->authenticationRepository = $authenticationRepository;
    }

    public function login(Request $request)
    {
        $request = $request->all();
        isset($request['login'])    ? $login    = $request['login']    :  $login     = '';
        isset($request['password']) ? $passowrd = $request['password'] :  $passowrd  = '';

        $httpResponse = new Response();
        $response = $this->authenticationRepository->login($login, $passowrd);

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