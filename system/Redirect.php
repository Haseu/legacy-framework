<?php

/**
 * Arquivo: Redirect.php (UTF-8)
 *
 * Data: 17/10/2014
 * @author André Luis Rocha Menutole <andre.rocha@superpay.com.br>
 */

namespace Core;

/**
 * Class Redirect;
 * @package Core
 */
class Redirect {

    protected $parameters = array();

    protected function go($data) {
        $uri = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $uri = str_replace("/public", "", $uri);
        header("Location:" . $uri . "/" . $data);
    }

    public function setUrlParameter($name, $value) {
        $this->parameters[$name] = $value;
        return $this;
    }

    protected function getUrlParameters() {
        $parms .= "";
        foreach ($this->parameters as $name => $value)
            $parms .= $name . '/' . $value . '/';
        return $parms;
    }

    public function toRoute(array $route) {
        $this->go($route['module'] . '/' . $route['controller'] . '/' . $route['action'] . '/' . $this->getUrlParameters());
    }

    public function toUrl($url) {
        header("Location:" . $url);
    }

}
