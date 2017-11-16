<?php

namespace FastIM\Container;

class Container {
    protected static $instance = null;

    /**
     * instance of this Container
     * @return static
     */
    public static function getInstance() {
        if (is_null(static::$instance)) {
            static::$instance = new static;
        }

        return static::$instance;
    }
}

