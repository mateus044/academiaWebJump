<?php

namespace Source\Support;

use Source\Utils\MessageValidation;

class ValidateUf {

    public function validarUf(string $uf)
    {
        $array = array(
            1  => "AC",
            2  => "AL",
            3  => "AP",
            4  => "AM",
            5  => "BA",
            6  => "CE",
            7  => "DF",
            8  => "ES",
            9  => "GO",
            10 => "MA",
            11 => "MT",
            12 => "MS",
            13 => "MG",
            14 => "PA",
            15 => "PB",
            16 => "PR",
            17 => "PE",
            18 => "PI",
            19 => "RJ",
            20 => "RN",
            21 => "RS",
            22 => "RO",
            23 => "RR",
            24 => "SC",
            25 => "SP",
            26 => "SE",
            27 => "TO"
        );

        $uf = strtoupper($uf);
        for($i=1; $i<count($array); $i++){
            if($array[$i] === $uf){
                return true;
            } 
        }

        return MessageValidation::$invalidUf;
    }
}