<?php

namespace blink\laravel\database\commands;


use \Illuminate\Filesystem\Filesystem;
use \Symfony\Component\Console\Input\InputArgument;
use \Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use \Symfony\Component\Console\Output\OutputInterface;
use blink\laravel\database\migrations\MigrationCreator;


class MakeCommand extends BaseCommand
{
    public string $name = 'migrate:make';
    public string $description = 'Run the database migrations';

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $table = $input->getOption('table');
        $create = $input->getOption('create');

        if (!$table && is_string($create)) {
            $table = $create;
        }

        $this->writeMigration($input->getArgument('name'), $table, $create);

        return 0;
    }

    /**
     * Write the migration file to disk.
     *
     * @param  string  $name
     * @param  string  $table
     * @param  bool    $create
     * @return string
     */
    protected function writeMigration($name, $table = null, $create = null)
    {

        $creator = new MigrationCreator(new Filesystem(), '');

        $path = $this->getMigrationPath();

        $file = pathinfo($creator->create($name, $path, $table, $create), PATHINFO_FILENAME);

        $this->line("<info>Created Migration:</info> $file");
    }

    public function options()
    {
        return [
            ['create', NULL, InputOption::VALUE_NONE, 'The table to be created'],
            ['table', NULL, InputOption::VALUE_OPTIONAL, 'The table to be migrated'],
        ];
    }

    public function arguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the migration', null],
        ];
    }
}
