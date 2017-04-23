<?php

require_once(COMPONENTS_PATH . 'AutoLoader.php');

//start session
session_start();

//namespace
use app\components\AutoLoader;
use app\components\Router;

//AutoLoad files
AutoLoader::load();

//Router
$router = new Router();
$router->run();