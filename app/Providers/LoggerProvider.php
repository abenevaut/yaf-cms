<?php

namespace App\Providers;

use App\Infrastructure\ProviderAbstract;
use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RotatingFileHandler;
use Monolog\Level;
use Monolog\Logger;

final class  LoggerProvider extends ProviderAbstract
{
    public function boot(): self
    {
        $config = $this->getApplicationConfig();

        $this->bind(Logger::class, static function () use ($config) {
            $hit = uniqid();
            $timezone = $config->get('application')['timezone'];
            $logger = new Logger('default');
            $handler = new RotatingFileHandler(
                $config['logger']['directory'],
                $config['logger']['maxFiles'],
                Level::fromName($config['logger']['level'])
            );
            $formatter = new LineFormatter(
                "[%datetime%] %channel%.%level_name%: %message% %context% %extra%\n",
                'Y-m-d H:i:s'
            );

            $handler->setFormatter($formatter);

            return $logger
                ->setTimezone(new \DateTimeZone($timezone))
                ->pushHandler($handler)
                ->pushProcessor(function ($record) use ($hit) {
                    $record->extra['hit'] = $hit;

                    return $record;
                })
            ;
        });

        return $this;
    }
}
