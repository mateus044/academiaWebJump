<?php

namespace Source\Repository\AccountHolderRepository;

use Exception;
use Source\Interfaces\AccountHolderInterface\AccountHoulderFindInterface;
use Source\Model\AccountHolderModel;
use Source\Model\AccountModel;
use Source\Utils\FormatExceptionError;
use Source\Utils\MessageValidation;

class AccountHoulderFindRepository extends AccountHolderModel implements AccountHoulderFindInterface {

    private $accountHolderModelClass = AccountHolderModel::class;

    public function getAccountHolder(int $id)
    {   
        $accountHolder = $this->find($id);
        if(!$accountHolder){
            $error = FormatExceptionError::exceptionError(MessageValidation::$accountHolderNotFount);
            throw new Exception(json_encode($error) ,404);
        }

        $accountHolder->load('account');
        $account = $accountHolder->account;

        if(!$account instanceof AccountModel)
        {
            $error = FormatExceptionError::exceptionError(MessageValidation::$accountNotExists);
            throw new Exception(json_encode($error),406);
        }

        return $accountHolder;
    }

    public function validAccountHolder($id)
    {
        if(!is_integer($id))
        {
            $error = FormatExceptionError::exceptionError(MessageValidation::$onlyInteger);
            throw new Exception(json_encode($error) ,406);
        }

        if($id <= 0)
        {
            $error = FormatExceptionError::exceptionError(MessageValidation::$onlyPositiveNumbers);
            throw new Exception(json_encode($error) ,406);
        }

        return $id;
    }

    public function listAccountHolder($id)
    {
        $response = $this->validAccountHolder($id);
        $accountHolder = $this->find($response);

        if(!$accountHolder == null) {
            return $accountHolder;
        } 

        $error = FormatExceptionError::exceptionError(MessageValidation::$accountHolderNotFount);
        throw new Exception(json_encode($error) ,404);
    }

    public function findAccountHolderWithoutAddress() 
    {
       //
    }
}