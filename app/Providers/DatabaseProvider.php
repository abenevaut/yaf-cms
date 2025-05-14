<?php

namespace App\Providers;

use App\Infrastructure\ProviderAbstract;
use App\Services\Environment;
use Illuminate\Database\Capsule\Manager as EloquentCapsule;
use Illuminate\Database\Eloquent\Model as EloquentModel;

final class DatabaseProvider extends ProviderAbstract
{
    public function boot(): self
    {
        if (Environment::isNotProduction()) {
            EloquentModel::preventLazyLoading();
        }

        $config = $this->dispatcher->getApplication()->getConfig();

        $this->singleton(EloquentCapsule::class, static function () use ($config) {
            $capsule = new EloquentCapsule();

            foreach ($config->get('database')->toArray() as $dbName => $dbConfig) {
                $capsule->addConnection($dbConfig, $dbName);
            }

            $capsule->bootEloquent();

            return $capsule;
        });

        return $this;
    }
}
