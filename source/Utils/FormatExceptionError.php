<?php

namespace Source\Utils;

class FormatExceptionError {


    /**
     * Formata as exceptiosn geradas completamente em um thows
     */
    public static function exceptionError($message)
    {
        return ['message'=>$message];
    }
}