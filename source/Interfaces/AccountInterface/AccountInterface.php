<?php

namespace Source\Interfaces\AccountInterface;

interface AccountInterface
{
    public function checkAccount(int $accountHolder_id, array $data);
    public function createAccount(int $accountHolder_id, array $data);
}