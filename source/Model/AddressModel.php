<?php

namespace Source\Model;

use Illuminate\Database\Eloquent\Model;

class AddressModel extends Model
{

    protected $table = 'address';
    protected $fillable = ['id','street', 'number', 'cep', 'city', 'uf','accountHolder_id'];

    private string $street; 
    private string $number; 
    private string $cep;
    private string $city; 
    private string $uf;
    private int    $accountHolder_id;

    public function getStreet()
    {
        return $this->street;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getCep()
    {
        return $this->cep;
    }

    public function getCity()
    {
        return $this->city;
    }

    public function getUf()
    {
        return $this->uf;
    }

    public function getAccountholder_id()
    {
        return $this->accountHolder_id;
    }

    public function setStreet($street)
    {
        $this->street = $street;
    }

    public function setNumber($number)
    {
        $this->number = $number;
    }

    public function setCep($cep)
    {
        $this->cep = $cep;
    }

    public function setCity($city)
    {
        $this->city = $city;
    }

    public function setUf($uf)
    {
        $this->uf = $uf;
    }

    public function setAccountholder_id($accountHolder_id)
    {
        $this->accountHolder_id = $accountHolder_id;
    }

    public function account_holder()
    {
        return $this->belongsTo(AccountHolderModel::class);
    }
}
