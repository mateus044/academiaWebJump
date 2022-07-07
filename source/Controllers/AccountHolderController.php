<?php

namespace Source\Controllers;

use PlugRoute\Http\Request;
use PlugHttp\Response;
use Source\Repository\AccountHolderRepository\AccountHolderRepository;
use Source\Resource\AccountHolderResource\AccountHolderCreateResource;
use Source\Resource\AccountHolderResource\AccountHolderResource;
use Source\Utils\FromJson;

class AccountHolderController 
{

    private $accountHolder;

    public function __construct(AccountHolderRepository $accountHolder) 
    {
        $this->accountHolder = $accountHolder;
    }

    public function storageAccount(Request $request)
    {
      $request = $request->all();
      isset($request['name'])      ? $name      = $request['name']      : $name      = null;
      isset($request['cpf'])       ? $cpf       = $request['cpf']       : $cpf       = null;
      isset($request['password'])  ? $password  = $request['password']  : $password  = null;
      isset($request['cnpj'])      ? $cnpj      = $request['cnpj']      : $cnpj      = null;
      isset($request['rg'])        ? $rg        = $request['rg']        :  $rg       = null;
      isset($request['birthDate']) ? $birthDate = $request['birthDate'] : $birthDate = null;
      isset($request['cellphone']) ? $cellphone = $request['cellphone'] : $cellphone = null;
      isset($request['address'])   ? $address   = $request['address']   : $address   = null;
      isset($request['stateRegistration']) ? $stateRegistration = $request['stateRegistration'] : $stateRegistration = null;
      isset($request['foundationDate'])    ? $foundationDate    = $request['foundationDate']    : $foundationDate    = null;

        $array = array(

            'name' => $name,
            'cpf' => $cpf,
            'password' => $password,
            'cnpj'=> $cnpj,
            'rg'  => $rg,
            'stateRegistration'=> $stateRegistration,
            'birthDate'      => $birthDate,
            'foundationDate' => $foundationDate,
            'cellphone' => $cellphone,
            'address'  => $address
        );

        $httpResponse = new Response();
        $response = $this->accountHolder->storageAccountHolder($array);
        if(isset($response['code'])){

            $json = FromJson::fromJsonError($response['message'], $response['code']);
            return $httpResponse->setStatusCode($response['code'])->response()->json($json);
        } else {

            $error = (new AccountHolderCreateResource())->toArray($response);
            return $httpResponse->setStatusCode(201)->response()->json($error);
        }
    }

    public function createAccount(Request $request)
    {
        $request = $request->all();
        isset($request['accountHolder']) ? $accountHolder_id = $request['accountHolder'] : $accountHolder_id = 0;
        isset($request['value']) ? $value = $request['value'] : $value = 0;

        $array = array(

            'value' => $value,
            'number'=> null,
            'accountHolder_id' => null
        );

        $httpResponse = new Response();
        $response = $this->accountHolder->createAccount($accountHolder_id, $array);
    
        if(isset($response['code'])){
            
            $json = FromJson::fromJsonError($response['message'], $response['code']);
            return $httpResponse->setStatusCode($response['code'])->response()->json($json);
        } else {
            
            $account = (new AccountHolderResource())->toArray($response);
            return $httpResponse->setStatusCode(201)->response()->json($account);      
        }
    }

    public function depositAccount(Request $request)
    {
        $request = $request->all();
        isset($request['accountHolder']) ? $accountHolder_id = $request['accountHolder'] : $accountHolder_id = 0;
        isset($request['value']) ? $value = $request['value'] : $value = 0;

        $httpResponse = new Response();
        $response = $this->accountHolder->accountDeposit($accountHolder_id, $value);

        if(isset($response['code'])){

            $json = FromJson::fromJsonError($response['message'], $response['code']);
            return $httpResponse->setStatusCode($response['code'])->response()->json($json);
        } else {

            $account = (new AccountHolderResource())->toArray($response);
            return $httpResponse->setStatusCode(200)->response()->json($account);
        }
    }

    public function withdrawAccount(Request $request)
    {
        $request = $request->all();
        isset($request['accountHolder']) ? $accountHolder_id = $request['accountHolder'] : $accountHolder_id = 0;
        isset($request['value']) ? $value = $request['value'] : $value = 0;

        $httpResponse = new Response();
        $response = $this->accountHolder->accountWithdraw($accountHolder_id, $value);

        if(isset($response['code'])){

            $json = FromJson::fromJsonError($response['message'], $response['code']);
            return $httpResponse->setStatusCode($response['code'])->response()->json($json);
        } else {

            $account = (new AccountHolderResource())->toArray($response);
            return $httpResponse->setStatusCode(200)->response()->json($account);
        }
    }

    public function transferAccount(Request $request)
    {
        $request = $request->all();
        isset($request['accountHolder']) ? $accountHolder_id  = (int) $request['accountHolder'] : $accountHolder_id = 0;
        isset($request['numberAccount']) ? $numberAccount     = (int) $request['numberAccount'] : $numberAccount    = 0;
        isset($request['value'])         ? $value  = (float) $request['value'] : $value = 0;

       

        $httpResponse = new Response();
        $response = $this->accountHolder->accountTransfer($accountHolder_id, $numberAccount, $value);
        if(isset($response['code'])){

            $json = FromJson::fromJsonError($response['message'], $response['code']);
            return $httpResponse->setStatusCode($response['code'])->response()->json($json);
        } else {

            $account = (new AccountHolderResource())->toArray($response);
            return $httpResponse->setStatusCode(200)->response()->json($account);
        }
    }

}