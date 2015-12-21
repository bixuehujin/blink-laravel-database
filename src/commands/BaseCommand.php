<?php

namespace blink\laravel\database\commands;


use blink\core\console\Command;

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
        return $this->blink->root . '/src/migrations';
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
