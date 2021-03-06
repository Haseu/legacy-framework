<?php

/**
 * Arquivo: RedirectorHelper.php (UTF-8)
 *
 * Data: 17/10/2014
 * @author André Luis Rocha Menutole <andre.rocha@superpay.com.br>
 */

namespace Core\Helpers;

/**
 * Class RedirectorHelper
 * @package Core\Helpers
 */
class RedirectorHelper {

    protected $parameters = array();

    protected function go($data) {
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $uri = str_replace("/public", "", $uri);
        header("Location:" . $uri . "/" . $data);
        exit();
    }

    public function setUrlParameter($name, $value) {
        $this->parameters[$name] = $value;
        return $this;
    }

    protected function getUrlParameters() {
        $parms = "";
        foreach ($this->parameters as $name => $value)
            $parms .= $name . '/' . $value . '/';
        return $parms;
    }

    public function toRoute(array $route) {
        
        $url = '';
        $url .= (isset($route['module']) ? $route['module'].'/' : '');
        $url .= (isset($route['controller']) ? $route['controller'].'/' : '');
        $url .= (isset($route['action']) ? $route['action'].'/' : '');
        
        $this->go($url . $this->getUrlParameters());
    }

    public function toUrl($url) {
        header("Location:" . $url);
    }

}
