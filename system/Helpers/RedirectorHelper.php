<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Arquivo: RedirectorHelper.php (UTF-8)
 *
 * Data: 17/10/2014
 * @author André Luis Rocha Menutole <andre.rocha@superpay.com.br>
 */

namespace Core\Helpers;

class RedirectorHelper {
    
    protected $parameters = array();


    protected function go( $data ) {
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $uri = str_replace("/public", "", $uri);
        header("Location:".$uri."/".$data);
    }
    
    public function setUrlParameter($name, $value) {
        $this->parameters[$name] = $value;        
        return $this;
    }
    
    protected function getUrlParameters() {
        $parms .= "";
        foreach ($this->parameters as $name => $value) 
            $parms .= $name.'/'.$value.'/';
        return $parms;
        
    }

    public function goToController( $controller ) {
        $this->go( $controller.'/index/' . $this->getUrlParameters() );
    }

    public function goToAction( $action ) {
        $this->go( $this->getCurrentController() . '/' . $action . '/' . $this->getUrlParameters());
    }

    public function goToControllerAction( $controller, $action) {
        $this->go( $controller . '/' . $action . '/' . $this->getUrlParameters());
    }

    public function goToIndex() {
        $this->go('index');
    }

    public function goToUrl($url) {
        header("Location:".$url);
    }
    
    public function getCurrentController() {
        global $start;
        return str_replace("Controller", "", lcfirst($start->controller));
    }
    
    public function getCurrentAction() {
        global $start;
        return str_replace("Action", "", $start->action);
    }

}
