<?php

namespace Mobileia\Expressive\Installer\Generate;

abstract class BaseHandler extends BaseFile
{
    /**
     * Nombre de la tabla en la DB
     *
     * @var string
     */
    public $name = '';

    public function addRoute($nameHandler, $withParams = '', $isAuth = false)
    {
        $route = new \Mobileia\Expressive\Installer\Added\Router();
        $route->name = $this->name;
        $route->nameHandler = $nameHandler;
        $route->paramsRequired = $withParams;
        $route->isAuth = $isAuth;
        $route->run();
    }
}
