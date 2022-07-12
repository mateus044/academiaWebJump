<?php

namespace Source\Interfaces\AccountHolderInterface;


interface AccountHolderInterface 
{  
    public function invalidToken();
    public function chechCnpjAndCpf(array $data);
    public function checkAccountHolder(array $data);
    public function storageAccountHolder(array $data);
    public function storageAddress(int $accountHolder_id, $address);
    public function findAccountHolder(int $id);
    public function createAccount(int $accountHolder_id, array $data);
    public function accountDeposit(int $accountHolder_id,  $value);
    public function accountWithdraw(int $accountHolder_id,  $value);
    public function accountTransfer(int $accountHolder_id, int $numberAccount, float $value);
}