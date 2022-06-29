<?php

namespace Source\Support;

use Source\Utils\MessageValidation;

class ValidateCep
{

    /**
     * Valida o CEP informado.
     * @param string $$cep
     * @return string|bool
     */
    public function validarCep(string $cep)
    {
        if (preg_match('/[0-9]{5,5}([-]?[0-9]{4})?$/', $cep)) {
            return MessageValidation::$invalidCep;
        } else {
            return true;
        }
    }
}
