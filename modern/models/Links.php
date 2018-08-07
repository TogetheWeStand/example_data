<?php

namespace app\models;

/**
 * Class Links
 * @package app\models
 */
class Links
{
    /**
     * @param string $id
     * @return mixed
     */
    public static function get(string $id)
    {
        return self::getList()[$id];
    }

    /**
     * @return mixed
     */
    private static function getList()
    {
        $links['password_restore'] = '/auth/restore-password';

        return $links;
    }
}
