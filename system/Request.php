<?php

/**
 * Arquivo: Request.php (UTF-8)
 *
 * Data: 16/10/2014
 * @author André Luis Rocha Menutole <andre.rocha@superpay.com.br>
 */

namespace Core;

class Request {

    private $_url;
    private $_module;
    public $_controller;
    public $_action;
    public $_params;

    public function __construct() {
        $this->setUrl();
        $this->explode();
        $this->urlFilter();
        $this->setModule();
        $this->setController();
        $this->setAction();
        $this->setParams();
    }

    private function setUrl() {
        if (isset($_GET['url'])) {
            $this->_url = filter_input(INPUT_GET, 'url', FILTER_SANITIZE_URL);
        }
    }

    private function explode() {
        $this->_url = explode('/', $this->_url);
    }

    private function urlFilter() {
        $this->_url = array_filter($this->_url);
    }

    private function setModule() {
        $module = array_shift($this->_url);
        $this->_module = ucfirst($module);
    }

    private function setController() {
        $controller = array_shift($this->_url);
        if (!$controller) {
            $this->_controller = 'index';
        } else {
            $this->_controller = strtolower($controller);
        }
    }

    private function setAction() {
        $action = array_shift($this->_url);

        if (!$action) {
            $this->_action = 'index';
        } else {
            $this->_action = strtolower($action);
        }
    }

    private function setParams() {
        $this->_params = $this->_url;
        if (!isset($this->_params)) {
            $this->_params = array();
        }
    }

    public function getModule() {
        return $this->_module;
    }

    public function getController() {
        return $this->_controller;
    }

    public function getAction() {
        return $this->_action;
    }

    public function getParam($name = null) {
        if ($name != null)
            if (array_key_exists($name, $this->_params))
                return $this->_params[$name];
            else
                return false;
    }

    public function getParams() {
        return $this->_params;
    }

}
