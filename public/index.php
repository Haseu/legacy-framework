<?php

/**
 * Arquivo: index.php (UTF-8)
 *
 * Data: 16/10/2014
 * @author André Luis Rocha Menutole <andre.rocha@superpay.com.br>
 */
session_start();

/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */

chdir(dirname(__DIR__));

require 'system/Config.php';
require 'vendor/autoload.php';

try {
    Core\Bootstrap::run(new Core\Request);
} catch (Exception $e) {
    //Criar controllador ou helper para tratar os erros do framework
    header('Content-Type: text/html; charset=utf-8');
    echo "<em style='background-color:red; 
            clear:both; width:98%; 
            float:left; color:white;  
            font-weight: 
            bold; padding:10px; 
            -webkit-border-radius: 5px;
            -moz-border-radius: 5px;
            border-radius: 5px;'>";
    echo $e->getMessage();
    echo "</em>";
}


