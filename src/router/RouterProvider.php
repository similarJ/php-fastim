<?php

namespace FastIM\Router;

use FastIM\Container\Container;
use FastIM\Foundation\ServiceProvider;

class RouterProvider extends ServiceProvider {

    public function register() {
        $this->registerRouter();
        $this->registerDispatch();
    }

    public function registerRouter() {
        Route::loadRouter();
    }

    public function registerDispatch() {
        require APP_PATH . '/config/router.php';
    }
}