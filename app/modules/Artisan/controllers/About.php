<?php

use Yaf\Controller_Abstract;

class AboutController extends Controller_Abstract
{
    public function handleAction()
    {
        $content = 'Yet another YAF framework';

        $this->getView()->assign('content', $content);

        echo $content . PHP_EOL;

        return false;
    }
}
