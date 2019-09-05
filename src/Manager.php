<?php

namespace blink\laravel\database;

use blink\core\Configurable;
use blink\core\ObjectTrait;
use Illuminate\Database\Capsule\Manager as BaseManager;
use Illuminate\Events\Dispatcher;

/**
 * Class Manager
 *
 * @package blink\laravel\database
 */
class Manager extends BaseManager implements Configurable
{
    use ObjectTrait;

    public $fetch = \PDO::FETCH_CLASS;
    public $default = 'mysql';
    public $connections = [];
    public $migrations;


    public function __construct($config = [])
    {
        parent::__construct();

        foreach ($config as $name => $value) {
            $this->$name = $value;
        }

        $this->init();
    }

    public function init()
    {
        $this->container['config']['database.fetch'] = $this->fetch;
        $this->container['config']['database.default'] = $this->default;

        foreach ($this->connections as $key => $config) {
            $this->addConnection($config, $key);
        }

        $this->setEventDispatcher(new Dispatcher($this->getContainer()));

        $this->setAsGlobal();
        $this->bootEloquent();
    }
}
