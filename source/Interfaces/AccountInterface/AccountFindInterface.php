<?php

namespace Source\Interfaces\AccountInterface;

interface AccountFindInterface
{
    public function findAccountByNumber(int $number);
}