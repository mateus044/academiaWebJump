<?php

namespace Source\Repository\AccountHolderRepository;

use Exception;
use Source\Interfaces\AccountHolderInterface\AccountHolderInterface;
use Source\Model\AccountHolderModel;
use Source\Model\AccountModel;
use Source\Repository\AccountRepository\AccountRepository;
use Source\Repository\AccountRepository\AccountUpdateRepository;
use Source\Repository\AddressRepository\AddressRepository;
use Source\Utils\FormatExceptionError;
use Source\Utils\MessageValidation;

class AccountHolderRepository extends AccountHolderModel implements AccountHolderInterface {


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
          return $accountHolder->load('address');
        
        } catch (Exception $e) {
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
       
            return ['message'=>$e->getMessage(), 'code'=>$e->getCode()];
        }
    }

    public function accountDeposit(int $accountHolder_id,  $value)
    {
        try {
            $accountHolder = new AccountHoulderFindRepository();
            $account = $accountHolder->getAccountHolder($accountHolder_id);
            $deposit = (new AccountUpdateRepository())->depositValue($account->account, $value);

           
            return $account->load('account'); 

        } catch (Exception $e) {
            
            return ['message'=>$e->getMessage(), 'code'=>$e->getCode()];
        }
    }

    public function accountWithdraw(int $accountHolder_id,  $value)
    {
        try {

            $accountHolder = new AccountHoulderFindRepository();
            $account = $accountHolder->getAccountHolder($accountHolder_id);
            $deposit = (new AccountUpdateRepository())->withdrawValue($account->account, $value);
            return $account->load('account'); 
            
        } catch (Exception $e) {
            
            return ['message'=>$e->getMessage(), 'code'=>$e->getCode()];
        }
    }
}