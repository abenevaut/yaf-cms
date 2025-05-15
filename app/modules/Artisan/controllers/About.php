<?php

use App\Infrastructure\CommandControllerAbstract;

class AboutController extends CommandControllerAbstract
{
    public function handleAction()
    {
        $content = 'Yet another YAF framework';

        $this->getView()->assign('content', $content);

        $this->write($content);

        return $this->success();
    }
}
