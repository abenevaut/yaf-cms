<?php

namespace App\Exceptions\Http;

class NotFoundException extends HttpException
{
    protected $logLevel = 'info';

    public function __construct(string $message = 'Resource not found', ?\Throwable $previous = null)
    {
        parent::__construct($message, 404, $previous);
    }
}
