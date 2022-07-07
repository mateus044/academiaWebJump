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
            'token'   => $request,
        );

        return $array;        
    } 
}