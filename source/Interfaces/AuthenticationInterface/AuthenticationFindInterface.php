<?php

namespace Source\Interfaces\AuthenticationInterface;

interface AuthenticationFindInterface
{
    public function findUser($credentiais);
    public function findAccountHolderByCpf(string $cpf);
    public function findAccountHolderByCnpj(string $cnpj);
}