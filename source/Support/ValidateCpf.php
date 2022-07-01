<?php

namespace Source\Support;


use Exception;
use Source\Model\AccountHolderModel;
use Source\Utils\MessageValidation;

class ValidateCpf {

    private $accountHolders = AccountHolderModel::class;

    /**
    * Valida o CPF informado.
    * @param string $cpf
    * @return $cpf|string
    */
    public function validarCPF(string $cpf)
    {   
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);
        if (strlen($cpf) != 11) {
            return MessageValidation::$invalidCpf;
        }

        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return MessageValidation::$invalidCpf;
        }

        for ($t = 9; $t < 11; $t++) {

            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf[$c] * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf[$c] != $d) {
                return MessageValidation::$invalidCpf;
            }
        }

        $getCPF = $this->getCPF($cpf);

        if(!empty($getCPF))
        {
            return MessageValidation::$cpfExists;
        }
        
        return ['message' => 'true', 'response' => $cpf];
    }

    /**
     * @param int $cpf
     * @return $cpf|null
     */
    public function getCPF(int $cpf)
    {   
        $cpf = $this->accountHolders::where('cpf','=', $cpf)->first();
        return $cpf;
    }
}