<?php

namespace FastIM\Foundation;

use FastIM\Container\Container;
use FastIM\Router\Route;
use FastIM\Router\RouterProvider;

class Application extends Container {

    const VERSION = '0.0.1';

    public function version()
    {
        return static::VERSION;
    }

    public function __construct() {
//        $this->registerAlias();
        static::setInstance($this);
        $this->registerBaseProvider();
    }

    protected function registerBaseProvider() {
        $this->make(RouterProvider::class, ['app'=>$this])->register();
    }

}