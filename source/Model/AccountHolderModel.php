<?php

namespace Source\Model;

use Illuminate\Database\Eloquent\Model;

class AccountHolderModel  extends Model
{

    protected $table = 'account_holders';
    protected $fillable = ['name','cpf','cnpj','rg','stateRegistration','birthDate','foundationDate','cellphone'];

    private string $name;
    private string $cpf;
    private string $cnpj;
    private string $rg;
    private string $stateRegistration;
    private string $birthDate;
    private string $foundationDate;
    private string $cellphone;
   

    public function getName()
    {
        return $this->name;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function getCnpj()
    {
        return $this->cnpj;
    }

    public function getRg()
    {
        return $this->rg;
    }

    public function getStateRegistration()
    {
        return $this->stateRegistration;
    }

    public function getBirthDate()
    {
        return $this->birthDate;
    }

    public function getFoundationDate()
    {
        return $this->foundationDate;
    }

    public function getCellphone()
    {
        return $this->cellphone;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    }

    public function setCnpj($cnpj)
    {
        $this->cnpj = $cnpj;
    }

    public function setRg($rg)
    {
        $this->rg = $rg;
    }

    public function setStateRegistration($stateRegistration)
    {
        $this->stateRegistration = $stateRegistration;
    }

    public function setBirthDate($birthDate)
    {
        $this->birthDate = $birthDate;
    }

    public function setFoundationDate($foundationDate)
    {
        $this->foundationDate = $foundationDate;
    }

    public function setCellphone($cellphone)
    {
        $this->cellphone = $cellphone;
    }

    public function address()
    {
        return $this->hasOne(AddressModel::class, 'accountHolder_id');
    }
}
