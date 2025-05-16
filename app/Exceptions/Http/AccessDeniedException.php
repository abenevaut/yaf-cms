<?php

namespace App\Exceptions\Http;

class AccessDeniedException extends HttpException
{
    protected $logLevel = 'notice';

    public function __construct(string $message = 'Access denied', ?\Throwable $previous = null)
    {
        parent::__construct($message, 403, $previous);
    }
}
