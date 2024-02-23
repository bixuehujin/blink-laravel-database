<?php

namespace blink\laravel\database\commands;

use blink\console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Database\Migrations\Migrator;
use Illuminate\Database\Migrations\DatabaseMigrationRepository;

/**
 * Class BaseCommand
 * @package blink\laravel\database\commands
 */
class BaseCommand extends Command
{

    public function init()
    {
        foreach ($this->arguments() as $params) {
            call_user_func_array([$this, 'addArgument'], $params);
        }

        foreach ($this->options() as $params) {
            call_user_func_array([$this, 'addOption'], $params);
        }
    }

    protected function getMigrationPath()
    {
        return config('app.root') . '/src/migrations';
    }

    private $_migrator;

    /**
     * @param boolean $createIfNotExists
     * @return Migrator
     */
    protected function getMigrator($createIfNotExists = false)
    {

        if ($this->_migrator) {
            return $this->_migrator;
        }

        $connectionResolver = capsule()->getDatabaseManager();

        $repository = new DatabaseMigrationRepository($connectionResolver, 'migrations');

        if($createIfNotExists && !$repository->repositoryExists()) {
            $repository->createRepository();
        }

        return $this->_migrator = new Migrator($repository, $connectionResolver, new Filesystem);
    }


    public function arguments()
    {
        return [];
    }

    public function options()
    {
        return [];
    }
}
