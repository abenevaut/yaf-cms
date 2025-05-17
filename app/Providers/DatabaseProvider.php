<?php

namespace App\Providers;

use App\Facades\Env;
use App\Infrastructure\ProviderAbstract;
use Illuminate\Database\Capsule\Manager as EloquentCapsule;
use Illuminate\Database\Eloquent\Model as EloquentModel;

final class DatabaseProvider extends ProviderAbstract
{
    public function boot(): self
    {
        if (Env::isNotProduction()) {
            EloquentModel::preventLazyLoading();
        }

        $config = $this->getApplicationConfig();

        $this->singleton(EloquentCapsule::class, static function () use ($config) {
            $capsule = new EloquentCapsule();

            foreach ($config['databases'] as $dbName => $dbConfig) {
                $capsule->addConnection($dbConfig, $dbName);
            }

            $capsule->bootEloquent();

            return $capsule;
        });

        return $this;
    }
}
