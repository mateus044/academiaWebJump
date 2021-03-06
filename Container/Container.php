<?php

declare(strict_types=1);

//require __DIR__."/../vendor/autoload.php";

use Illuminate\Database\Eloquent\Model;
use League\Container\Container;
use Source\Controllers\AccountHolderController;
use Source\Model\AccountHolderModel;
use Source\Repository\AccountHolderRepository\AccountHolderRepository;


$container = new Container();

$container->add(AccountHolderController::class)->addArgument(AccountHolderRepository::class);
$container->add(AccountHolderRepository::class)->addArgument(AccountHolderModel::class);
$container->add(AccountHolderRepository::class)->addArgument(Model::class);
$container->get(AccountHolderController::class);
