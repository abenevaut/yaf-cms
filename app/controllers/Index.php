<?php

use App\Infrastructure\ControllerAbstract;

class IndexController extends ControllerAbstract
{
    public function indexAction()
    {
        $this->getView()->assign('content', 'Hello World');

        return $this->render('index');
    }
}
