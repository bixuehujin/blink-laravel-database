<?php

namespace blink\laravel\database\commands;

use \Illuminate\Database\Migrations\DatabaseMigrationRepository;
use \Illuminate\Database\Migrations\Migrator;
use \Illuminate\Filesystem\Filesystem;
use \Symfony\Component\Console\Input\InputInterface;
use \Symfony\Component\Console\Output\OutputInterface;


class MigrateCommand extends BaseCommand
{
    public $name = 'migrate';
    public $description = 'Run the database migrations';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        app()->bootstrap();

        $capsule = app('capsule');
        $connectionResolver = $capsule->getDatabaseManager();

        $repository = new DatabaseMigrationRepository($connectionResolver, 'migrations');

        if(!$repository->repositoryExists()) {
            $repository->createRepository();
        }

        $migrator = new Migrator($repository, $connectionResolver, new Filesystem);

        return $migrator->run($this->getMigrationPath());
    }
}
