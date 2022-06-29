<?php

namespace Source\Repository\AddressRepository;

use Exception;
use Source\Interfaces\AddreesInterface\AddressInterface;
use Source\Model\AddressModel;

class AddressRepository extends AddressModel implements AddressInterface{


    public function checkAddress(int $accountHolder_id, array $address)
    {
        $addresValidation = new AddressValidationRepository();
        $response = $addresValidation->validateAddress($accountHolder_id, $address);
       
        if(isset($response->message)){
            $result = json_encode($response->message);
            throw new Exception($result, 400);
        } else {
            return $response;
        }
    }

    public function storageAddress($accountHolder_id, $address)
    {
        $address = $this->checkAddress($accountHolder_id, $address);
        $this->create($address);
        return true;
    }
}