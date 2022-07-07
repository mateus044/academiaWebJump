<?php

namespace Source\Support;

use Source\Model\AccountHolderModel;
use Source\Utils\MessageValidation;

class ValidateCnpj
{

    private $accountHolders = AccountHolderModel::class;

    /**
     * Validate the entered cnpj
     * @param string $cnpj
     * @return string
     */
    function validarCnpj(string $cnpj)
    {
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);

        if (strlen($cnpj) != 14)
            return MessageValidation::$invalidCnpj;

        if (preg_match('/(\d)\1{13}/', $cnpj))
            return MessageValidation::$invalidCnpj;

        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;

        if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
            return MessageValidation::$invalidCnpj;

        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;
        return ['message' => 'true', 'response' => $cnpj];
        //return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
    }

    /**
     * checks the existence of a cnpj in the database
     * @param int $cnpj
     * @return $cnpj|null
     */
    public function getCnpj(int $cnpj)
    {
        $cnpj = $this->accountHolders::where('cnpj', '=', $cnpj)->first();
        if(!is_null($cnpj))
        {
            return MessageValidation::$cnpjExists; 
        }
        
        return $cnpj;
    }
}
