<?php

namespace Source\Support;

use Source\Model\AccountHolderModel;
use Source\Utils\MessageValidation;

class ValidateCnpj
{

    private $accountHolders = AccountHolderModel::class;


    /**
     * Valida o CNPJ informado.
     * @param string $cnpj
     * @return $cpf|Exception
     */
    function validarCnpj(string $cnpj)
    {
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);

        // Valida tamanho
        if (strlen($cnpj) != 14)
            return MessageValidation::$invalidCnpj;

        // Verifica se todos os digitos são iguais
        if (preg_match('/(\d)\1{13}/', $cnpj))
            return MessageValidation::$invalidCnpj;


        // Valida primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;

        if ($cnpj[12] != ($resto < 2 ? 0 : 11 - $resto))
            return MessageValidation::$invalidCnpj;

        // Valida segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++) {
            $soma += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;
        $getCnpj = $this->getCnpj($cnpj);

        if (!empty($getCnpj)) 
        {
            return MessageValidation::$cnpjExists;
        }
        
        return ['message' => 'true', 'response' => $cnpj];
        //return $cnpj[13] == ($resto < 2 ? 0 : 11 - $resto);
    }

    /**
     * @param int $cnpj
     * @return $cnpj|null
     */
    public function getCnpj(int $cnpj)
    {
        $cnpj = $this->accountHolders::where('cnpj', '=', $cnpj)->first();
        return $cnpj;
    }
}
