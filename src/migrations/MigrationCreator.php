<?php


namespace blink\laravel\database\migrations;

use Illuminate\Database\Migrations\MigrationCreator as BaseCreator;

/**
 * Class MigrationCreator
 * @package blink\laravel\database\migrations
 */
class MigrationCreator extends BaseCreator
{
    public function stubPath()
    {
        return __DIR__ . '/stubs';
    }
}
