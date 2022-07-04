<?php 

namespace Source\Utils;

class ResponseMessage 
{
    /**
     * Padroniza o retorno das exceções geradas.
     * @param string $message
     * @param int $code
     * @return array
     */
    public static function errorMensage($message, $code) 
    {
        //return ['message'=>$message, 'code'=>$code];
        $self = new self();
        $self->me = $message;
        return $self;
    }
}