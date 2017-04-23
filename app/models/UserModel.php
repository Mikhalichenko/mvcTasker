<?php

namespace app\models;

use app\components\BaseModel;

/**
 * Class UserModel
 * @package app\models
 * Responsible for fetching and working with the user table
 */
class UserModel extends BaseModel
{

    /**
     * @param $data
     * @return bool
     * Find user by login and password
     */
    public static function getUserByLoginAndPass($data)
    {
        $sql = "SELECT * FROM tasker.user WHERE login = :login AND password = :pass";

        $res = self::dbConnect()->prepare($sql);

        $res->bindValue(':login', $data['login']);
        $res->bindValue(':pass', md5($data['password']));

        $res->execute();

        if ($res->fetch()) {
            return true;
        } else {
            return false;
        }
    }
}