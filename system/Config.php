<?php

/**
* Arquivo: Config.php (UTF-8)
*
* Data: 23/10/2014
* @author André Luis Rocha Menutole <andre.rocha@superpay.com.br>
*/

define('BASE_URL', (stripos($_SERVER['SERVER_PROTOCOL'],'https') === true ? 'https://' : 'http://') . $_SERVER['HTTP_HOST'] . dirname($_SERVER["REQUEST_URI"]));
define('DEFAULT_CONTROLLER', 'index');
define('DEFAULT_ACTION', 'index');

define('DS', DIRECTORY_SEPARATOR);
define('APP_PATH', 'app' . DS);
define('CONTROLLERS', 'Controller' . DS);
define('MODELS', 'Model' . DS);
define('HELPERS', 'system/Helpers/');


define('APP_NAME', 'SP_Framework');
