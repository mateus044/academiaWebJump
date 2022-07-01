<?php

namespace Source\Repository\AccountRepository;

use Source\Model\AccountModel;
use Source\Support\GenerateNumber;
use Source\Utils\MessageValidation;

class AccountValidateRepository extends AccountModel{

    public array $message;
    public bool $isValid;


    public function validateAccount(int $accountHolder_id, array $address)
    {
        $this->validateFormAccount($accountHolder_id, $address);
        if ($this->isValid) {
            return $this->mountAccount();
        } else {
            return $this;
        }
    }

    public function mountAccount()
    {
        $array = array(
            'value' => $this->getValue(),
            'number' => $this->getNumber(),
            'accountHolder_id' => $this->getAccountholder_id()
        );
        
        return $array;
    }

    public function validateFormAccount($accountHolder_id, $data)
    {   
       
        $array = [];
        $array['value']            = $this->_value($data);
        $array['number']           = $this->_number();
        $array['accountHolder_id'] = $this->_accountHolder_id($accountHolder_id,);
       
        $array =  array_filter($array, function ($data) {
            return $data != null;
        });

        $state = !empty($array);

        if ($state) {
            $this->message = $array;
            $this->isValid    = false;
        } else {

            $this->message = [];
            $this->isValid = true;
        }
    }

    /**
     * Valida o campo $value
     * @return string|null
     */
    private function _value($data)
    {
        if(!isset($data['value']))
        {
            return MessageValidation::$required;
        }

        if(!is_float($data['value']))
        {
            return MessageValidation::$onlyFloat;
        }
        
        $this->setValue($data['value']);
        return null;
    }

    /**
     * Valida o campo $number
     * @return string|null
     */
    private function _number()
    {
        $number = (new GenerateNumber())->generateNumber();
        $this->setNumber($number);
        return null;
    }

    /**
     * Valida o campo $accountHolder_id
     * @return string|null
     */
    private function _accountHolder_id($accountHolder_id)
    {
        if(!isset($accountHolder_id))
        {
            return MessageValidation::$required;
        }

        $this->setAccountHolder_id($accountHolder_id);
        return null;
    }
}