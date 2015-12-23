<?php

/**
 * @return \Illuminate\Database\DatabaseManager
 */
function capsule()
{
    return app('capsule');
}

/**
 * @param string $name The connection name
 * @return \Illuminate\Database\Schema\Builder
 */
function capsule_schema($name = null)
{
    return app('capsule')->connection($name)->getSchemaBuilder();
}