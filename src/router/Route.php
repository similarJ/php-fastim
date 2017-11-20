<?php

namespace FastIM\Router;

use FastIM\Container\Container;

class Route {
    public $methods;

    public function tcp($uri, $action) {
        $this->addRouter(['tcp'], $uri, $action);
    }

    public function udp($uri, $action) {
        $this->addRouter(['udp'], $uri, $action);
    }

    public function ws($uri, $action) {
        $this->addRouter(['ws'], $uri, $action);
    }

    public function addRouter($methods = [], $uri, $action) {
        $this->methods = $methods;
    }


    public function getMethods() {
        return $this->methods;
    }


}