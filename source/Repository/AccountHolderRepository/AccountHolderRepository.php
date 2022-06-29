<?php

namespace Source\Repository\AccountHolderRepository;

use Exception;
use Source\Interfaces\AccountHolderInterface\AccountHolderInterface;
use Source\Model\AccountHolderModel;
use Source\Repository\AddressRepository\AddressRepository;
use Source\Utils\FromJson;

class AccountHolderRepository extends AccountHolderModel implements AccountHolderInterface {


    public function checkAccountHolder(array $data)
    {
        $accountHoulderValidation = new AccountHoulderValidationRepository();
        $response = $accountHoulderValidation->validateAccountHolder($data);
        
        if(isset($response->message)){
            $result = json_encode($response->message);
            throw new Exception($result, 400);
        } else {
            return $response;
        }
    }

    public function storageAccountHolder(array $data)
    {
        
        try {
          $accountHoulderValidation = $this->checkAccountHolder($data);   
          $accountHolder = $this->create($accountHoulderValidation);
          $address  = $this->storageAddress($accountHolder->id, $data['address']);
          return $accountHolder->load('address');
        
        } catch (Exception $e) {
            return ['message'=>$e->getMessage(), 'code'=>$e->getCode()];
        }
    }

    public function storageAddress(int $accountHolder_id, $address)
    {
        $addresRepository = new AddressRepository();
        $response = $addresRepository->storageAddress($accountHolder_id, $address); 
        return true;
    }



}