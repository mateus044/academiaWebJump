<?php

namespace Source\Interfaces\AuthenticationInterface;

use Source\Model\AccountHolderModel;

interface AuthenticationInterface
{
    public function authenticarFields(string $login, string $passowrd);
    public function validAccountHolderPassword(AccountHolderModel $accountHolder, string $passowrd);
    public function login(string $login, string $passowrd);
    public function mountAuthenticationLog($accountHolder, $message, string $level) : bool;
}