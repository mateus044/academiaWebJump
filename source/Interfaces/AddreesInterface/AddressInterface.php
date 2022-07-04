<?php

namespace Source\Interfaces\AddreesInterface;

interface AddressInterface 
{ 
    public function checkAddress(int $accountHolder_id, array $address); 
    public function storageAddress($accountHolder_id, $address);
}