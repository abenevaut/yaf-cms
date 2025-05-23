<?php

namespace App\Exceptions\Http;

class MethodNotAllowedException extends HttpException
{
    protected $logLevel = 'info';

    public function __construct(string $message = 'Method Not Allowed', ?\Throwable $previous = null)
    {
        parent::__construct($message, 405, $previous);
    }
}
