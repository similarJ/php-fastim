<?php

namespace FastIM\Foundation;

abstract class ServiceProvider {

    public $app;

    public function __construct($app) {
        $this->app = $app;
    }
}