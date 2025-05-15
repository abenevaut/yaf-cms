<?php

namespace App\Infrastructure;

use Yaf\Controller_Abstract;

abstract class CommandControllerAbstract extends Controller_Abstract
{
    public function write(string $line): self
    {
        echo $line . PHP_EOL;

        return $this;
    }

    public function success()
    {
        return true;
    }

    public function failure()
    {
        exit(1);
    }
}
