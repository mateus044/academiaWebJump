<?php

namespace Source\Utils;

class FromJson {


    public static function fromJsonError($message, $code)
    {  
        $temp = json_decode($message);
        $temp->code = $code;
        return $temp;
    }
}