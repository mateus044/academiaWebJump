<?php

namespace Source\Resource\AccountHolderResource;

use Source\Resource\AddressResource\AddressCreateResource;

class AccountHolderCreateResource 
{
    /**
     * standardizes the successful return of the account holder
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
            'addres'         => (new AddressCreateResource())->toArray($request->address)
        );

        return $array;        
    }
}