<?php

namespace Source\Logs;

use DateTime;
use Monolog\Handler\BrowserConsoleHandler;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use Source\Utils\LevelLogs;

class Logs
{
    public static function logAccountHolder(string $mensagem, $user, string $modo)
    {
        $logger = new Logger('logs');
        $logger->pushHandler(new BrowserConsoleHandler(Logger::DEBUG));
        $logger->pushHandler(new StreamHandler(dirname(__FILE__) . '/../Logs/AccountHolderLogs/accountHolder.log'));
        $logger->pushProcessor(function($record){
            $record["extra"]["data"] =  (date("YmdHis"));
            return $record;
        });

        switch ($modo) {

            case 'info':
                $logger->info($mensagem,["user" => $user]);
                break;

            case 'error':
                $logger->error($mensagem,["user" => $user]);
                break;

            case 'critical':
                $logger->critical($mensagem,["user" => $user]);
                break;

            case 'alert':
                $logger->alert($mensagem,["user" => $user]);
                break;
            
            case 'alert':
                $logger->alert($mensagem,["user" => $user]);
                break;

            case 'debug':
               
                $logger->debug($mensagem,["user" => $user]);
                break;

            default:
                $logger->info($mensagem,["user" => $user]);
        }
    }

    public static function logAccount(string $mensagem, $user, string $modo = LevelLogs::DEBUG)
    {
        $logger = new Logger('logs');
        $logger->pushHandler(new BrowserConsoleHandler(Logger::DEBUG));
        $logger->pushHandler(new StreamHandler(dirname(__FILE__) . '/../Logs/AccountLogs/account.log'));
        $logger->pushProcessor(function($record){
            $record["extra"]["data"] =  (date("YmdHis"));
            return $record;
        });

        switch ($modo) {

            case 'info':
                $logger->info($mensagem,["user" => $user]);
                break;

            case 'error':
                $logger->error($mensagem,["user" => $user]);
                break;

            case 'critical':
                $logger->critical($mensagem,["user" => $user]);
                break;

            case 'alert':
                $logger->alert($mensagem,["user" => $user]);
                break;
            
            case 'alert':
                $logger->alert($mensagem,["user" => $user]);
                break;

            case 'debug':
               
                $logger->debug($mensagem,["user" => $user]);
                break;

            default:
                $logger->info($mensagem,["user" => $user]);
        }
    }

    public static function logAddress(string $mensagem, $address, string $modo = 'info')
    {
        $logger = new Logger('logs');
        $logger->pushHandler(new BrowserConsoleHandler(Logger::DEBUG));
        $logger->pushHandler(new StreamHandler(dirname(__FILE__) . '/../Logs/AddressLogs/address.log'));
        $logger->pushProcessor(function($record){
            $record["extra"]["data"] =  (date("YmdHis"));
            return $record;
        });

        switch ($modo) {

            case 'info':
                $logger->info($mensagem, ["user" => $address]);
                break;

            case 'error':
                $logger->error($mensagem, ["user" => $address]);
                break;

            case 'critical':
                $logger->critical($mensagem, ["user" => $address]);
                break;

            case 'alert':
                $logger->alert($mensagem, ["user" => $address]);
                break;

            case 'debug':
               
                $logger->debug($mensagem,["user" => $address]);
                break;

            default:
                $logger->info($mensagem, ["user" => $address]);
        }
    }
}
