<?php

namespace Source\Repository\AuthenticationRepository;

use Exception;
use Source\Interfaces\AuthenticationInterface\AuthenticationFindInterface;
use Source\Model\AccountHolderModel;
use Source\Utils\FormatExceptionError;
use Source\Utils\MessageValidation;

class AuthenticationFindRepository extends AccountHolderModel implements AuthenticationFindInterface
{
    private $accountHolder = AccountHolderModel::class;
    
    public function findUser($credentiais) 
    {
        if(isset($credentiais['cpf']))
        {
            return $this->findAccountHolderByCpf($credentiais['cpf']);
        }

        if(isset($credentiais['cnpj']))
        {
            return $this->findAccountHolderByCnpj($credentiais['cnpj']);
        }

        return false;
    }

    public function findAccountHolderByCpf(string $cpf)
    {
        $accountHolder = $this->accountHolder::where('cpf' ,'=', $cpf)->first();
        if(is_null($accountHolder))
        {
            $error = FormatExceptionError::exceptionError(MessageValidation::$userDoesNotExist);
            throw new Exception(json_encode($error),406);
        }
        
        return $accountHolder;
    }

    public function findAccountHolderByCnpj(string $cnpj)
    {
        $accountHolder = $this->accountHolder::where('cnpj' ,'=', $cnpj)->first();
        if(is_null($accountHolder))
        {
            $error = FormatExceptionError::exceptionError(MessageValidation::$userDoesNotExist);
            throw new Exception(json_encode($error),406);
        }

        return $accountHolder;
    }
}