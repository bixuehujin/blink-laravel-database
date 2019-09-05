<?php

namespace blink\laravel\database;

use PDOException;
use Illuminate\Support\Arr;
use InvalidArgumentException;
use Illuminate\Database\Connectors\ConnectionFactory as BaseConnectionFactory;


/**
 * Class ConnectionFactory
 *
 * @package blink\laravel\database
 */
class ConnectionFactory extends BaseConnectionFactory
{
    /**
     * Create a new Closure that resolves to a PDO instance with a specific host or an array of hosts.
     *
     * @param  array  $config
     * @return \Closure
     */
    protected function createPdoResolverWithHosts(array $config)
    {
        return function () use ($config) {
            $hosts = is_array($config['host']) ? $config['host'] : [$config['host']];

            if (empty($hosts)) {
                throw new InvalidArgumentException('Database hosts array is empty.');
            }

            foreach (Arr::shuffle($hosts) as $key => $host) {
                $config['host'] = $host;

                try {
                    return $this->createConnector($config)->connect($config);
                } catch (PDOException $e) {
                    if (count($hosts) - 1 === $key) {
                        app()->errorHandler->handleException($e);
                    }
                }
            }

            throw $e;
        };
    }
}
