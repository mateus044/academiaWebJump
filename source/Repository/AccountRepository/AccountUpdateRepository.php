<?php

namespace Source\Repository\AccountRepository;

use Exception;
use Source\Model\AccountModel;
use Source\Utils\FormatExceptionError;
use Source\Utils\MessageValidation;

class AccountUpdateRepository extends AccountModel {



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

        return true;
    }

    public function validateBeforeWithdraw(AccountModel $account, $value)
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

        return true;
    }

    public function depositValue(AccountModel $account, $value) 
    {
        $this->validateBeforeDeposite($value);
        $account->value += $value;
        $account->save();
        return true; 
    }

    public function withdrawValue(AccountModel $account, $value) 
    {
        $this->validateBeforeWithdraw($account, $value);
        $account->value = $account->value - $value;
        $account->save();
        return true; 
    }
}