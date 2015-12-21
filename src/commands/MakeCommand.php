<?php

namespace blink\laravel\database\commands;

use \Illuminate\Database\Migrations\DatabaseMigrationRepository;
use \Illuminate\Database\Migrations\MigrationCreator;
use \Illuminate\Database\Migrations\Migrator;
use \Illuminate\Filesystem\Filesystem;
use \Symfony\Component\Console\Input\InputArgument;
use \Symfony\Component\Console\Input\InputInterface;
use \Symfony\Component\Console\Output\OutputInterface;


class MakeCommand extends BaseCommand
{
    public $name = 'migrate:make';
    public $description = 'Run the database migrations';

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->writeMigration($input->getArgument('name'));
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

        $creator = new MigrationCreator(new Filesystem());

        $path = $this->getMigrationPath();

        $file = pathinfo($creator->create($name, $path, $table, $create), PATHINFO_FILENAME);

        $this->line("<info>Created Migration:</info> $file");
    }


    public function arguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the migration', null],
        ];
    }
}
