<?php

define('PROJECT_PATH', dirname(dirname(__FILE__)));

$app = (new \Yaf\Application(PROJECT_PATH . '/app.ini'));
$app
    ->bootstrap()
    ->run();
