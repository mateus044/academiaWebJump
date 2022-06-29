<?php

namespace Source\Controllers;

use PlugRoute\Http\Request;
use PlugHttp\Response;
use Source\Repository\AccountHolderRepository\AccountHolderRepository;
use Source\Repository\AccountHolderRepository\AccountHoulderValidationRepository;
use Source\Resource\AccountHolderResource\AccountHolderCreateResource;
use Source\Utils\FromJson;

class AccountHolderController {


    private $accountHolder;
    private $response;

    public function __construct(AccountHolderRepository $accountHolder, Response $response) 
    {
        $this->accountHolder = $accountHolder;
        $this->response = $response;
    }


    public function indexAccount(Request $request)
    {
        echo 'index';
    }

    public function storageAccount(Request $request)
    {
      $request = $request->all();
    
      isset($request['name'])      ? $name      = $request['name']      : $name      = null;
      isset($request['cpf'])       ? $cpf       = $request['cpf']       : $cpf       = null;
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
            'cnpj'=> $cnpj,
            'rg'  => $rg,
            'stateRegistration'=> $stateRegistration,
            'birthDate'      => $birthDate,
            'foundationDate' => $foundationDate,
            'cellphone' => $cellphone,
            'address'  => $address
        );
    
        $response = $this->accountHolder->storageAccountHolder($array);
        if(isset($response['code'])){

            $json = FromJson::fromJsonError($response['message'], $response['code']);
            echo $json;
        } else {

            //var_dump($response->name);
            $json = (new AccountHolderCreateResource())->toArray($response);
            echo $json;
        }
    }

    public function transferAccount(Request $reques)
    {
        echo 'transfer';
    }

    public function depositAccount(Request $request)
    {
        echo 'deposit';
    }

    public function withdrawAccount(Request $request)
    {
        echo 'withdraw';
    }
    

}