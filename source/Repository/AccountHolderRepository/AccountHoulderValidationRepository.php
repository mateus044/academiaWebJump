<?php

namespace Source\Repository\AccountHolderRepository;

use Source\Interfaces\AccountHolderInterface\AccountHoulderValidationInterface;
use Source\Model\AccountHolderModel;
use Source\Support\ValidateCnpj;
use Source\Support\ValidateCpf;
use Source\Support\ValidateDate;
use Source\Utils\MessageValidation;

/**
 *@property bool $isValid
 *@property string[] $message
 */
class AccountHoulderValidationRepository extends AccountHolderModel implements AccountHoulderValidationInterface
{

    public array $message;
    public bool $isValid;

    public function validateAccountHolder(array $data)
    {
        $this->validateFormAccountHoulder($data);

        if ($this->isValid) {
            return $this->mountAccountHoulder();
        } else {
            return $this;
        }
    }

    public function mountAccountHoulder()
    {

        $array = array(
            'name' => $this->getName(),
            'cpf'  => $this->getCpf(),
            'cnpj' => $this->getCnpj(),
            'rg'   => $this->getRg(),
            'stateRegistration' => $this->getStateRegistration(),
            'birthDate'         => $this->getBirthDate(),
            'foundationDate'    => $this->getFoundationDate(),
            'cellphone'         => $this->getCellphone()
        );

        return $array;
    }

    public function validateFormAccountHoulder($data)
    {
        $array = [];
        $array['name']  = $this->_name($data);
        $array['cpf']   = $this->_cpf($data);
        $array['cnpj']  = $this->_cnpj($data);
        $array['rg']    = $this->_rg($data);
        $array['stateRegistration'] = $this->_stateRegistration($data);
        $array['birthDate']        = $this->_birthDate($data);
        $array['foundationDate']   = $this->_foundationDate($data);
        $array['cellphone']        = $this->_cellphone($data);

        $array =  array_filter($array, function ($data) {
            return $data != null;
        });

        $state = !empty($array);

        if ($state) {
            $this->message = $array;
            $this->isValid    = false;
        } else {

            $this->message = [];
            $this->isValid = true;
        }
    }


    /**
     * valida o campo name
     * return string|null
     */
    private function _name($data)
    {
        if (!isset($data['name'])) {
            return MessageValidation::$required;
        }

        if (!is_string($data['name'])) {
            return MessageValidation::$onlyString;
        }

        $this->setName($data['name']);
        return null;
    }

    /**
     * valida o campo cpf
     * return string|null
     */
    private function _cpf($data)
    {
        if (!isset($data['cpf'])) {
            return MessageValidation::$required;
        }

        if (!is_string($data['cpf'])) {
            return MessageValidation::$onlyString;
        }

        $cpf = (new ValidateCpf())->validarCPF($data['cpf']);

        if (!is_array($cpf)) {
            return $cpf;
        }

        $this->setCpf($cpf['response']);
        return null;
    }

    /**
     * valida o campo cnpj
     * return string|null
     */
    private function _cnpj($data)
    {
        if (!isset($data['cnpj'])) {
            return MessageValidation::$required;
        }

        if (!is_string($data['cnpj'])) {
            return MessageValidation::$onlyString;
        }

        $cnpj = (new ValidateCnpj())->validarCnpj($data['cnpj']);
        if (!is_array($cnpj)) {

            return $cnpj;
        }

        $this->setCnpj($cnpj['response']);
        return null;
    }

    /**
     * valida o campo rg
     * return string|null
     */
    private function _rg($data)
    {
        if (!isset($data['rg'])) {
            return MessageValidation::$required;
        }

        if (!is_string($data['rg'])) {
            return MessageValidation::$onlyString;
        }

        $this->setRg($data['rg']);
        return null;
    }

    /**
     * valida o campo stateRegistration
     * return string|null
     */
    private function _stateRegistration($data)
    {

        if (!isset($data['stateRegistration'])) {
            return MessageValidation::$required;
        }

        if (!is_string($data['stateRegistration'])) {
            return MessageValidation::$onlyString;
        }

        $this->setStateRegistration($data['stateRegistration']);

        return null;
    }

    /**
     * valida o campo birthDate
     * return string|null
     */
    private function _birthDate($data)
    {
        if (!isset($data['birthDate'])) {
            return MessageValidation::$required;
        }

        $birthDate = (new ValidateDate())->validaData($data['birthDate']);
        if (is_string($birthDate)) {
            return $birthDate;
        }

        $this->setBirthDate($data['birthDate']);
        return null;
    }

    /**
     * valida o campo foundationDate
     * return string|null
     */
    private function _foundationDate($data)
    {
        if (!isset($data['foundationDate'])) {
            return MessageValidation::$required;
        }

        $foundationDate = (new ValidateDate())->validaData($data['foundationDate']);
        if (is_string($foundationDate)) {
            return $foundationDate;
        }

        $this->setFoundationDate($data['foundationDate']);
        return null;
    }

    /**
     * valida o campo cellphone
     * return string|null
     */
    private function _cellphone($data)
    {
        if (!isset($data['cellphone'])) {
            return MessageValidation::$required;
        }

        $this->setCellphone($data['cellphone']);
    }
}
