<?php

namespace blink\laravel\database;

use PDO;
use blink\console\events\CommandRegistering;
use blink\di\Container;
use blink\di\ServiceProvider;
use blink\eventbus\EventBus;
use blink\laravel\database\commands\MakeCommand;
use blink\laravel\database\commands\MigrateCommand;
use blink\laravel\database\commands\ResetCommand;

class DatabaseServiceProvider extends ServiceProvider
{
    public function register(Container $container): void
    {
        $container->bind(Manager::class, [
            'fetch' => PDO::FETCH_CLASS,
            'default' => 'mysql',
            'connections' => [
                'mysql' => [
                    'driver' => 'mysql',
                    'database' => env('mysql_database', ''),
                    'host' => env('mysql_host', '127.0.0.1'),
                    'port' => env('mysql_port', '3306'),
                    'username' => env('mysql_username', ''),
                    'password' => env('mysql_password', ''),
                    'charset' => 'utf8mb4',
                    'collation' => 'utf8mb4_unicode_ci',
                    'prefix' => '',
                ],
            ],
        ]);

        /** @var EventBus $bus */
        $bus = $container->get(EventBus::class);

        $bus->attach(CommandRegistering::class, function (CommandRegistering $event) {
            $event->app->registerCommand(MakeCommand::class);
            $event->app->registerCommand(MigrateCommand::class);
            $event->app->registerCommand(ResetCommand::class);
        });
    }
}
