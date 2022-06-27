<?php

namespace Source\Repository\AccountHolderRepository;

use Source\Interfaces\AccountHolderInterface\AccountHolderInterface;
use Source\Model\AccountHolderModel;

class AccountHolderRepository extends AccountHolderModel implements AccountHolderInterface {


    public function index()
    {

        return "veio e voltou";

    }



}