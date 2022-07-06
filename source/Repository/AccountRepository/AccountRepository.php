<?php

namespace Source\Repository\AccountRepository;

use Exception;
use Source\Interfaces\AccountInterface\AccountInterface;
use Source\Logs\Logs;
use Source\Model\AccountModel;
use Source\Utils\LevelLogs;
use Source\Utils\MessageLogs;

class AccountRepository extends AccountModel implements AccountInterface 
{
    public function checkAccount(int $accountHolder_id, array $data)
    {
        $accountValidateRepository = new AccountValidateRepository();
        $response = $accountValidateRepository->validateAccount($accountHolder_id, $data);
        if(isset($response->message)){
            $result = json_encode($response->message);
            throw new Exception($result, 400);
        } else {
            return $response;
        }
    }

    public function createAccount(int $accountHolder_id, array $data)
    {
        $account = $this->checkAccount($accountHolder_id, $data);
        $account = $this->create($account);
        $this->mountAccountLog($account, MessageLogs::$accountCreated, LevelLogs::DEBUG);
        return true;        
    }

    /**
     * @param $account
     * @param int    $accountHolder_id
     * @param string $level
     * 
     * @return bool
     */
    public function mountAccountLog($account, string $message, string $level) : bool
    {   
        Logs::logAccount($message,$account->accountHolder_id,$level);
        return true;
    }
}