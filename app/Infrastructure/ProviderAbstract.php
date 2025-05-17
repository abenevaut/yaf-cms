<?php

namespace App\Infrastructure;

use App\Exceptions\ServiceAlreadyRegisteredException;
use App\Services\CollectionsService;
use Yaf\Dispatcher;
use Yaf\Registry;

abstract class ProviderAbstract
{
    public function __construct(protected Dispatcher $dispatcher) {}

    abstract public function boot(): self;

    protected function getApplicationConfig(): CollectionsAbstract
    {
        $appConfig = $this
            ->dispatcher
            ->getApplication()
            ->getConfig()
            ->toArray();

        return new CollectionsService($appConfig, []);
    }

    /**
     * @throws ServiceAlreadyRegisteredException
     */
    protected function bind(string $serviceName, \Closure $serviceInstance): self
    {
        return $this
            ->isServiceRegistered($serviceName)
            // Register service as an instance
            ->registerService($serviceName, call_user_func($serviceInstance));
    }

    /**
     * @throws ServiceAlreadyRegisteredException
     */
    protected function singleton(string $serviceName, \Closure $serviceInstance): self
    {
        return $this
            ->isServiceRegistered($serviceName)
            // Register service as a \Closure to be instantiated later
            ->registerService($serviceName, $serviceInstance);
    }

    /**
     * @throws ServiceAlreadyRegisteredException
     */
    private function isServiceRegistered($serviceName): self
    {
        if (Registry::get($serviceName)) {
            throw new ServiceAlreadyRegisteredException($serviceName);
        }

        return $this;
    }

    private function registerService(string $serviceName, mixed $serviceInstance): self
    {
        Registry::set($serviceName, $serviceInstance);

        return $this;
    }
}
