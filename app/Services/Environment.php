<?php

namespace App\Services;

use Yaf\Application;

final class Environment
{
    public static function isProduction(): bool
    {
        return static::isEnvironment('production');
    }

    public static function isNotProduction(): bool
    {
        return !static::isProduction();
    }

    public static function isEnvironment(string $environment): bool
    {
        return Application::getInstance()->environ() === $environment;
    }
}
