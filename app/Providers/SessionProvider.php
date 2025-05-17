<?php

namespace App\Providers;

use App\Infrastructure\ProviderAbstract;
use App\Services\SessionsService;

final class SessionProvider extends ProviderAbstract
{
    public function boot(): self
    {
        $config = $this->getApplicationConfig();

        $this->bind(SessionsService::class, static function () use ($config) {
            return new SessionsService(
                $config['session']['name'],
                $config['session']['domain'],
                $config['application']['baseUri'],
                $config['session']['lifetime'],
                $config['session']['secure'],
                $config['session']['sameSite'],
            );
        });

        return $this;
    }
}
