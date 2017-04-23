<?php

namespace app\components;

/**
 * Class AutoLoader
 * @package app\components
 * This class helps automatically connect files
 */
class AutoLoader
{
    /**
     *  Load classes
     */
    public static function load()
    {
        spl_autoload_register('self::findClass');
    }

    /**
     * Find classes by namespace
     * @param $className
     * @return bool
     */
    private static function findClass($className)
    {
        $fileName = "../" . str_replace("\\", '/', $className) . ".php";

        try{
            if (file_exists($fileName)) {
                require($fileName);
                if (class_exists($className)) {
                    return true;
                } else {
                    throw new \Exception('Class not found' . $className);
                }
            } else {
                throw new \Exception('File not found' . $fileName);
            }
        } catch (\Exception $mess) {
            echo $mess->getMessage();
        };
    }

}