<?php

use App\Infrastructure\ControllerAbstract;

class IndexController extends ControllerAbstract
{
    public function indexAction()
    {
        $this->getView()->assign('content', 'Hello World');

        throw new \App\Exceptions\Http\AccessDeniedHttpException();

        return $this->render('index');
    }
}
