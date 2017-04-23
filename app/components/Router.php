<?php

namespace app\components;

/**
 * Class Router
 * @package app\components
 */
class Router
{
    /**
     * @var mixed
     */
    private $routes;

    /**
     * Router constructor.
     */
    public function __construct()
    {
        $file = CONF_PATH . 'routs.php';
        try {
            if (file_exists($file)) {
                $this->routes = include($file);
            } else {
                throw new \Exception('File not fount' .  $file);
            }
        } catch (\Exception $mess) {
            $mess->getMessage(); die();
        }
    }

    /**
     * Get url
     * @return string
     */
    private function getURI()
    {
        if (!empty($_SERVER['REQUEST_URI'])) {
            if ($_SERVER['REQUEST_URI'] == '/') {
                header('Location: /tasks');
            }
            return trim($_SERVER['REQUEST_URI'], '/');
        }
    }

    /**
     * Run router logic
     */
    public function run()
    {
        $url = $this->getURI();
        $errorCounter  = null;

        foreach ($this->routes as $urlPatten => $path)
        {
            if(preg_match("~$urlPatten~", $url)) {

               $internalRoute = preg_replace("~$urlPatten~", $path, $url);

               $segments = explode('/', $internalRoute);
               $controllerName = array_shift($segments) . 'Controller';
               $controllerName = ucfirst($controllerName);

               $actionName = 'action' . ucfirst(array_shift($segments));
               $parameters = $segments;

               $classObj = "app\\controllers\\" . $controllerName;
               $controllerObj = new $classObj();

               $res = call_user_func_array([$controllerObj, $actionName], $parameters);

               if ($res != null) { break; }

            } else {
                $errorCounter++;
            }
        }

        if ($errorCounter !== null) {
            require_once VIES_PATH . 'erorrs/404.php';
        }
    }
}