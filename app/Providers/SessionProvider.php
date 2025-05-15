<?php

namespace App\Providers;

use App\Infrastructure\ProviderAbstract;
use App\Services\SessionService;

final class SessionProvider extends ProviderAbstract
{
    public function boot(): self
    {
        $config = $this->getApplicationConfig();

        $this->singleton(SessionService::class, static function () use ($config) {
            return new SessionService(
                $config->get('session')->get('name'),
                $config->get('session')->get('domain'),
                $config->get('application')->get('baseUri'),
                $config->get('session')->get('lifetime'),
                $config->get('session')->get('secure'),
                $config->get('session')->get('sameSite')
            );
        });

        return $this;
    }
}
