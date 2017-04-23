<?php

namespace app\components;

/**
 * Class BaseModel
 * @package app\components
 */
class BaseModel
{
    /**
     * @var
     */
    private static $db;

    /**
     * Connecting to the database means PDO
     * @return null|\PDO
     */
    public static function dbConnect()
    {
        $dbObj = DataBase::getInstance();
        self::$db = $dbObj::connect();
        return self::$db;
    }
}