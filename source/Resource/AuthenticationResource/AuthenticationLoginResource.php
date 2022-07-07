<?php

namespace Source\Resource\AuthenticationResource;

class AuthenticationLoginResource 
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
            'status'        => 'logged'
        );

        return $array;        
    } 
}