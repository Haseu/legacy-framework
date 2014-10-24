<?php

/**
 * Arquivo: View.php (UTF-8)
 *
 * Data: 23/10/2014
 * @author André Luis Rocha Menutole <andre.rocha@superpay.com.br>
 */

namespace Core;

use Exception;

class View {

    private $_controller;
    private $_module;
    private $_setTerminate;
    protected $_layout;
    protected $_view;
    protected $content;

    public function __construct(Request $request) {
        $this->_module = $request->getModule();
        $this->_controller = $request->getController();
        $this->layout();
    }

    public function layout($layout = null) {
        if (!isset($layout)) {
            $file = APP_PATH . 'Base/View/layout/layout.phtml';
        } else {
            $file = APP_PATH . $layout . '.phtml';
        }

        if (is_readable($file)) {

            $this->_layout = $file;
            return true;
        }
        throw new Exception("Error: Layout não encontrado.");
    }

    public function render($view, $vars = null) {

        $file = APP_PATH . $this->_module . DS . 'View' . DS . $this->_controller . DS . $view . '.phtml';

        if (is_readable($file)) {
            if (!$this->_setTerminate) {
                $this->processView($file, $vars);
                if ($this->_layout) {
                    require_once $this->_layout;
                    return true;
                }
            } else {
                $this->getView($file, $vars);
                return true;
            }
        }
        throw new Exception("Error: View não encontrada.");
    }

    protected function view($nome, $vars = null) {
        if (is_array($vars) && count($vars) > 0)
            extract($vars, EXTR_PREFIX_ALL, 'view');

        $module = $this->getModule();
        $controler = str_replace("Controller", "", $this->getController());

        $file = APP_PATH . $module . "/" . VIEWS . $controler . "/" . $nome . '.phtml';

        if (!file_exists($file))
            die("houve um erro. View não existe.");

        require_once( $file );
    }

    public function setTerminate($option) {
        if ($option === true) {
            $this->_setTerminate = true;
        }
    }

    private function processView($viewPath, $vars = null) {
        if (isset($vars)) {
            extract($vars);
        }

        ob_start();
        require_once( $viewPath );
        $this->content = ob_get_contents();
        ob_end_clean();
    }

    private function getView($viewPath, $vars = null) {
        if (isset($vars)) {
            extract($vars);
        }

        require_once( $viewPath );
    }

}
