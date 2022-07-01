<?php

namespace Source\Support;

use DateTime;

class GenerateNumber {

    /**
     * Gera o numero aleatorio
     * @return int
     */
    public function generateNumber() : int
    {
        $random = rand(1000, 9999);
        $now = time();
        $date = (date("mdHis",$now));
        $number = $random . $date;
        return $number;
    } 
}