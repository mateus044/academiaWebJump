<?php

const DATA_LAYER_CONFIG = [
    "driver" => "mysql",
    "host" => "db",
    "port" => "3306",
    "dbname" => "trilha",
    "username" => "root",
    "passwd" => "D7dUKOiqMTroupS0J94-uzBdo4Op9QR_",
    "options" => [
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
        PDO::ATTR_CASE => PDO::CASE_NATURAL
    ]
];

define("URL_BASE", "http://webjump.academia.localhost/");