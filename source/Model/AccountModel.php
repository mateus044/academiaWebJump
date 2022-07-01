<?php

namespace Source\Model;

use Illuminate\Database\Eloquent\Model;

class AccountModel extends Model { 

    protected $table = 'accounts';
    protected $fillable = ['id','value','number','accountHolder_id'];

    private float $value;
    private int $number;
    private int $accountHolder_id;

    public function getValue()
    {
        return $this->value;
    }

    public function getNumber()
    {
        return $this->number;
    }

    public function getAccountHolder_id()
    {
        return $this->accountHolder_id;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function setNumber($number)
    {
        $this->number = $number;
    }

    public function setAccountHolder_id($accountHolder_id)
    {
        $this->accountHolder_id = $accountHolder_id;
    }
}
