<?php

require __DIR__."/vendor/autoload.php";

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule();

$config = [

    "driver" => "mysql",
    "host" => "db",
    "database" => "trilha",
    "username" => "root",
    "password" => "D7dUKOiqMTroupS0J94-uzBdo4Op9QR_",
    "charset"   => "utf8",
    "collation" => "utf8_unicode_ci",
];

$capsule->addConnection($config);
$capsule->setAsGlobal();
$capsule->bootEloquent();
