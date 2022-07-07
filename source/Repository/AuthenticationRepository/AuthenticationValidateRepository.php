<?php

namespace Source\Repository\AuthenticationRepository;

use Source\Interfaces\AuthenticationInterface\AuthenticationValidationInterface;
use Source\Model\AccountHolderModel;
use Source\Support\ValidateCnpj;
use Source\Support\ValidateCpf;
use Source\Utils\MessageValidation;

class AuthenticationValidateRepository extends AccountHolderModel implements AuthenticationValidationInterface
{

    public array  $message;
    public bool   $isValid;
    public $type;

    public function validateFields(string $login, string $password) : AuthenticationValidateRepository
    {
        $this->validateFormAccountHoulder($login, $password);
        return $this;
    }

    public function validateFormAccountHoulder(string $login, string $password) 
    {
        $array = [];
        $array['login'] = $this->_login($login);
        $array['password'] = $this->_password($password);

        $array = $this->_validateStateArray($array); 
        
        if(!isset($array['login']))
        {  
            $this->message = $array;
            $this->isValid = true;
        } else {
 
            $this->_validateStateArray($array);
            $this->message = $array;
            $this->isValid = false;
        }
    }

    private function _validateStateArray(array $array) : array 
    {   
        if($this->type == 'cnpj')
        {
            $array['cnpj'] = $array['login'];
            unset($array['login']);
            return $array;
        }

        if($this->type == 'cpf')
        {
            $array['cpf'] = $array['login'];
            unset($array['login']);
            return $array;
        }

        return $array;
    }

    /**
     * validate the password field
     * @param string $password
     * @return string|null
     */
    private function _password(string $password) : string
    {
        $count = strlen($password);
        if($count == 0)
        {
            return MessageValidation::$required;
        }

        if(!is_string($password))
        {
            return MessageValidation::$onlyString;
        }

        return $password;
    }

    /**
     * validate the field login
     * @param string $login
     * @return string|null
     */
    private function _login(string $login) : string
    {
        $count = strlen($login);
        if($count == 0)
        {
            return MessageValidation::$required;
        }

        if(!is_string($login))
        {
            return MessageValidation::$onlyString;
        }

        if($count == 14) 
        {
           return $this->validLoginCpf($login);   
        }

        if($count == 18)
        {
            return $this->validLoginCnpj($login);
        }

        return MessageValidation::$invalidLogin;
    }

    /**
     * Validates the state of the login field
     * @param string $login
     * @return string
     */
    private function validLoginCpf(string $login) : string
    {   
        $cpf = (new ValidateCpf())->validarCPF($login);
        if(isset($cpf['message']))
        {
            $this->type = "cpf";
            return $cpf['response'];
        }
        
        return $cpf;
    }

    /**
     * Validate the state of the login field
     * @param string $login
     * @return string
     */
    private function validLoginCnpj(string $login) : string
    {
        $cnpj = (new ValidateCnpj())->validarCnpj($login);
        if(isset($cnpj['message']))
        {
            $this->type = 'cnpj';
            return $cnpj['response'];
        }
         
        return $cnpj;
    }
}