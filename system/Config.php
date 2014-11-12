<?php

/**
 * Arquivo: Config.php (UTF-8)
 *
 * Data: 23/10/2014
 * @author André Luis Rocha Menutole <andre.rocha@superpay.com.br>
 */

//Url Base
$baseUrl = ( isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ? 'https://' : 'http://'; // checking if the https is enabled
$baseUrl .= isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : getenv('HTTP_HOST'); // checking adding the host name to the website address
$baseUrl .= isset($_SERVER['SCRIPT_NAME']) ? dirname($_SERVER['SCRIPT_NAME']) : dirname(getenv('SCRIPT_NAME')); // adding the directory name to the created url and then returning it.
$baseUrl = str_replace('/public', '', $baseUrl);

define('BASE_URL', $baseUrl);
define('DEFAULT_CONTROLLER', 'index');
define('DEFAULT_ACTION', 'index');
define('DEFAULT_LAYOUT', 'default');

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', realpath(dirname(__FILE__)) . DS);
define('APP_PATH', 'app' . DS);
define('CONTROLLERS', 'Controller' . DS);
define('MODELS', 'Model' . DS);
define('HELPERS', 'system/Helpers/');


define('APP_NAME', 'SP_Framework');

define('DB_HOST', '192.168.12.116');
define('DB_USER', 'superpay');
define('DB_PASS', 'ernet1982');
define('DB_NAME', 'sp_framework');
define('DB_CHAR', 'utf8');
