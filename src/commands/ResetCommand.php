<?php

namespace blink\laravel\database\commands;

use \Illuminate\Database\Migrations\DatabaseMigrationRepository;
use \Illuminate\Database\Migrations\MigrationCreator;
use \Illuminate\Database\Migrations\Migrator;
use \Illuminate\Filesystem\Filesystem;
use \Symfony\Component\Console\Input\InputArgument;
use \Symfony\Component\Console\Input\InputInterface;
use \Symfony\Component\Console\Output\OutputInterface;


class ResetCommand extends BaseCommand
{
    public $name = 'migrate:reset';
    public $description = 'Rollback all database migrations';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        app()->bootstrap();

        $migrator = $this->getMigrator();

        if (!$this->migrator->repositoryExists()) {
            $output->writeln('<comment>Migration table not found.</comment>');
            return;
        }

        $migrator->reset((array)$this->getMigrationPath(), false);
    }
}
