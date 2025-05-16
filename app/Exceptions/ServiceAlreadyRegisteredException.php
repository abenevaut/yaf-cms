<?php

namespace App\Exceptions;

class ServiceAlreadyRegisteredException extends \Exception
{
    public function __construct(string $serviceName)
    {
        parent::__construct("Service {$serviceName} already registered.");
    }
}
