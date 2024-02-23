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
    public string $name = 'migrate:reset';
    public string $description = 'Rollback all database migrations';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $migrator = $this->getMigrator();

        if (!$migrator->repositoryExists()) {
            $output->writeln('<comment>Migration table not found.</comment>');
            return 1;
        }

        $migrator->reset($this->getMigrationPath(), false);

        return 0;
    }
}
