<?php

namespace Source\Utils;

class MessageValidation 
{
    public static string $onlyPositiveNumbers = "onlyPositiveNumbers";
    public static string $accountExists = "accountExists";
    public static string $accountNotExists = "accountNotExists";
    public static string $onlyString = "onlyString";
    public static string $onlyNumbers = "onlyNumbers";
    public static string $onlyInteger = "onlyInteger";
    public static string $required  = "required";
    public static string $invalidDate = "invalidDate";
    public static string $invalidFormat = "invalidFormat";
    public static string $invalidCpf = "invalidCPF";
    public static string $invalidRg = "invaldRG";
    public static string $invalidCnpj = "invalidCNPJ";
    public static string $invalidSR = "invalidStateRegistration";
    public static string $cpfExists = "cpfExists";
    public static string $cnpjExists = "cnpjExists";
    public static string $invalidCep = "invalidCep";
    public static string $invalidUf  = "invalidUf";
    public static string $accountHolderNotFount  = "accountHolderNotFount";
    public static string $onlyFloat  = "onlyFloat";
    public static string $cpfOrCnpj = "please chose CPF or CNPJ";
    public static string $insufficientFunds = "insufficient fund";
    public static string $transferSuccessfully = "Transfer made successfully";
    public static string $transferInvalid = "The source account number cannot be the same as the transfer destination";
}