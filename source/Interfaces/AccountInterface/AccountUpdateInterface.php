<?php

namespace Source\Interfaces\AccountInterface;

use Source\Model\AccountHolderModel;
use Source\Model\AccountModel;

interface AccountUpdateInterface 
{ 
    public function validateBeforeDeposite($value);
    public function validateBeforeWithdraw(AccountModel $account, $value);
    public function depositValue(AccountModel $account, $value); 
    public function withdrawValue(AccountModel $account, $value);
    public function validateBeforeTransfer(AccountHolderModel $accountHolder, int $accountNumberDestiny);
    public function effectTransfer($accountFindRepository, $accountHolder, $value);
    public function manageTransfer(AccountHolderModel $accountHolder, int $accountNumberDestiny, float $value);
}