<?php

namespace app\components;

/**
 * Class DataBase
 * @package app\components
 * Singleton Pattern
 */
class DataBase
{

    private static $instance;
    private static $configs;

    private function __construct()
    {
        if(file_exists(CONF_PATH . 'databases.php')) {
            self::$configs =  require_once CONF_PATH . 'databases.php';
        }
    }

    public static function getInstance() {
        if(!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public static function connect()
    {
        $conn = null;

        try {
            $conn = new \PDO(
                "mysql:host=" . self::$configs['host'] . ";dbname=" . self::$configs['dbName'],
                self::$configs['username'],
                self::$configs['password'],
                [\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"]
            );

            $conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

            return $conn;

        } catch (PDOException $e) {

            throw $e;

        }
        catch(Exception $e) {

            throw $e;

        }
    }

    private function __clone() {}
    public function __wakeup() {}

}