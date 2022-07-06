<?php

namespace tests\Feature\AccountHolderTest;

use Monolog\Test\TestCase;
use Source\Repository\AccountHolderRepository\AccountHolderRepository;

class accountHolderCreateTest extends  TestCase
{ 

 
    public function test_create_account_holder() 
    {   
        $teste = new AccountHolderRepository();
        $result = $teste->accountDeposit(2,250);
        //var_dump($teste->accountDeposit(2, 500.00));
        
       // return $this->assertTrue(true);
    }
}