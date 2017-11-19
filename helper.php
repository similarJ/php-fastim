<?php

function loadConfig($conf) {
    $file = APP_PATH . '/config/' . $conf . '.php';
    return file_exists($file) ? require_once $file : exit('config file not exists!');
}