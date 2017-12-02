<?php

namespace FastIM\Router;

use FastIM\Container\Container;

class Route {

    protected $app;
    protected $controller;
    protected $action;
    protected $methods;
    protected $router;
    protected $namespace = 'App\Controller';

    public function __construct(Container $app) {
        $this->app = $app;
        $this->loadRouter();
    }

    public function bootstrap() {

    }

    public static function loadRouter() {

        require APP_PATH . "/config/router.php";
    }

    public static function tcp($uri, $action) {
        self::addRouter(['tcp'], $uri, $action);
    }

    public static function udp($uri, $action) {
        self::addRouter(['udp'], $uri, $action);
    }

    public function ws($uri, $action) {
        self::addRouter(['ws'], $uri, $action);
    }

    public function runController() {

    }

    public function addRouter($methods = [], $uri, $action) {
        $this->methods = $methods;

        if (stripos($action, '@') !== false) {
            list($action, $controller) = explode('@', $action);
            $this->action = $action;
            $this->controller = $controller;
        }

        $this->reginsterContainerStack($methods, $uri, $action);
    }

    protected function reginsterContainerStack($methods, $uri, $action) {
        if (count($methods) > 1 ) {
            foreach ($methods as $method) {
                $this->setRouteStack($method, $uri, $action);
            }
        } else {
            $this->setRouteStack($methods[0], $uri, $action);
        }
    }

    private function setRouteStack($method, $uri, $action) {

        $key = strtoupper($method) . '/' . $uri;
        $this->app['router'][$key] = [
            'method'      => $method,
            'uri'         => $uri,
            'action'      => [
                'use'     => $action
            ]
        ];
    }

    public function addLookup() {

    }

    public function getMethods() {
        return $this->methods;
    }

    public function getController($uri) {

    }


}