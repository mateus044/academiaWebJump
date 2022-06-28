<?php

namespace Source\Controllers;

use PlugRoute\Http\Request;

use Source\Repository\AccountHolderRepository\AccountHolderRepository;

class AccountHolderController {


    private $accountHolder;

    public function __construct(AccountHolderRepository $accountHolder)
    {
        $this->accountHolder = $accountHolder;
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
    
        $result = $this->accountHolder->storageAccountHolder($array);
        
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