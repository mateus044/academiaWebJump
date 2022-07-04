<?php

namespace Source\Interfaces\AccountHolderInterface;

interface AccountHoulderValidationInterface 
{
    public function validateAccountHolder(array $data);
    public function mountAccountHoulder();
    public function validateFormAccountHoulder($data);

}