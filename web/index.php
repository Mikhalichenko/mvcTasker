<?php

/**
 * ERRORS
 */
ini_set('display_errors', 1);
error_reporting(E_ALL);

/**
 * ALIASES
 */
define('APP_PATH', __DIR__ . '/../app/');
define('CONF_PATH', APP_PATH . 'configs/');
define('COMPONENTS_PATH', APP_PATH . 'components/');
define('CONTROLLERS_PATH', APP_PATH . 'controllers/');
define('VIES_PATH', APP_PATH . 'views/');
define('WEB_PATH', __DIR__ . '/../web/');

/**
 * BOOTSTRAP FILE
 */
require_once(APP_PATH. "bootstrap.php");

