<?php

namespace Source\Resource\AccountHolderResource;

use Source\Resource\AccountResource\AccountCreateResource;
use Source\Resource\AddressResource\AddressCreateResource;

class AccountHolderResource {


    /**
     * Padroniza o retorno de sucesso do accountholder.
     */
    public function toArray($request)
    {
        $array = array(
            'id'   => $request->id,
            'name' => $request->name,
            'cpf'  => $request->cpf,
            'cnpj' => $request->cnpj,
            'rg'   => $request->rg,
            'stateRegistration' => $request->stateRegistration,
            'birthDate'      => $request->birthDate,
            'foundationDate' => $request->foundationDate,
            'cellphone'      => $request->cellphone,
            'account'        => (new AccountCreateResource())->toArray($request->account)
        );

        return $array;        
    }
}