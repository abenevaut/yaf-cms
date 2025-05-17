<?php

namespace App\Providers;

use App\Infrastructure\ProviderAbstract;
use App\Services\ViewsService;

final class ViewProvider extends ProviderAbstract
{
    public function boot(): self
    {
        $config = $this->getApplicationConfig();

        $this->singleton(ViewsService::class, static function () use ($config) {
            return new ViewsService(
                "{$config['application']['directory']}/views",
            );
        });

        return $this;
    }
}
