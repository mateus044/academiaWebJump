<?php

namespace Source\Interfaces\AddreesInterface;

use Source\Model\AddressModel;

interface AddressInterface 
{ 
    public function checkAddress(int $accountHolder_id, array $address); 
    public function storageAddress($accountHolder_id, $address) : bool;
    public function mountAddressLog(AddressModel $address, string $message, string $level) : bool;
}