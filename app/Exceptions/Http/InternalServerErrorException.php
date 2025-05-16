<?php

namespace App\Exceptions\Http;

class InternalServerErrorException extends HttpException
{
    protected $logLevel = 'info';

    public function __construct(string $message = 'Internal server error', ?\Throwable $previous = null)
    {
        parent::__construct($message, 500, $previous);
    }
}
