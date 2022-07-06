<?php

namespace tests\Feature\AccountHolderTest;

use PHPUnit\Framework\TestCase;
use Source\Controllers\AccountHolderController;
use Source\Repository\AccountHolderRepository\AccountHolderRepository;

class accountHolderCreateTest extends TestCase 
{ 

     /**
      * @test
      */
    public function test_create_account_holder() 
    {   
        $teste = new AccountHolderRepository();
        $teste->accountDeposit(1, 500);
        return $this->assertTrue(true);
    }
}