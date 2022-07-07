<?php

namespace Source\Model;

use Illuminate\Database\Eloquent\Model;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AccountHolderModel  extends Model
{

    protected $table = 'account_holders';
    protected $fillable = ['name','cpf','cnpj','password','rg','stateRegistration','birthDate','foundationDate','cellphone'];

    private string $name;
    private string $password;
    private string $rg;
    private string $stateRegistration;
    private string $birthDate;
    private string $foundationDate;
    private string $cellphone;
    private $cnpj;
    private $cpf;
   

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

    public function getPassword()
    {
        return $this->password;
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

    public function setPassword($password)
    {
        $this->password = $password;
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

    public function account()
    {
        return $this->hasOne(AccountModel::class, 'accountHolder_id');
    }
    
    public function Authentication(AccountHolderModel $accountHolderModel)
    {      
        $key = 'example_key';
        if(!is_null($accountHolderModel['cpf']))
        {   
            $payload = [
                'iss' => 'http://example.org',
                'aud' => 'http://example.com',
                'iat' => 1356999524,
                'nbf' => 1357000000,
                'user'              => $accountHolderModel['cpf'],
                'rg'                => $accountHolderModel['cellphone'],
                'stateRegistration' => $accountHolderModel['cellphone'],
                'birthDate'      => $accountHolderModel['cellphone'],
                'foundationDate' => $accountHolderModel['cellphone'],
                'cellphone'      => $accountHolderModel['cellphone']
            ];
        }

        if(!is_null($accountHolderModel['cnpj']))
        {   
            $payload = [
                'iss' => 'http://example.org',
                'aud' => 'http://example.com',
                'iat' => 1356999524,
                'nbf' => 1357000000,
                'user'              => $accountHolderModel['cnpj'],
                'rg'                => $accountHolderModel['cellphone'],
                'stateRegistration' => $accountHolderModel['cellphone'],
                'birthDate'      => $accountHolderModel['cellphone'],
                'foundationDate' => $accountHolderModel['cellphone'],
                'cellphone'      => $accountHolderModel['cellphone']
            ];
        }
        $jwt = JWT::encode($payload, $key, 'HS256');
        return $jwt;
    }
}
