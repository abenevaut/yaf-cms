<?php

namespace App\Facades;

use App\Services\ViewsService;
use App\Infrastructure\FacadeAbstract;

final class View extends FacadeAbstract
{
    protected static function getFacadeAccessor(): string
    {
        return ViewsService::class;
    }
}
