<?php

namespace Source\Controllers;

use Source\Repository\AccountHolderRepository\AccountHolderRepository;
use Source\Resource\AccountHolderResource\AccountHolderCreateResource;
use Source\Resource\AccountHolderResource\AccountHolderResource;
use PlugHttp\Response;
use Source\Utils\FromJson;
use Pecee\Http\Request;

class AccountHolderController
{

    public function storageAccount()
    {
        $request  = new Request();
        $address  = $request->getInputHandler()->value('address');
        $array = array(

            'name'              => $request->getInputHandler()->value('name'),
            'cpf'               => $request->getInputHandler()->value('cpf'),
            'password'          => $request->getInputHandler()->value('password'),
            'cnpj'              => $request->getInputHandler()->value('cnpj'),
            'rg'                => $request->getInputHandler()->value('rg'),
            'stateRegistration' => $request->getInputHandler()->value('stateRegistration'),
            'birthDate'         => $request->getInputHandler()->value('birthDate'),
            'foundationDate'    => $request->getInputHandler()->value('foundationDate'),
            'cellphone'         => $request->getInputHandler()->value('cellphone'),
            'address'           => is_null($address)  ? $address = [] : $address = $address
        );

        $httpResponse  = new Response();
        $accountHolder = new AccountHolderRepository();
        $response = $accountHolder->storageAccountHolder($array);
        if (isset($response['code'])) {

            $json = FromJson::fromJsonError($response['message'], $response['code']);
            return $httpResponse->setStatusCode($response['code'])->response()->json($json);
        } else {

            $error = (new AccountHolderCreateResource())->toArray($response);
            return $httpResponse->setStatusCode(201)->response()->json($error);
        }
    }

    public function createAccount()
    {
        $request = new Request();    
        $accountHolder_id = $request->getInputHandler()->value('accountHolder');
        $value            = $request->getInputHandler()->value('value');

        is_null($accountHolder_id) ? $accountHolder_id = 0 : $accountHolder_id = $accountHolder_id;
        is_null($value) ? $value = 0 : $value = $value;

        $array = array(
            'value' => $value,
            'number' => null,
            'accountHolder_id' => null
        );

        $httpResponse = new Response();
        $accountHolder = new AccountHolderRepository();
        $response = $accountHolder->createAccount($accountHolder_id, $array);
        if (isset($response['code'])) {

            $json = FromJson::fromJsonError($response['message'], $response['code']);
            return $httpResponse->setStatusCode($response['code'])->response()->json($json);
        } else {

            $account = (new AccountHolderResource())->toArray($response);
            return $httpResponse->setStatusCode(201)->response()->json($account);
        }
    }

    public function depositAccount()
    {
        $request = new Request();
        $accountHolder_id = $request->getInputHandler()->value('accountHolder');
        $value            = $request->getInputHandler()->value('value');

        is_null($accountHolder_id) ? $accountHolder_id = 0 :  $accountHolder_id = $accountHolder_id;
        is_null($value) ? $value = 0 : $value = $value;

        $httpResponse  = new Response();
        $accountHolder = new AccountHolderRepository();
        $response = $accountHolder->accountDeposit($accountHolder_id, $value);

        if (isset($response['code'])) {

            $json = FromJson::fromJsonError($response['message'], $response['code']);
            return $httpResponse->setStatusCode($response['code'])->response()->json($json);
        } else {

            $account = (new AccountHolderResource())->toArray($response);
            return $httpResponse->setStatusCode(200)->response()->json($account);
        }
    }

    public function withdrawAccount(Request $request)
    {
        $request = new Request();
        $accountHolder_id = $request->getInputHandler()->value('accountHolder');
        $value            = $request->getInputHandler()->value('value');

        is_null($accountHolder_id) ? $accountHolder_id = 0 : $accountHolder_id = $accountHolder_id;
        is_null($value)  ? $value  = 0  : $value = $value;

        $httpResponse  = new Response();
        $accountHolder = new AccountHolderRepository();
        $response = $accountHolder->accountWithdraw($accountHolder_id, $value);

        if (isset($response['code'])) {

            $json = FromJson::fromJsonError($response['message'], $response['code']);
            return $httpResponse->setStatusCode($response['code'])->response()->json($json);
        } else {

            $account = (new AccountHolderResource())->toArray($response);
            return $httpResponse->setStatusCode(200)->response()->json($account);
        }
    }

    public function transferAccount()
    {
        $request = new Request();
        $accountHolder_id  = $request->getInputHandler()->value('accountHolder');
        $numberAccount     = $request->getInputHandler()->value('numberAccount');
        $value             = $request->getInputHandler()->value('value');

        is_null($accountHolder_id) ? $accountHolder_id = 0 : $accountHolder_id = $accountHolder_id;
        is_null($numberAccount)    ? $numberAccount = 0    : $numberAccount    = $numberAccount;
        is_null($value)            ? $value         = 0    : $value            = $value;

        $httpResponse  = new Response();
        $accountHolder = new AccountHolderRepository();
        $response      = $accountHolder->accountTransfer($accountHolder_id, $numberAccount, $value);

        if (isset($response['code'])) {

            $json = FromJson::fromJsonError($response['message'], $response['code']);
            return $httpResponse->setStatusCode($response['code'])->response()->json($json);
        } else {

            $account = (new AccountHolderResource())->toArray($response);
            return $httpResponse->setStatusCode(200)->response()->json($account);
        }
    }

    public function invalidToken()
    {
        $accountHolder = new AccountHolderRepository();
        $httpResponse  = new Response();
        $response = $accountHolder->invalidToken();
        return $httpResponse->setStatusCode($response['code'])->response()->json($response);
    }
}
