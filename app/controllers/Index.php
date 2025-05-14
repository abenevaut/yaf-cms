<?php

use App\Facades\Log;
use App\Infrastructure\ControllerAbstract;

class IndexController extends ControllerAbstract
{
    public function indexAction()
    {
        $this->getView()->content = 'Hello World';

        Log::debug("View content", ['content' => $this->getView()->content]);
    }
}
