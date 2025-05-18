<?php

use App\Infrastructure\ControllerAbstract;

class IndexController extends ControllerAbstract
{
    public function indexAction()
    {
        \App\Facades\View::setTitle('Hello World');
        $this->getView()->assign('content', 'Hello World');

        return $this->render('index');
    }
}
