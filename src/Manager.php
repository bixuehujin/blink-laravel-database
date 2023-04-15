<?php

namespace blink\laravel\database;

use blink\core\Configurable;
use blink\core\ObjectTrait;
use Illuminate\Config\Repository;
use Illuminate\Container\Container;
use Illuminate\Contracts\Config\Repository as ConfigContract;
use Illuminate\Database\Capsule\Manager as BaseManager;
use Illuminate\Database\DatabaseManager;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;
use PhpCsFixer\ConfigInterface;
use Illuminate\Database\DatabaseServiceProvider;

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
        $instance = MockedApp::getInstance();

        parent::__construct($instance);

        foreach ($config as $name => $value) {
            $this->$name = $value;
        }

        $this->init();
    }

    public function init()
    {
        $this->container['config']['database.fetch'] = $this->fetch;
        $this->container['config']['database.default'] = $this->default;
        $this->container['config']['database.connections'] = $this->connections;

        $this->setEventDispatcher(new Dispatcher($this->getContainer()));

        $this->setAsGlobal();
        $this->bootEloquent();

        (new DatabaseServiceProvider(MockedApp::getInstance()))->register();
    }

    /**
     * @inheritdoc
     */
    protected function setupManager()
    {
        $factory = new ConnectionFactory($this->container);

        $app = MockedApp::getInstance();
        $this->manager = new DatabaseManager($app, $factory);

        Schema::setFacadeApplication($app);
    }
}
