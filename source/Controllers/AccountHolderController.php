<?php

namespace Source\Controllers;

use PlugRoute\Http\Request;

use Source\Repository\AccountHolderRepository\AccountHolderRepository;

class AccountHolderController {


    private $accountHolder;

    public function __construct(AccountHolderRepository $accountHolder)
    {
        $this->accountHolder = $accountHolder;
    }


    public function indexAccount(Request $request)
    {
        echo 'index';
    }

    public function storageAccount(Request $request)
    {
        $result = $this->accountHolder->index();
        echo $result;
    }

    public function transferAccount(Request $reques)
    {
        echo 'transfer';
    }

    public function depositAccount(Request $request)
    {
        echo 'deposit';
    }

    public function withdrawAccount(Request $request)
    {
        echo 'withdraw';
    }
    

}