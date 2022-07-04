<?php

namespace Source\Logs;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class Logs
{

    /**
     * Seta logs referente as ações de produto.
     */
    public static function logAccountHolder(string $mensagem, string $modo = 'info')
    {
        //$teste = require __DIR__ ."/../Logs/AccountHolderLogs/accountHolder.log";
        $logger = new Logger('logs');
        $logger->pushHandler(new StreamHandler(dirname(__FILE__) . ''));
        $logger->pushHandler(new StreamHandler(dirname(__FILE__) . '/../Logs/AccountHolderLogs/accountHolder.log'));

        switch ($modo) {

            case 'info':
                $logger->info($mensagem);
                break;

            case 'error':
                $logger->error($mensagem);
                break;

            case 'critical':
                $logger->critical($mensagem);
                break;

            case 'alert':
                $logger->alert($mensagem);
                break;

            default:
                $logger->info($mensagem);
        }
    }

    public static function logAccount(string $mensagem, string $modo = 'info')
    {
        $logger = new Logger('logs');
        $logger->pushHandler(new StreamHandler(dirname(__FILE__) . './account.log'));

        switch ($modo) {

            case 'info':
                $logger->info($mensagem);
                break;

            case 'error':
                $logger->error($mensagem);
                break;

            case 'critical':
                $logger->critical($mensagem);
                break;

            case 'alert':
                $logger->alert($mensagem);
                break;

            default:
                $logger->info($mensagem);
        }
    }

    public static function logAddress(string $mensagem, string $modo = 'info')
    {
        $logger = new Logger('logs');
        $logger->pushHandler(new StreamHandler(dirname(__FILE__) . './address.log'));

        switch ($modo) {

            case 'info':
                $logger->info($mensagem);
                break;

            case 'error':
                $logger->error($mensagem);
                break;

            case 'critical':
                $logger->critical($mensagem);
                break;

            case 'alert':
                $logger->alert($mensagem);
                break;

            default:
                $logger->info($mensagem);
        }
    }
}
