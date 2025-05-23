<?php

namespace App\Facades;

use App\Services\SessionsService;
use App\Infrastructure\FacadeAbstract;

final class Session extends FacadeAbstract
{
    protected static function getFacadeAccessor(): string
    {
        return SessionsService::class;
    }
}
