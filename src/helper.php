<?php

use blink\laravel\database\Manager;

function capsule(): Manager
{
    return app()->get(Manager::class);
}

/**
 * @param null $name
 * @return \Illuminate\Database\Connection
 */
function capsule_conn($name = null)
{
    return capsule()->connection($name);
}

/**
 * @param string $name The connection name
 * @return \Illuminate\Database\Schema\Builder
 */
function capsule_schema($name = null)
{
    return capsule()->connection($name)->getSchemaBuilder();
}

/**
 * @param $data
 * @param $rules
 * @return \Illuminate\Validation\Validator
 */
function validate($data, $rules)
{
    $validator = new \Illuminate\Validation\Validator(app()->get('i18n'), $data, $rules);

    $validator->setPresenceVerifier(new \Illuminate\Validation\DatabasePresenceVerifier(capsule()->getDatabaseManager()));

    return $validator;
}
