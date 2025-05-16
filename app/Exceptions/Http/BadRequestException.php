<?php

namespace App\Exceptions\Http;

class BadRequestException extends HttpException
{
    protected $logLevel = 'info';

    public function __construct(string $message = 'Bad request', ?\Throwable $previous = null)
    {
        parent::__construct($message, 400, $previous);
    }
}
