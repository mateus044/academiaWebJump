<?php

namespace Source\Interfaces\AuthenticationInterface;

use Source\Repository\AuthenticationRepository\AuthenticationValidateRepository;

interface AuthenticationValidationInterface 
{
    public function validateFields(string $login, string $password) : AuthenticationValidateRepository;
    public function validateFormAccountHoulder(string $login, string $password); 
}