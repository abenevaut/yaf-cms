<?php

use Yaf\Bootstrap_Abstract;
use Yaf\Dispatcher;
use Yaf\Loader;

final class Bootstrap extends Bootstrap_Abstract
{
    public function _initAutoload()
    {
        Loader::getInstance()->import(PROJECT_PATH . '/vendor/autoload.php');
    }

    public function _initTimezone(Dispatcher $dispatcher)
    {
        $timezone = $dispatcher
            ->getApplication()
            ->getConfig()
            ->get('application')
            ->get('timezone');

        date_default_timezone_set($timezone);
    }

    public function _initServices(Dispatcher $dispatcher)
    {
        $services = include(__DIR__ . '/services.php');
        foreach ($services as $service) {
            (new $service($dispatcher))->boot();
        }
    }

    public function _initMiddlewares(Dispatcher $dispatcher)
    {
        $middlewares = include(__DIR__ . '/middlewares.php');
        foreach ($middlewares as $middleware) {
            $dispatcher->registerPlugin(new $middleware);
        }
    }
}
