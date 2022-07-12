<?php

namespace Source\Repository\AccountHolderRepository;

use Exception;
use Source\Interfaces\AccountHolderInterface\AccountHolderInterface;
use Source\Logs\Logs;
use Source\Model\AccountHolderModel;
use Source\Model\AccountModel;
use Source\Repository\AccountRepository\AccountRepository;
use Source\Repository\AccountRepository\AccountUpdateRepository;
use Source\Repository\AddressRepository\AddressRepository;
use Source\Utils\FormatExceptionError;
use Source\Utils\LevelLogs;
use Source\Utils\MessageLogs;
use Source\Utils\MessageValidation;

class AccountHolderRepository extends AccountHolderModel implements AccountHolderInterface 
{

    public function chechCnpjAndCpf(array $data)
    {     
        if(is_null($data['cpf']) && is_null($data['cnpj']))
        {
            $error = FormatExceptionError::exceptionError(MessageValidation::$cpfOrCnpj);
            throw new Exception(json_encode($error),406);
        }

        if(!is_null($data['cpf']) && !is_null($data['cnpj']))
        {
            $error = FormatExceptionError::exceptionError(MessageValidation::$cpfOrCnpj);
            throw new Exception(json_encode($error),406);
        }

        return true;   
    }

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
          $chechCnpjAndCpf = $this->chechCnpjAndCpf($accountHoulderValidation); 
          $accountHolder = $this->create($accountHoulderValidation);
          $address       = $this->storageAddress($accountHolder->id, $data['address']);
          $this->mountAccountHolderLog($accountHolder, MessageLogs::$accountHolderCreated, LevelLogs::DEBUG);
          return $accountHolder->load('address');
          
        } catch (Exception $e) {
            
            Logs::logAccountHolder(MessageLogs::$errorCreating ,$e->getMessage(), LevelLogs::ERROR);
            return ['message'=>$e->getMessage(), 'code'=>$e->getCode()];
        }
    }

    public function storageAddress(int $accountHolder_id, $address)
    {
        $addresRepository = new AddressRepository();
        $addresRepository->storageAddress($accountHolder_id, $address); 
        return true;
    }

    public function findAccountHolder(int $id)
    {
        $accountHolder = $this->find($id);
        if(!$accountHolder){
            $error = FormatExceptionError::exceptionError(MessageValidation::$accountHolderNotFount);
            throw new Exception(json_encode($error) ,404);
        }

        $accountHolder->load('account');
        $account = $accountHolder->account;

        if($account instanceof AccountModel)
        {
            $error = FormatExceptionError::exceptionError(MessageValidation::$accountExists);
            throw new Exception(json_encode($error),406);
        }

        return $accountHolder;
    }

    public function createAccount(int $accountHolder_id, array $data)
    {  
        try {
            $accounReposioty = new AccountRepository();
            $accountHolder = $this->findAccountHolder($accountHolder_id);
            $account = $accounReposioty->createAccount($accountHolder->id, $data);
            return $accountHolder->load('account');
        } catch (Exception $e) {
       
            Logs::logAccount(MessageLogs::$errorAccount,$e->getMessage(), LevelLogs::ERROR);
            return ['message'=>$e->getMessage(), 'code'=>$e->getCode()];
        }
    }

    public function accountDeposit(int $accountHolder_id,  $value)
    {
        try {
            $accountHolder = new AccountHoulderFindRepository();
            $account = $accountHolder->getAccountHolder($accountHolder_id);
            $deposit = (new AccountUpdateRepository())->depositValue($account->account, $value); 
            $this->mountAccountHolderLog($account, MessageLogs::$depositMade.':'.'value'.':'.$value  ,LevelLogs::DEBUG);
            return $account->load('account'); 
        } catch (Exception $e) {
            
            Logs::logAccount(MessageLogs::$errorDeposit, $e->getMessage(), LevelLogs::ERROR);
            return ['message'=>$e->getMessage(), 'code'=>$e->getCode()];
        }
    }

    public function accountWithdraw(int $accountHolder_id,  $value) 
    {
        try {

            $accountHolder = new AccountHoulderFindRepository();
            $account = $accountHolder->getAccountHolder($accountHolder_id);
            $deposit = (new AccountUpdateRepository())->withdrawValue($account->account, $value);
            $this->mountAccountHolderLog($account, MessageLogs::$withdrawSuccessfully.':'.'value'.':'.$value  ,LevelLogs::DEBUG);
            return $account->load('account'); 
        } catch (Exception $e) {
            
            Logs::logAccountHolder(MessageLogs::$errorWithdwaw, $e->getMessage(), LevelLogs::ERROR);
            return ['message'=>$e->getMessage(), 'code'=>$e->getCode()];
        }
    }

    public function accountTransfer(int $accountHolder_id, int $numberAccount, float $value)
    {
        try {
            
            $accountHolder = new AccountHoulderFindRepository();
            $account  = $accountHolder->getAccountHolder($accountHolder_id);
            $transfer = (new AccountUpdateRepository())->manageTransfer($account, $numberAccount, $value);
            $this->mountAccountHolderLog($account, MessageLogs::$transferMade.':'.'value'.':'.$value. ':'.'for'.':'.$numberAccount  , LevelLogs::DEBUG);
            return $account->load('account'); 
        } catch (Exception $e) {
            
            Logs::logAccountHolder(MessageLogs::$errorWhenTransferring, $e->getMessage(), LevelLogs::ERROR);
            return ['message'=>$e->getMessage(), 'code'=>$e->getCode()];
        }
    }

    /**
     * @param $accountHolder
     * @param string $message
     * @param string $level
     * 
     * @return bool
     */
    public function mountAccountHolderLog($accountHolder, $message, string $level) : bool
    {   
        if(!$accountHolder->cpf == null)
        {
            Logs::logAccountHolder($message, $accountHolder->cpf, $level);
        }

        if(!$accountHolder->cnpj == null)
        {
            Logs::logAccountHolder($message, $accountHolder->cnpj, $level);
        }

        return true;
    }

    public function invalidToken()
    {
        $error = FormatExceptionError::exceptionError(MessageValidation::$invalidToken);
        $error['code'] = 500;
        return $error;
    }
}