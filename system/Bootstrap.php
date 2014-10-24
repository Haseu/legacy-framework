<?php

/**
 * Arquivo: BootStrap.php (UTF-8)
 *
 * Data: 23/10/2014
 * @author André Luis Rocha Menutole <andre.rocha@superpay.com.br>
 */

namespace Core;

use Exception;

class Bootstrap {

    public static function run(Request $request) {
        $module = $request->getModule();
        $controller = ucfirst($request->getController()) . "Controller";
        $controlerPath = APP_PATH . $module . DS . CONTROLLERS . $controller . ".php";
        $action = $request->getAction() . "Action";
        $params = $request->getParams();

        if (is_readable($controlerPath)) {

            $controllerName = "Application\\" . $module . "\Controller\\" . $controller;
            $app = new $controllerName();

            if (!method_exists($app, $action))
                throw new Exception('Houve um erro. Está action não existe.');

            $app->init();
            $app->$action();
        }else {
            throw new Exception('Houve um erro. Este controller não existe.');
        }
    }

}
