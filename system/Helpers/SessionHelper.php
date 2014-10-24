<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


/**
* Arquivo: SessionHelper.php (UTF-8)
*
* Data: 17/10/2014
* @author André Luis Rocha Menutole <andre.rocha@superpay.com.br>
*/

namespace Core\Helpers;

class SessionHelper{
    public function createSession($name, $value) {
        $_SESSION[$name] = $value;
        return $this;
    }
    
    public function selectSession($name) {
        return $_SESSION[$name];
    }
    
    public function deleteSession($name) {
        unset($_SESSION[$name]);
        return $this;
    }
    
    public function checkSession($name) {
        return isset($_SESSION[$name]);
    }
}