<?php

namespace FastIM\Server;

use FastIM\Container\Container;

class Application extends Container {
    const VERSION = '0.1';
    public $server = null;

    public function version() {
        return static::VERSION;
    }

    public function __construct() {
    }

    public function run() {
        $config = loadConfig('server');
        var_dump($config);
        $this->server = new \Swoole\Server($config['ip'], $config['port']);
//        $this->server->set($this->config['Server']);

        $this->server->on('start', [$this, 'onStart']);
        $this->server->on('connect', [$this, 'onConnect']);
        $this->server->on('receive', [$this, 'onReceive']);
        $this->server->on('packet', [$this, 'onPacket']);
        $this->server->start();
    }

    /**
     * @param $server Swoole instance
     * Server启动在主进程的主线程回调此函数
     */
    function onStart($server) {
        var_dump('start');
    }

    /**
     * 接收到数据时回调此函数，发生在worker进程中
     * 思路：  1.检测路由注册。
     *        2.容器根据控制器的类和方法反射，并获取注入依赖。
     *        3。执行控制器方法
     *
     * @param $server
     * @param $fd
     * @param $reactor_id
     * @param $data
     */
    function onReceive($server, $fd, $reactor_id, $data) {

    }

    /**
     * 接收到UDP数据包时回调此函数，发生在worker进程中
     * @param $server
     */
    function onPacket($server) {
        var_dump('packet');
    }

    /**
     * 有新的连接进入时，在worker进程中回调
     * @param $server
     * @param $client_id
     * @param $from_id
     */
    function onConnect($server, $client_id, $from_id) {

        var_dump('connect');
    }

    /**
     * TCP客户端连接关闭后，在worker进程中回调此函数
     * @param $server
     * @param $client_id
     * @param $from_id
     */
    function onClose($server, $client_id, $from_id) {
        var_dump('close');
    }


    /**
     * Server结束时发生
     * [kill -9] cannot call this function,please user [kill -15]
     * @param $server
     */
    function onShutdown($server) {
        echo "shutdown\n";
    }

}