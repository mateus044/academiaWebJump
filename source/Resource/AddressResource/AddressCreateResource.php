<?php

namespace Source\Resource\AddressResource;

class AddressCreateResource {


    /**
     * Padroniza o retorno de sucesso de Address
     */
    public function toArray($request)
    {
        $array = array(
            'id'    => $request->id,
            'street'=> $request->street,
            'number'=> $request->number,
            'cep'   => $request->cep,
            'city'  => $request->city,
            'uf'    => $request->uf,
        );
        return $array;  
    }
}