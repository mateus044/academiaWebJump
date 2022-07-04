<?php

namespace Source\Interfaces\AddreesInterface;

interface AddressValidationInterface 
{
    public function validateAddress(int $accountHolder_id, array $address);
    public function mountAddress(); 
    public function validateFormAddress($accountHolder_id, $data);
}