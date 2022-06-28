<?php

namespace Source\Support;

use DateTime;
use Source\Utils\MessageValidation;

class ValidateDate {
    

    /**
     * @param string $data
     * @return string|array
     */
    public function validaData(string $data)
    {   
        $format   = 'd-m-Y';
        $response = DateTime::createFromFormat($format, $data);
        $result   = $response && $response->format($format) == $data;
    
        if(!$result)
        {   
            return MessageValidation::$invalidDate;
        }

        return $result;      
    }
}