<?php

/**
 * @return \Illuminate\Database\Capsule\Manager
 */
function capsule()
{
    return app('capsule');
}

/**
 * @param null $name
 * @return \Illuminate\Database\Connection
 */
function capsule_conn($name = null)
{
    return app('capsule')->connection($name);
}

/**
 * @param string $name The connection name
 * @return \Illuminate\Database\Schema\Builder
 */
function capsule_schema($name = null)
{
    return app('capsule')->connection($name)->getSchemaBuilder();
}

/**
 * @param $data
 * @param $rules
 * @return \Illuminate\Validation\Validator
 */
function validate($data, $rules)
{
    $validator = new \Illuminate\Validation\Validator(app('i18n'), $data, $rules);

    $validator->setPresenceVerifier(new \Illuminate\Validation\DatabasePresenceVerifier(capsule()->getDatabaseManager()));

    return $validator;
}
