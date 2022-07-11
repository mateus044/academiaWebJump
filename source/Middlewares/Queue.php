<?php

namespace Source\Middlewares;

class Queue 
{

    /**
     * Fila de middlewares vazias
     * @var array
     */
    private $middlewares = [];

    /**
     * @var Clousure
     */
    private $controller;

    /**
     * @var array
     */
    private $controllerArgs = [];

    /**
     * @param array $middlewares
     * @param Clousure $controller
     * @param array $controllerArgs
     */
    public function __construct($middlewares, $controller, $controllerArgs)
    {   
        $this->middlewares = $middlewares;
        $this->controller = $controller;
        $this->controllerArgs = $controllerArgs;
    }


}