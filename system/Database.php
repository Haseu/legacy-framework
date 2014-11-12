<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
* Arquivo: Database.php (UTF-8)
*
* Data: 27/10/2014
* @version 2.8.1
* @author André Luis Rocha Menutole <andre.rocha@superpay.com.br>
*/

namespace Core;

use PDO;

class Database extends PDO{
    
    public function __construct() {
        parent::__construct(
            'mysql:host=' . DB_HOST . ';' .
            'dbname=' . DB_NAME, 
             DB_USER, DB_PASS, array(
                 PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . DB_CHAR
                 ));
                  
              
        }
}