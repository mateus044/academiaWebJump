<?php

require __DIR__."../../vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as DB;
use Illuminate\Events\Dispatcher;
use \Illuminate\Container\Container as Container;

$capsule = new DB();

$config = [

    "driver" => "mysql",
    "host" => "localhost",
    "database" => "trilha",
    "username" => "root",
    "password" => "",
    "charset"   => "utf8",
    "collation" => "utf8_unicode_ci",
];


$capsule->addConnection($config);
$capsule->getConnection();
$capsule->setEventDispatcher(new Dispatcher(new Container));
$capsule->setAsGlobal();
$capsule->bootEloquent();

