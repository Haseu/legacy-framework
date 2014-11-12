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

/**
 * Class SessionHelper
 * @package Core\Helpers
 */
class SessionHelper {

    public static function init() {
        session_start();
    }

    public function set($name, $value) {
        $_SESSION[$name] = $value;
        return $this;
    }

    public function get($name) {
        return $_SESSION[$name];
    }

    public function delete($name) {
        unset($_SESSION[$name]);
        return $this;
    }

    public function check($name) {
        return isset($_SESSION[$name]);
    }

    public static function destroy() {
        session_destroy();
    }

}
