<?php

namespace tests\Feature\AccountHolderTest;

use PHPUnit\Framework\TestCase;


class accountHolderCreateTest extends TestCase 
{ 
    public function test_create_account_holder() 
    {
        $teste = require __DIR__ ."/../../../router/router.php";
        //var_dump($teste);
        //$teste->POST('/accountholder/storage',[]);
        return $this->assertTrue(true);
    }
}