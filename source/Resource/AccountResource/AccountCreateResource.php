<?php

namespace Source\Resource\AccountResource;

class AccountCreateResource {

    /**
     * Padroniza o retorno de criacao de uma Account.
     */
    public function toArray($request)
    {
        $array = array(
            'id'     => $request->id,
            'number' => $request->number, 
            'value'  => $request->value,
            'accountHolder_id' =>$request->accountHolder_id,
        );

        return $array;
    }
}