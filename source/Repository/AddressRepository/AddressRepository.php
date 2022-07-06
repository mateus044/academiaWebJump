<?php

namespace Source\Repository\AddressRepository;

use Exception;
use Source\Interfaces\AddreesInterface\AddressInterface;
use Source\Logs\Logs;
use Source\Model\AddressModel;
use Source\Utils\LevelLogs;
use Source\Utils\MessageLogs;

class AddressRepository extends AddressModel implements AddressInterface
{
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

    public function storageAddress($accountHolder_id, $address) : bool
    {
        $address = $this->checkAddress($accountHolder_id, $address);
        $address = $this->create($address);
        $this->mountAddressLog($address, MessageLogs::$addressCreated, LevelLogs::DEBUG);
        return true;
    }

    /**
     * @param AddressModel $address
     * @param int $accountHolder_id
     * @param string $level
     * 
     * @return bool
     */
    public function mountAddressLog($address, string $message, string $level) : bool
    {   
        Logs::logAddress($message,$address->accountHolder_id,$level);
        return true;
    }
}