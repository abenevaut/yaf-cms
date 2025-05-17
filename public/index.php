<?php

define('PROJECT_PATH', dirname(dirname(__FILE__)));

$app = (new \Yaf\Application(PROJECT_PATH . '/app.ini'));
$app->getDispatcher()->throwException(true);
$app->getDispatcher()->catchException(true);
$app
    ->bootstrap()
    ->run();
