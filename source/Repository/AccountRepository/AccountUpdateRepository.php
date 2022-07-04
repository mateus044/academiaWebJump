<?php

namespace Source\Repository\AccountRepository;

use Exception;
use Source\Interfaces\AccountInterface\AccountUpdateInterface;
use Source\Model\AccountHolderModel;
use Source\Model\AccountModel;
use Source\Utils\FormatExceptionError;
use Source\Utils\MessageValidation;

class AccountUpdateRepository extends AccountModel implements AccountUpdateInterface
{

    public function validateBeforeDeposite($value)
    {
        if(!is_float($value)) {
            $error = FormatExceptionError::exceptionError(MessageValidation::$onlyFloat);
            throw new Exception(json_encode($error) ,406);
        }

        if($value <= 0) {

            $error = FormatExceptionError::exceptionError(MessageValidation::$onlyPositiveNumbers);
            throw new Exception(json_encode($error) ,406);
        }

        return $value;
    }

    public function validateBeforeWithdraw(AccountModel $account, $value) : AccountModel
    {
        if(!is_float($value)) {
            $error = FormatExceptionError::exceptionError(MessageValidation::$onlyFloat);
            throw new Exception(json_encode($error) ,406);
        }

        if($value <= 0) {
            $error = FormatExceptionError::exceptionError(MessageValidation::$onlyPositiveNumbers);
            throw new Exception(json_encode($error) ,406);
        }

        if($account->value < $value){
            $error = FormatExceptionError::exceptionError(MessageValidation::$insufficientFunds);
            throw new Exception(json_encode($error) ,406);
        }

        return $account;
    }

    public function depositValue(AccountModel $account, $value) 
    {
        $this->validateBeforeDeposite($value);
        $account->value += $value;
        $account->save();
        return $account; 
    }

    public function withdrawValue(AccountModel $account, $value) 
    {
        $this->validateBeforeWithdraw($account, $value);
        $account->value = $account->value - $value;
        $account->save();
        return $account; 
    }

    public function validateBeforeTransfer(AccountHolderModel $accountHolder, int $accountNumberDestiny)
    {
        if(!is_integer($accountNumberDestiny)){
            $error = FormatExceptionError::exceptionError(MessageValidation::$onlyInteger);
            throw new Exception(json_encode($error), 406);
        }

        $numberAccountOrigin = $accountHolder->account->number;
        if($numberAccountOrigin == $accountNumberDestiny){
            $error = FormatExceptionError::exceptionError(MessageValidation::$transferInvalid);
            throw new Exception(json_encode($error),406);
        }
        return true;
    }

    public function effectTransfer($accountFindRepository, $accountHolder, $value)
    {
        $this->withdrawValue($accountHolder, $value);
        $this->depositValue($accountFindRepository, $value);
        return true;
    }
    
    public function manageTransfer(AccountHolderModel $accountHolder, int $accountNumberDestiny, float $value)
    {
        $validateBeforeTransfer = $this->validateBeforeTransfer($accountHolder, $accountNumberDestiny);
        $accountFindRepository  = (new AccountFindRepository())->findAccountByNumber($accountNumberDestiny);
        $value         = $this->validateBeforeDeposite($value);
        $accountHolder = $this->validateBeforeWithdraw($accountHolder->account, $value);
        $this->effectTransfer($accountFindRepository, $accountHolder, $value);
        return true;
    }
}