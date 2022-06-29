<?php

namespace Source\Resource\AccountHolderResource;

use Source\Resource\AddressResource\AddressCreateResource;

class AccountHolderCreateResource {


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
            'addres'         => (new AddressCreateResource())->toArray($request->address)
        );

        $resul = json_encode($array, JSON_PRETTY_PRINT);
        return $resul;        
    }
}