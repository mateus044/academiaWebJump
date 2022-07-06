<?php

namespace Source\Repository\AccountHolderRepository;

use Source\Interfaces\AccountHolderInterface\AccountHolderDeleteInterface;
use Source\Model\AccountHolderModel;

class AccountHolderDeleteRepository extends AccountHolderModel implements AccountHolderDeleteInterface
{
    public function deleteAccountHolderAfterException() 
    {  
        return true;
    }
}