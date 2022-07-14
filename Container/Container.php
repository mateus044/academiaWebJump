<?php

declare(strict_types=1);

//require __DIR__."../../vendor/autoload.php";

use League\Container\Container;
use Source\Controllers\AccountHolderController;
use Source\Repository\AccountHolderRepository\AccountHolderRepository;


$container = new Container();


$container->add(AccountHolderController::class)->addArgument(AccountHolderRepository::class);
$container->add(AccountHolderController::class);
$controller = $container->get(AccountHolderController::class);


