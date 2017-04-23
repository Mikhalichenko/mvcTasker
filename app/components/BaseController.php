<?php

namespace app\components;

/**
 * Class BaseController
 * @package app\components
 */
class BaseController
{
    /**
     * @param $file
     * @param array $params
     * Rendering files with parameter passing
     */
    protected function render($file, $params = [])
    {
        ob_start();
        extract($params, EXTR_SKIP);
        include_once(VIES_PATH . $file . '.php'); die();
    }

    /**
     * Check for access to the user
     */
    protected function accessUser()
    {
        if (!isset($_SESSION['loggetUser'])) {
            header('Location: /');
        }
    }
}